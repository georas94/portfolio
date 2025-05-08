import trp.trp2 as t2
from trp.t_pipeline import pipeline_merge_tables
from trp.trp2 import TDocument, TDocumentSchema
from trp.t_tables import MergeOptions, HeaderFooterType
import json
import unicodedata

# Fonction pour normaliser le texte (supprime les accents, espaces multiples)
def normalize_text(text: str) -> str:
    if not text:
        return ""
    # Supprimer les accents
    text = unicodedata.normalize("NFKD", text).encode("ascii", "ignore").decode("utf-8")
    # Supprimer les espaces multiples
    return " ".join(text.strip().split())

# Fonction pour supprimer les doublons (mots et phrases)
def clean_repeated_text(text: str) -> str:
    words = text.split()
    seen_words = set()
    result_words = []
    for word in words:
        if word not in seen_words:
            seen_words.add(word)
            result_words.append(word)
    result = " ".join(result_words)

    # Supprimer les répétitions de phrases entières
    phrases = result.split(". ")
    seen_phrases = set()
    result_phrases = []
    for phrase in phrases:
        if phrase not in seen_phrases:
            seen_phrases.add(phrase)
            result_phrases.append(phrase)
    return ". ".join(result_phrases).strip()

# Fonction pour dédupliquer les éléments
def deduplicate(items):
    seen = set()
    result = []
    for item in items:
        if item not in seen:
            seen.add(item)
            result.append(item)
    return result

# Fonction pour détecter le mot-clé le plus prioritaire
def get_highest_priority_keyword(normalized_text, header_priority):
    sorted_keywords = sorted(header_priority.keys(), key=lambda x: (header_priority[x], -len(x)))
    for keyword in sorted_keywords:
        if keyword in normalized_text:
            return keyword
    return None

# Chargement du document JSON
input_file = "test.json"
with open(input_file, "r", encoding="utf-8") as f:
    data = json.load(f)

# Création du document TRP2
t_document: t2.TDocument = t2.TDocumentSchema().load(data)
t_document = pipeline_merge_tables(t_document, MergeOptions.MERGE, None, HeaderFooterType.NONE)
block_map = {block.id: block for block in t_document.blocks}

# Priorité des mots-clés
header_priority = {
    "MINISTERE": 0,
    "AGRICULTURE": 1,
    "AUTORITE": 2,
    "COMMISSION": 3,
    "NATIONALE": 4,
    "UNIVERSITE": 5,
    "AGENCE": 6,
    "GROUPEMENT": 7,
    "UNIVERSITAIRE": 8,
    "CENTRE": 9,
    "REGION": 10,
    "BURKINABE": 11,
    "RECTIFICATIF": 12
}

header_keywords = sorted([
    "RECTIFICATIF", "AUTORITE", "MINISTERE", "COMMISSION", "NATIONALE",
    "UNIVERSITE", "AGENCE", "REGION", "GROUPEMENT"
], key=lambda x: (header_priority[x], -len(x)))

# Variables globales
tables_data = []
last_headers = []
last_subheaders = []
last_page = None

# Fonction récursive pour extraire le texte complet d'un bloc
def get_block_text(block_id: str) -> str:
    if block_id not in block_map:
        return ""
    block = block_map[block_id]
    text = block.text or ""
    if block.relationships:
        for rel in block.relationships:
            if rel.type == "CHILD":
                for child_id in rel.ids:
                    child_text = get_block_text(child_id)
                    if child_text:
                        text += " " + child_text
    return clean_repeated_text(text.strip())

