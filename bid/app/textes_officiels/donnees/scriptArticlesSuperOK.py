import re
import json

def parse_textract_json(file_path):
    """Parse AWS Textract JSON avec gestion des erreurs OCR et articles fragmentés"""
    with open(file_path, 'r', encoding='utf-8') as f:
        data = json.load(f)

    # Extraction des lignes de texte (filtrage par confiance)
    lines = []
    for block in data.get("Blocks", []):
        if block["BlockType"] == "LINE":
            # Nettoyage : supprime les scores OCR en fin de ligne (ex: --98.75165557861328)
            cleaned_text = re.sub(r"--\d+\.\d+$", "", block["Text"]).strip()
            if cleaned_text:
                lines.append({
                    "text": cleaned_text,
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
    article_continuation = False

    for line in lines:
        text = line["text"].strip()
        page = line["page"]
        print(text)
        if not text:
            continue

        # Détecter un nouveau décret (gère les erreurs OCR)
        decree_match = re.match(r"(?:DÉ|DE|DEC)RET N[o°]\s*([\d\-\.\s\/\w]+)", text, re.IGNORECASE)
        if decree_match:
            if current_decree:
                decrees.append(current_decree)
            current_decree = {
                "id": decree_match.group(1).replace(" ", "").replace("--", ""),  # Nettoyage
                "title": "",
                "page": page,
                "chapters": [],
                "sections": [],
                "articles": []
            }
            current_chapter = None
            current_section = None
            current_article = None
            article_continuation = False
            continue

        # Titre du décret (gère les titres sans "portant")
        if current_decree and not current_decree["title"]:
            if re.match(r"(?:Vu|Article|CHAPITRE|Section)", text):
                continue  # Ignore les lignes non-titres
            current_decree["title"] = text
            continue

        # Nouveau chapitre
        chapter_match = re.match(r"CHAPITRE\s*([IVXLCDM\d]*)\s*:\s*(.+)", text, re.IGNORECASE)
        if chapter_match and current_decree:
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
            current_section = {
                "number": section_match.group(1),
                "title": section_match.group(2).strip(),
                "page": page,
                "articles": []
            }
            current_chapter["sections"].append(current_section)
            continue

        # Début d'un article (gère les numéros fragmentés)
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

            article_continuation = True
            continue

        # Suite d'article ou texte libre
        if article_continuation and current_article and text:
            if text.strip() == ":":
                continue
            current_article["text"] += " " + text.strip()
            continue

        # Fin de continuation si nouveau bloc
        if re.match(r"(CHAPITRE|Section|Article|D[ÉE]CRET N[o°])", text, re.IGNORECASE):
            article_continuation = False

    # Ajout du dernier décret
    if current_decree:
        decrees.append(current_decree)

    return {"decrees": decrees}

# Exécution
if __name__ == "__main__":
    result = parse_textract_json("textract.json")

    with open("2017-0049.json", "w", encoding="utf-8") as f:
        json.dump(result, f, ensure_ascii=False, indent=2)

    print(f"✅ {len(result['decrees'])} décrets extraits avec {sum(len(d['articles']) for d in result['decrees'])} articles !")