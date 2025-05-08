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

# Charger le JSON Textract
with open('test.json', 'r', encoding='utf-8') as f:
    blocks = json.load(f)

# Filtrer les lignes sur les pages 54+
lines = [
    b for b in blocks["Blocks"]
    if b.get('BlockType') == 'LINE' and b.get('Page') >= 54
]
lines.sort(key=lambda b: (b['Page'], b['Geometry']['BoundingBox']['Top']))

results = []
current_doc = {}
top_position = None
bottom_position = None
last_page = None

def finalize_current_doc():
    if 'reference' in current_doc and current_doc.get('full_text', '').strip():
        print(f"✅ Sauvegarde: {current_doc.get('reference')} ({current_doc.get('entity')})")
        current_doc['hash_id'] = hashlib.md5(current_doc['reference'].encode()).hexdigest()
        current_doc['source_position'] = {
            'top': top_position,
            'bottom': bottom_position
        }
        results.append(current_doc.copy())

for i, b in enumerate(lines):
    text = b['Text'].strip()
    page = b['Page']
    normalized_text = normalize_text(text)
    if normalized_text in ["DES MINISTERES ET INSTITUTIONS", "DES COLLECTIVITES TERRITORIALES", "APPELS D'OFFRES"]:
        continue

    # Si changement de page, sauvegarder ce qu’on a (si valide)
    if last_page is not None and page != last_page and 'entity' in current_doc:
        finalize_current_doc()
        current_doc = {}
    last_page = page

    # Nouveau début de document
    if any(keyword in normalized_text for keyword in header_keywords) and len(normalized_text.split()) > 2:
        finalize_current_doc()
        current_doc = {
            'full_text': '',
            'source_page': page,
            'entity': text,
        }
        top_position = b['Geometry']['BoundingBox']['Top']
        bottom_position = b['Geometry']['BoundingBox']['Top']
        continue

    if 'entity' in current_doc:
        current_doc['full_text'] += ' ' + text
        bottom_position = b['Geometry']['BoundingBox']['Top']

        if text.startswith('Avis'):
            current_doc['type'] = text
        if match := re.match(r'^(n[°ºo]?\s*)?\d{4}[-/]\d+', normalized_text, re.IGNORECASE):
            current_doc['reference'] = match.group(0)
        if 'objet' in text.lower() and 'objet' not in current_doc:
            current_doc['objet'] = text
        if text.lower().startswith('financement'):
            current_doc['financement'] = text
        if re.match(r'^\s*Le délai d\'exécution', text):
            current_doc['delaiExecution'] = text
        if text.lower().startswith('lot'):
            current_doc.setdefault('lots', []).append(text)

# Sauvegarder le dernier document
finalize_current_doc()

# Export JSON
with open('appels_offres_extraits.json', 'w', encoding='utf-8') as f:
    json.dump(results, f, indent=2, ensure_ascii=False)

print(f"{len(results)} appels d'offres extraits.")
