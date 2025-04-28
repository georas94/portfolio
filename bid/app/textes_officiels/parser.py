import re
import json

# === Chargement du fichier JSON Textract ===
with open('textract_result.json', 'r') as f:
    data = json.load(f)

# === Variables de travail ===
articles = []
current_article = None
current_text = ""
current_start_page = None
current_end_page = None
current_titre = None
current_chapitre = None
current_section = None
current_chapitre_numero = None
current_section_numero = None

# === Variables pour gérer les titres et sections sur plusieurs lignes ===
buffer_titre = ""
buffer_chapitre = ""
buffer_section = ""

# === Parsing des lignes ===
for block in data['Blocks']:
    if block['BlockType'] == 'LINE':
        page_number = block.get('Page', 'unknown')
        text = block.get('Text', '').strip()
        text = ' '.join(text.split())  # Nettoyage des espaces inutiles

        # Traitement des TITRES
        titre_match = re.match(r"^TITRE\s+[A-Z]+\s*:\s*(.+)$", text, re.IGNORECASE)
        if titre_match:
            # Si on était en train de bufferiser un titre précédent, on l'enregistre
            if buffer_titre:
                current_titre = buffer_titre.strip()
                print(f"[DEBUG] Nouveau TITRE → {current_titre}")
            buffer_titre = titre_match.group(1)  # On garde la partie du titre après le "TITRE"
            continue  # On saute cette ligne pour éviter de la remettre dans l'article

        # Si le titre est coupé sur plusieurs lignes, on accumule les morceaux
        if text.lower().startswith("titre"):
            buffer_titre += " " + text

        # Traitement des CHAPITRES
        chapitre_match = re.match(r"^CHAPITRE\s+([IVXLCDM]+)\s*:\s*(.+)$", text, re.IGNORECASE)
        if chapitre_match:
            # Enregistre le chapitre précédent, si nécessaire
            if buffer_chapitre:
                current_chapitre = buffer_chapitre.strip()
                print(f"[DEBUG] Nouveau CHAPITRE → {current_chapitre}")
            current_chapitre_numero = chapitre_match.group(1)  # On récupère le numéro du chapitre
            buffer_chapitre = chapitre_match.group(2)  # On garde la partie après le "CHAPITRE"
            continue  # On saute cette ligne aussi

        # Si le chapitre est coupé sur plusieurs lignes, on accumule les morceaux
        if text.lower().startswith("chapitre"):
            buffer_chapitre += " " + text

        # Traitement des SECTIONS
        section_match = re.match(r"^Section\s+(\d+)\s*:\s*(.+)$", text, re.IGNORECASE)
        if section_match:
            # Enregistre la section précédente si nécessaire
            if buffer_section:
                current_section = buffer_section.strip()
                print(f"[DEBUG] Nouvelle SECTION → {current_section}")
            current_section_numero = section_match.group(1)  # On récupère le numéro de la section
            buffer_section = section_match.group(2)  # On garde la partie après "Section"
            continue  # On saute cette ligne

        # Si la section est coupée sur plusieurs lignes, on accumule
        if text.lower().startswith("section"):
            buffer_section += " " + text

        # Cherche un début d'Article
        article_match = re.search(r"\bArticle\s+(\d+)\s*:", text, re.IGNORECASE)
        if article_match:
            # Si un article précédent était en cours, on le termine
            if current_article is not None:
                articles.append({
                    "article": str(current_article),
                    "content": current_text.strip(),
                    "start_page": current_start_page,
                    "end_page": current_end_page,
                    "titre_reference": current_titre,
                    "chapitre_reference": f"{current_chapitre_numero} : {current_chapitre}",
                    "section_reference": f"Section {current_section_numero} : {current_section}"
                })
                print(f"[DEBUG] Article {current_article} → Pages {current_start_page} à {current_end_page}")

            # Nouveau début d'article
            current_article = int(article_match.group(1))
            current_text = text + "\n"
            current_start_page = page_number
            current_end_page = page_number

        else:
            # Si on est dans un article en cours, on accumule
            if current_article is not None:
                current_text += text + "\n"
                current_end_page = page_number

# === Ajout du dernier article détecté ===
if current_article is not None:
    articles.append({
        "article": str(current_article),
        "content": current_text.strip(),
        "start_page": current_start_page,
        "end_page": current_end_page,
        "titre_reference": current_titre,
        "chapitre_reference": f"{current_chapitre_numero} : {current_chapitre}",
        "section_reference": f"Section {current_section_numero} : {current_section}"
    })
    print(f"[DEBUG] Article {current_article} → Pages {current_start_page} à {current_end_page}")

# === Sauvegarde en JSON ===
with open('output_articles.json', 'w', encoding='utf-8') as f:
    json.dump(articles, f, ensure_ascii=False, indent=4)

print("\n✅ Parsing terminé avec TITRES, CHAPITRES, SECTIONS et ARTICLES ! Résultat dans 'output_articles.json'.")
