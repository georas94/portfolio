import json
import unicodedata
import re

def normalize_text(text):
    """Normalise le texte pour correspondance sans accent/casse"""
    return unicodedata.normalize("NFKD", text).encode("ascii", "ignore").decode("utf-8").lower()

def extract_footer_lines(page_num, all_blocks):
    """Extrait les lignes de pied de page pour une page spécifique"""
    return [
        b["Text"] for b in all_blocks
        if b["BlockType"] == "LINE"
        and b["Page"] == page_num
        and b["Geometry"]["BoundingBox"]["Top"] > 0.95
    ]

def is_excluded(text, page_num):
    """Détermine si un texte doit être exclu des colonnes"""
    # Termes à exclure explicitement
    static_excluded = {
        "dgcmef", "direction générale", "appels d'offres",
        "maîtrises d'ouvrages déléguées", "marchés de travaux",
        "marchés de prestations intellectuelles", "fournitures et services courants"
    }

    normalized = normalize_text(text)

    # Exclusion des termes statiques
    if normalized in static_excluded:
        return True

    # Exclusion des motifs dynamiques (ex: "P. 54 à 62", "P. 63")
    if re.match(r"^P\.\s*\d+\s*(?:à|et)?\s*\d*$", text.strip(), re.IGNORECASE):
        return True

    # Exclusion des caractères isolés (ex: "*", "•", "-")
    if len(text.strip()) <= 1:
        return True

    return False

def process_page(page_num, blocks):
    """Traite une page spécifique et retourne les données structurées"""
    page_blocks = [b for b in blocks if b["Page"] == page_num]

    # Extraction des éléments clés
    category_block = None
    header_block = None
    subheader_block = None

    # Recherche de la catégorie
    for b in page_blocks:
        if is_excluded(b["Text"], page_num):
            continue
        normalized = normalize_text(b["Text"])
        if "fournitures et services" in normalized or "résultats provisoires" in normalized:
            category_block = b
            break

    # Recherche de l'en-tête principal
    for b in page_blocks:
        if is_excluded(b["Text"], page_num):
            continue
        normalized = normalize_text(b["Text"])
        if any(keyword in normalized for keyword in ["ministere", "centre hospitalier", "commission", "universite", "direction", "region"]):
            header_block = b
            break

    # Recherche du sous-en-tête
    for b in page_blocks:
        if category_block and b["Id"] == category_block["Id"]:
            continue
        if is_excluded(b["Text"], page_num):
            continue
        normalized = normalize_text(b["Text"])
        if "fourniture de" in normalized or "acquisition" in normalized or "demande de propositions" in normalized:
            subheader_block = b
            break

    # Extraction des colonnes gauche/droite
    left_column = []
    right_column = []

    for b in page_blocks:
        if category_block and b["Id"] == category_block["Id"]:
            continue
        if header_block and b["Id"] == header_block["Id"]:
            continue
        if subheader_block and b["Id"] == subheader_block["Id"]:
            continue
        if b["Geometry"]["BoundingBox"]["Top"] > 0.95:  # Pied de page
            continue
        if is_excluded(b["Text"], page_num):
            continue

        if b["Geometry"]["BoundingBox"]["Left"] < 0.5:
            left_column.append(b)
        else:
            right_column.append(b)

    # Gestion des fusions de lignes
    def detect_line_continuation(lines):
        result = []
        i = 0
        while i < len(lines):
            current = lines[i]["Text"]
            if i + 1 < len(lines) and any(current.strip().endswith(word) for word in ["par le", "du", "sur", "à", "conformé"]):
                current += " " + lines[i+1]["Text"]
                i += 1
            result.append(current)
            i += 1
        return result

    body_left = detect_line_continuation(left_column)
    body_right = detect_line_continuation(right_column)

    return {
        "page": page_num,
        "categorie_appel_offre": category_block["Text"] if category_block else "",
        "entete_principal": header_block["Text"] if header_block else "",
        "sous_entete": subheader_block["Text"] if subheader_block else "",
        "corps_gauche": body_left,
        "corps_droit": body_right,
        "pied_page": extract_footer_lines(page_num, blocks)
    }

# Chargement du document JSON
input_file = "test.json"
with open(input_file, "r") as f:
    data = json.load(f)

# Extraction de tous les blocs LINE
all_line_blocks = [block for block in data["Blocks"] if block["BlockType"] == "LINE"]

# Récupération de toutes les pages
all_pages = set(block["Page"] for block in all_line_blocks)

# Traitement de chaque page
structured_data = []
for page_num in sorted(all_pages):
    page_data = process_page(page_num, all_line_blocks)
    if page_data["categorie_appel_offre"] or page_data["entete_principal"]:
        structured_data.append(page_data)

# Sauvegarde du résultat
output_file = "structured_output_cleaned.json"
with open(output_file, "w", encoding="utf-8") as f:
    json.dump(structured_data, f, ensure_ascii=False, indent=2)

print(f"✅ Données structurées sauvegardées dans '{output_file}'")