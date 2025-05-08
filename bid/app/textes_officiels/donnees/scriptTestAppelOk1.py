import json
import re
import unicodedata
import hashlib

header_keywords = [
    "MINISTERE",
    "COMMISSION",
    "CAISSE NATIONALE",
    "SOCIETE NATIONALE",
    "AUTORITE DE REGULATION",
    "UNIVERSITE",
    "CENTRE",
    "AGENCE",
    "REGION",
    "GROUPEMENT D'INTERET",
    "RECTIFICATIF DES RESULTATS PROVISOIRES"
]

def normalize_text(text: str) -> str:
    if not text:
        return ""
    return unicodedata.normalize("NFKD", text).encode("ascii", "ignore").decode("utf-8").strip()

# 1) Charger ton JSON Textract
with open('test.json', 'r', encoding='utf-8') as f:
    blocks = json.load(f)

# 2) Filtrer et trier les lignes utiles
lines = [
    b for b in blocks["Blocks"]
    if b.get('BlockType') == 'LINE' and b.get('Page') >= 53
]
lines.sort(key=lambda b: (b['Page'], b['Geometry']['BoundingBox']['Top']))

results = []
current_doc = {
    'full_text': '',
    'source_position': {},
}

def finalize_current_doc():
    if 'reference' in current_doc and current_doc['full_text'].strip():
        current_doc['hash_id'] = hashlib.md5(current_doc['reference'].encode()).hexdigest()
        current_doc['source_position'] = {
            'top': top_position,
            'bottom': bottom_position
        }
        results.append(current_doc.copy())

# 3) Parcourir ligne par ligne
top_position = None
bottom_position = None

for i, b in enumerate(lines):
    text = b['Text'].strip()
    page = b['Page']
    normalized_text = normalize_text(text)
    if normalized_text in ["DES MINISTERES ET INSTITUTIONS", "APPELS D'OFFRES"]:
        continue

    # Nouvelle entité détectée ? On sauvegarde l’actuel
    if any(keyword in normalized_text for keyword in header_keywords):
        finalize_current_doc()
        current_doc = {
            'full_text': '',
            'source_page': page,
            'entity': text,
        }
        top_position = b['Geometry']['BoundingBox']['Top']
        bottom_position = b['Geometry']['BoundingBox']['Top']
        continue

    # Si on est dans un doc en cours
    if 'entity' in current_doc:
        current_doc['full_text'] += ' ' + text
        bottom_position = b['Geometry']['BoundingBox']['Top']

        if text.startswith('Avis'):
            current_doc['type'] = text
        if match := re.match(r'^N[°º]\s*\d+[-/]\d+.*', text):
            current_doc['reference'] = match.group(0)
        if 'objet' in text.lower() and 'objet' not in current_doc:
            current_doc['objet'] = text
        if text.lower().startswith('financement'):
            current_doc['financement'] = text
        if re.match(r'^\s*Le délai d\'exécution', text):
            current_doc['delaiExecution'] = text
        if text.lower().startswith('lot'):
            current_doc.setdefault('lots', []).append(text)

# Dernier document
finalize_current_doc()

# 4) Sauvegarde JSON
with open('appels_offres_extraits.json', 'w', encoding='utf-8') as f:
    json.dump(results, f, indent=2, ensure_ascii=False)

print(f"{len(results)} appels d'offres extraits.")
