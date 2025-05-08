import re
import json

def parse_textract_json(file_path):
    """Parse AWS Textract JSON avec gestion complète des articles fragmentés"""
    with open(file_path, 'r', encoding='utf-8') as f:
        data = json.load(f)

    # Extraction des lignes avec texte, confiance et page
    lines = []
    for block in data.get("Blocks", []):
        if block["BlockType"] == "LINE":
            lines.append({
                "text": block["Text"],
                "confidence": block.get("Confidence", 0),
                "page": block.get("Page", 0)
            })

    # Filtrage des lignes avec faible confiance
    lines = [l for l in lines if l["confidence"] > 80]

    # Structures
    decrees = []
    current_decree = None
    current_chapter = None
    current_section = None
    current_article = None
    article_continuation = False  # Pour gérer les suites d'articles

    for line in lines:
        text = line["text"].strip()
        page = line["page"]
        if not text:
            continue

        # Détecter un nouveau décret
        decree_match = re.match(r"DECRET N[o°]([\d\-\s\/\w]+)", text)
        if decree_match:
            if current_decree:
                decrees.append(current_decree)
            current_decree = {
                "id": decree_match.group(1).replace(" ", ""),
                "title": "",
                "page": page,
                "chapters": [],
                "articles": []
            }
            current_chapter = None
            current_section = None
            current_article = None
            article_continuation = False
            continue

        # Nouveau chapitre
        chapter_match = re.match(r"CHAPITRE\s*([IVXLCDM\d]*)\s*:\s*(.+)", text, re.IGNORECASE)
        if chapter_match:
            # Ne pas ajouter de chapitre si aucun décret n'est actif
            if not current_decree:
                continue

            current_chapter = {
                "number": chapter_match.group(1) or None,
                "title": chapter_match.group(2).strip(),
                "page": page,
                "sections": [],
                "articles": []
            }
            current_decree["chapters"].append(current_chapter)
            current_section = None
            continue

        # Nouvelle section
        section_match = re.match(r"Section\s*(\d+)\s*:\s*(.+)", text)
        if section_match and current_chapter:
            # Ne pas ajouter de section sans décret ou chapitre
            if not current_decree or not current_chapter:
                continue

            current_section = {
                "number": section_match.group(1),
                "title": section_match.group(2).strip(),
                "page": page,
                "articles": []
            }
            current_chapter["sections"].append(current_section)
            continue

        # Début d'un article (numéro seul ou avec texte)
        article_match = re.match(r"Article\s+(\d+)(?:\s*:\s*(.*))?", text)
        if article_match:
            number = article_match.group(1)
            initial_text = article_match.group(2) or ""

            current_article = {
                "number": number,
                "text": initial_text.strip(),
                "page": page
            }

            # Ajout à la bonne structure
            if current_section:
                current_section["articles"].append(current_article)
            elif current_chapter:
                current_chapter["articles"].append(current_article)
            elif current_decree:
                current_decree["articles"].append(current_article)

            article_continuation = True  # Activer la continuation
            continue

        # Suite d'article ou texte libre
        if article_continuation and current_article and text:
            # Éviter de répéter le deux-points
            if text.strip() == ":":
                continue

            current_article["text"] += " " + text.strip()
            continue

        # Fin de continuation si on tombe sur un nouveau bloc
        if (re.match(r"CHAPITRE|Section|Article", text) or
            re.match(r"DÉCRET N°", text)):
            article_continuation = False

    # Ajout du dernier décret
    if current_decree:
        decrees.append(current_decree)

    return {"decrees": decrees}

# Exécution
if __name__ == "__main__":
    result = parse_textract_json("textract.json")

    with open("2023-0273.json", "w", encoding="utf-8") as f:
        json.dump(result, f, ensure_ascii=False, indent=2)

    print(f"✅ {len(result['decrees'])} décrets extraits avec {sum(len(d['chapters']) for d in result['decrees'])} chapitres !")