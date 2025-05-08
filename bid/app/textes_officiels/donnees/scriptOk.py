import re
import json
from datetime import datetime
from collections import defaultdict

def finalize_structure(result):
    """Nettoyage final et consolidation des données"""
    # Fusion des sections multi-pages
    for page in result["pages"].values():
        new_sections = []
        current_type = None
        for section in page["sections"]:
            if section["type"] == current_type:
                new_sections[-1]["content"] += section["content"]
            else:
                new_sections.append(section)
                current_type = section["type"]
        page["sections"] = new_sections

    # Dédoublonnage des entités
    for key in result["entities"]:
        result["entities"][key] = list({v["nom"] if isinstance(v, dict) else v: v for v in result["entities"][key]}.values())

def detect_columns(sorted_cells):
    """Détecte les colonnes basées sur l'alignement horizontal"""
    columns = defaultdict(list)
    for cell in sorted_cells:
        center_x = cell['Geometry']['BoundingBox']['Left'] + cell['Geometry']['BoundingBox']['Width']/2
        columns[round(center_x, 3)].append(cell)
    return [sorted(col, key=lambda x: x['Geometry']['BoundingBox']['Top'])
            for _, col in sorted(columns.items())]

def process_table(table_block, all_blocks):
    """Version corrigée avec gestion des relations"""
    try:
        # Correction de la variable manquante
        table_geometry = table_block["Geometry"]
    except KeyError:
        raise ValueError("Table object malformé - geometry manquante")

    # Tri des cellules en utilisant les index de tableau
    try:
        sorted_cells = sorted(table_block["cells"],
                            key=lambda x: (x["RowIndex"], x["ColumnIndex"]))
    except KeyError as e:
        print(f"Cellule malformée dans le tableau {table_block['Id']}: {str(e)}")
        return None

    # Création de la structure de tableau
    table_data = {
        "id": table_block["Id"],
        "page": table_block.get("Page", 1),
        "rows": [],
        "bounding_box": extract_coordinates(table_block["Geometry"])
    }

    # Construction des rangées basée sur RowIndex
    current_row = None
    for cell in sorted_cells:
        if current_row != cell["RowIndex"]:
            table_data["rows"].append({"cells": []})
            current_row = cell["RowIndex"]

        # Récupération du contenu via les relations
        cell_content = get_cell_content(cell, all_blocks)

        table_data["rows"][-1]["cells"].append({
            "content": cell_content,
            "is_header": cell.get("EntityTypes", [""])[0] == "COLUMN_HEADER",
            "row_span": cell.get("RowSpan", 1),
            "col_span": cell.get("ColumnSpan", 1),
            "bounding_box": extract_coordinates(cell["Geometry"])
        })

    normalize_table_content(table_data)
    return table_data

def get_cell_content(cell, blocks):
    """Version corrigée utilisant les relations directes"""
    contents = []
    # Utiliser les relations enfant pour une meilleure précision
    for relationship in cell.get('Relationships', []):
        if relationship['Type'] == 'CHILD':
            for line_id in relationship['Ids']:
                line_block = next((b for b in blocks if b['Id'] == line_id), None)
                if line_block and line_block['BlockType'] == 'LINE':
                    contents.append({
                        "text": line_block['Text'],
                        "confidence": line_block.get('Confidence', 0)
                    })
    return {
        "raw": " ".join([c["text"] for c in contents]).strip(),
        "confidence_avg": sum(c["confidence"] for c in contents)/len(contents) if contents else 0
    }

def normalize_table_content(table_data):
    """Normalise les formats de données dans les cellules"""
    patterns = {
        'date': r'\d{2}/\d{2}/\d{4}',
        'montant': r'\d{1,3}(?: \d{3})* (?:FCFA|€|\$)',
        'reference': r'[A-Z]+-\d+/[A-Z]+/\d{4}'
    }

    for row in table_data['rows']:
        for cell in row['cells']:
            content = cell['content']['raw']
            cell['normalized'] = {}

            # Détection automatique des formats
            for key, pattern in patterns.items():
                if re.search(pattern, content):
                    cell['normalized'][key] = re.findall(pattern, content)[0]

def is_inside(child_geo, parent_geo):
    """Vérifie si une géométrie est contenue dans une autre avec tolérance"""
    tolerance = 0.02
    return (
        (child_geo["BoundingBox"]["Left"] >= parent_geo["BoundingBox"]["Left"] - tolerance) and
        (child_geo["BoundingBox"]["Left"] + child_geo["BoundingBox"]["Width"] <=
         parent_geo["BoundingBox"]["Left"] + parent_geo["BoundingBox"]["Width"] + tolerance) and
        (child_geo["BoundingBox"]["Top"] >= parent_geo["BoundingBox"]["Top"] - tolerance) and
        (child_geo["BoundingBox"]["Top"] + child_geo["BoundingBox"]["Height"] <=
         parent_geo["BoundingBox"]["Top"] + parent_geo["BoundingBox"]["Height"] + tolerance)
    )

def extract_coordinates(geometry):
    """Convertit la géométrie en coordonnées structurées"""
    return {
        "left": geometry["BoundingBox"]["Left"],
        "top": geometry["BoundingBox"]["Top"],
        "width": geometry["BoundingBox"]["Width"],
        "height": geometry["BoundingBox"]["Height"],
        "polygon": [(p["X"], p["Y"]) for p in geometry["Polygon"]]
    }

def parse_textract_data(input_data):
    result = {
        "metadata": {
            "total_pages": input_data["DocumentMetadata"]["Pages"],
            "source": "test.json",
            "processing_date": datetime.now().isoformat(),
            "document_type": "Appel d'offres"
        },
        "pages": defaultdict(lambda: {
            "page_number": None,
            "sections": [],
            "contacts": {}
        }),
        "entities": {
            "dates": [],
            "organisations": [],
            "lieux": [],
            "urls": [],
            "responsables": []
        },
        "tables": []
    }
    # Détection améliorée des tableaux
    result["tables"] = []
    tables = []
    current_table = None
    # Première passe des tableaux
    for block in input_data["Blocks"]:
        if block["BlockType"] == "TABLE":
            # Créer une nouvelle entrée tableau avec géométrie
            table_obj = {
                "Id": block["Id"],
                "Geometry": block["Geometry"],
                "Page": block.get("Page", 1),
                "cells": []
            }
            tables.append(table_obj)
            current_table = table_obj
        elif block["BlockType"] == "CELL" and current_table:
            current_table["cells"].append(block)

    print(f"Nombre de tableaux détectés: {len(tables)}")
    for i, table in enumerate(tables):
        print(f"Tableau {i+1}:")
        print(f"- ID: {table['Id']}")
        print(f"- Cellules: {len(table['cells'])}")
        print(f"- Page: {table.get('Page', 1)}")

    for table in tables:  # Utiliser la liste 'tables' qu'on a construite
        processed_table = process_table(table, input_data["Blocks"])
        if processed_table:
            result["tables"].append(processed_table)

    # Traitement des autres éléments (nécessaire pour remplir les pages)
    for block in input_data["Blocks"]:
        if block["BlockType"] == "LINE":
            finalize_structure(result)
    return result

# [Les autres fonctions restent inchangées...]
if __name__ == "__main__":
    with open('test.json', 'r', encoding='utf-8') as f:
        data = json.load(f)

    structured_data = parse_textract_data(data)

    with open('structured_offres.json', 'w', encoding='utf-8') as f:
        json.dump(structured_data, f, indent=2, ensure_ascii=False)
        print("\n✅ Terminé ! Résultat dans 'structured_offres.json'.")