# Parcourir chaque page du document
for page_idx, page in enumerate(t_document.pages):
    current_page_blocks = []
    for rel in page.relationships:
        if rel.type == "CHILD":
            for block_id in rel.ids:
                if block_id in block_map:
                    current_page_blocks.append(block_map[block_id])

    # Réinitialiser les en-têtes en début de page
    page_headers = []

    # Traitement des blocs (en-têtes et tables)
    for block in current_page_blocks:
        if block.block_type in ["LINE", "TABLE_TITLE"]:
            block_text = get_block_text(block.id)
            if block_text:
                normalized_text = normalize_text(block_text)
                highest_priority_kw = get_highest_priority_keyword(normalized_text, header_priority)

                # Vérifier si c'est un en-tête principal
                if (highest_priority_kw or "RESULTATS PROVISOIRES" in normalized_text) and '(' not in block_text and ')' not in block_text:
                    cleaned_text = clean_repeated_text(block_text)
                    print(f"[HEADER] Mot-clé prioritaire détecté : {highest_priority_kw}")
                    print(f"[HEADER] Texte : {cleaned_text}")
                    page_headers = [cleaned_text]
                    last_subheaders = []

                # Ajouter aux sous-en-têtes uniquement si le bloc n'est pas une table et n'est pas vide
                elif page_headers and block.block_type != "TABLE" and len(block_text.strip()) >= 70:
                    cleaned_text = clean_repeated_text(block_text)
                    if cleaned_text not in last_subheaders:
                        last_subheaders.append(cleaned_text)

        elif block.block_type == "TABLE":
            # Vérifier si c'est une continuation
            is_continuation = False

            # Continuation sur la même page ou page suivante
            if last_page and (page.page == last_page + 1 or page.page == last_page):
                normalized_text = normalize_text(block.text or "")
                if "SUITE" in normalized_text or "CONTINUATION" in normalized_text:
                    is_continuation = True
                elif block.geometry.bounding_box.top < 0.07: #and len(last_subheaders) > 0 and len(last_subheaders[0]) >= 70:
                    print("NINJA")
                    print(last_subheaders)
                    print(block.geometry.bounding_box.top)
                    is_continuation = True

            # Récupérer les cellules via les relations CHILD
            cell_ids = []
            if block.relationships:
                for rel in block.relationships:
                    if rel.type == "CHILD":
                        cell_ids.extend(rel.ids)

            # Regrouper les cellules par ligne
            cells_by_row = {}
            for cell_id in cell_ids:
                if cell_id not in block_map:
                    continue
                cell = block_map[cell_id]
                if cell.block_type != "CELL":
                    continue
                row_idx = cell.row_index or 0
                if row_idx not in cells_by_row:
                    cells_by_row[row_idx] = []
                cell_text = ""
                if cell.relationships:
                    for rel in cell.relationships:
                        if rel.type == "CHILD":
                            for child_id in rel.ids:
                                cell_text += get_block_text(child_id) + " "
                cells_by_row[row_idx].append({
                    "text": cell_text.strip(),
                    "col_span": cell.column_span or 1
                })

            # Déterminer les en-têtes
            all_rows = [cells_by_row[k] for k in sorted(cells_by_row)]
            headers = []
            data_start = 0

            # Si continuation, réutiliser les en-têtes précédents
            if is_continuation and last_headers:
                headers = last_headers.copy()
                data_start = 0
            else:
                for i, row in enumerate(all_rows):
                    if len(row) > 1 and any(cell["text"] for cell in row):
                        data_start = i
                        break

            # Mapper les données aux en-têtes
            table_data = {
                "table_number": len(tables_data) + 1,
                "page": block.page,
                "headers": [] if is_continuation else (deduplicate(page_headers.copy()) if page_headers else []),
                "subheaders": [] if is_continuation else (deduplicate(last_subheaders.copy()) if last_subheaders else []),
                "is_continuation": is_continuation,
                "rows": []
            }

            # Extraire les lignes de la table
            for row in all_rows[data_start:]:
                row_dict = {}
                col_idx = 0
                while col_idx < len(row):
                    cell = row[col_idx]
                    col_span = cell["col_span"]
                    value = cell["text"]
                    key = headers[col_idx] if headers and col_idx < len(headers) else f"col_{col_idx}"

                    # Gérer les cellules fusionnées
                    if col_span > 1:
                        combined_value = value
                        for i in range(1, col_span):
                            if col_idx + i < len(row):
                                combined_value += " " + row[col_idx + i]["text"]
                        row_dict[key] = combined_value.strip()
                        col_idx += col_span
                    else:
                        row_dict[key] = value
                        col_idx += 1
                table_data["rows"].append(row_dict)

            tables_data.append(table_data)

            # Réinitialiser les sous-en-têtes sauf pour les continuations
            if not is_continuation:
                last_subheaders = []

            # Mettre à jour les en-têtes pour les continuations
            if is_continuation:
                last_headers = table_data["headers"]
            else:
                last_headers = table_data["headers"]

    # Mettre à jour la dernière page traitée
    last_page = page.page

# Écrire dans un fichier JSON
output_file = "structured_with_headers_and_continuation.json"
with open(output_file, "w", encoding="utf-8") as f:
    json.dump(tables_data, f, ensure_ascii=False, indent=2)

print(f"\n✅ Données exportées dans '{output_file}' avec gestion des en-têtes et continuations")