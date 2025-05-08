import trp.trp2 as t2
from trp.t_pipeline import pipeline_merge_tables
from trp.trp2 import TDocument, TDocumentSchema
from trp.t_tables import MergeOptions, HeaderFooterType
import json
import unicodedata

# Fonction pour normaliser le texte (supprime accents, espaces multiples)
def normalize_text(text: str) -> str:
    if not text:
        return ""
    return unicodedata.normalize("NFKD", text).encode("ascii", "ignore").decode("utf-8").strip().upper()

# Chargement du document JSON
input_file = "test.json"
with open(input_file, "r", encoding="utf-8") as f:
    data = json.load(f)

# Création du document TRP2
t_document: t2.TDocument = t2.TDocumentSchema().load(data)

# Fusion des tables
t_document = pipeline_merge_tables(t_document, MergeOptions.MERGE, None, HeaderFooterType.NONE)

# Créer une map d'ID → bloc
block_map = {block.id: block for block in t_document.blocks}

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
    return text.strip()

# Parcourir chaque page du document
tables_data = []
last_headers = []
last_subheaders = []
last_page = None

# Liste des mots-clés pour détecter les en-têtes principaux
header_keywords = [
    "MINISTERE",
    "COMMISSION",
    "CAISSE NATIONALE",
    "SOCIETE NATIONALE",
    "AUTORITE DE REGULATION",
    "UNIVERSITE",
    "AGENCE",
    "REGION",
    "GROUPEMENT D'INTERET",
    "RECTIFICATIF DES RESULTATS PROVISOIRES"
]

for page_idx, page in enumerate(t_document.pages):
    # Récupérer tous les blocs de la page
    current_page_blocks = []
    for rel in page.relationships:
        if rel.type == "CHILD":
            for block_id in rel.ids:
                if block_id in block_map:
                    current_page_blocks.append(block_map[block_id])

    # Détection des en-têtes et sous-en-têtes
    for block in current_page_blocks:
        if block.block_type == "LINE":
            block_text = get_block_text(block.id)
            if block_text:
                normalized_text = normalize_text(block_text)
                # Vérifier si c'est un en-tête principal
                if any(keyword in normalized_text for keyword in header_keywords):
                    last_headers = [block_text]
                    last_subheaders = []
                # Vérifier si c'est un sous-en-tête
                elif last_headers:
                    last_subheaders.append(block_text)

    # Traiter chaque table
    for block in current_page_blocks:
        if block.block_type == "TABLE":
            # Vérifier si c'est une continuation
            is_continuation = False
            if last_page == page.page and last_headers:
                if block.geometry.bounding_box.top > 0.8:
                    is_continuation = True

            # Récupérer les cellules
            cell_ids = []
            for rel in block.relationships:
                if rel.type == "CHILD":
                    cell_ids.extend(rel.ids)

            # Regrouper les cellules par ligne/colonne
            grid = {}  # {row_idx: {col_idx: cell_data}}
            max_col = 0

            for cell_id in cell_ids:
                if cell_id not in block_map:
                    continue
                cell = block_map[cell_id]
                if cell.block_type != "CELL":
                    continue

                row_idx = cell.row_index or 0
                col_idx = cell.column_index or 0
                col_span = cell.column_span or 1
                row_span = cell.row_span or 1

                # Trouver une case libre dans la grille
                while col_idx in grid.get(row_idx, {}):
                    col_idx += 1

                # Extraire le texte complet de la cellule
                cell_text = get_block_text(cell_id)

                # Remplir la grille avec les fusions
                for r in range(row_idx, row_idx + row_span):
                    if r not in grid:
                        grid[r] = {}
                    for c in range(col_idx, col_idx + col_span):
                        grid[r][c] = cell_text
                max_col = max(max_col, col_idx + col_span)

            # Déterminer les en-têtes (via majuscules ou mots-clés)
            headers = []
            data_start = 0

            if is_continuation and last_headers:
                headers = last_headers
                data_start = 0
            else:
                # Détecter les en-têtes via majuscules ou mots-clés
                header_rows = []
                for row_idx in sorted(grid.keys()):
                    row = grid[row_idx]
                    row_cells = [row.get(c, "") for c in range(max_col)]
                    if len(row_cells) > 1 and any(row_cells):
                        if all(normalize_text(cell).isupper() or "N°" in normalize_text(cell) or "ET" in normalize_text(cell) for cell in row_cells if cell):
                            header_rows.append(row_idx)
                        else:
                            data_start = row_idx
                            break

                # Fusionner les en-têtes multi-lignes
                if header_rows:
                    merged_headers = []
                    for col_idx in range(max_col):
                        merged_text = ""
                        for row_idx in header_rows:
                            if col_idx in grid.get(row_idx, {}):
                                text = grid[row_idx][col_idx]
                                if text:
                                    merged_text += " " + text if merged_text else text
                        merged_headers.append(merged_text or f"col_{col_idx}")
                    headers = merged_headers
                    last_headers = headers
                else:
                    headers = [f"col_{i}" for i in range(max_col)]
                    last_headers = None

            # Mapper les données aux en-têtes
            table_data = {
                "table_number": len(tables_data) + 1,
                "page": block.page,
                "headers": last_headers.copy() if last_headers else [],
                "subheaders": last_subheaders.copy() if last_subheaders else [],
                "is_continuation": is_continuation,
                "rows": []
            }

            # Ajouter les lignes de données
            for row_idx in sorted(grid):
                if row_idx < data_start:
                    continue
                row = grid[row_idx]
                row_dict = {}
                col_idx = 0
                while col_idx < max_col:
                    if col_idx in row:
                        key = headers[col_idx] if col_idx < len(headers) else f"col_{col_idx}"
                        row_dict[key] = row[col_idx]
                    col_idx += 1
                if row_dict:
                    table_data["rows"].append(row_dict)

            tables_data.append(table_data)
            # Réinitialiser les sous-en-têtes après une table non continue
            if not is_continuation:
                last_subheaders = []

    last_page = page.page

# Écrire dans un fichier JSON
output_file = "structured_with_headers_and_fusions.json"
with open(output_file, "w", encoding="utf-8") as f:
    json.dump(tables_data, f, ensure_ascii=False, indent=2)

print(f"\n✅ Données exportées dans '{output_file}' avec gestion des fusions")