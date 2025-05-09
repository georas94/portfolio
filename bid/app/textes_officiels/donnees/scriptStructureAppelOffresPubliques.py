import json
import re
import unicodedata
import hashlib

header_keywords = [
    "ACADEMIE",
    "AGENCE",
    "BUREAU",
    "CAISSE",
    "CENTRE",
    "COMMISSION",
    "COMMUNE",
    "ECOLE",
    "FONDS",
    "INSTITUT",
    "MINISTERE",
    "PROJET",
    "OFFICE",
    "REGION",
    "SECRETARIAT",
    "UNIVERSITE",
    "CENTRE-SUD",
    "AUTORITE DE REGULATION",
    "GROUPEMENT D'INTERET",
    "Groupement d'Interet",
    "LA POSTE BURKINA FASO",
    "SOCIETE NATIONALE",
    "RECTIFICATIF DES RESULTATS PROVISOIRES"
]

def is_valid_entity(text: str) -> bool:
    # Exclusion par motif explicite
    exclusion_patterns = [
        r"^L'HABITAT DU.*",
        r"^CONSTITUTION D.*",
        r"^FOURNITURES DE.*",
        r"^PRESTATIONS DE.*",
        r"^LES DEMANDES DE.*",
    ]
    for pattern in exclusion_patterns:
        if re.match(pattern, text, re.IGNORECASE):
            return False

    upper = text.upper()
    # Si c'est exactement un header_keyword, on accepte même si un seul token
    if upper in header_keywords:
        return True

    # Ne doit pas être trop court
    if len(text.split()) < 2:
        return False

    # Doit commencer par un mot-clé fort
    for kw in header_keywords:
        if text.startswith(kw):
            return True

    return False

def normalize_text(text: str) -> str:
    if not text:
        return ""
    return unicodedata.normalize("NFKD", text).encode("ascii", "ignore").decode("utf-8").strip()

# Charger le JSON Textract
with open('textract4122-4123.json', 'r', encoding='utf-8') as f:
    blocks = json.load(f)

# Filtrer les lignes sur les pages 54+
lines = [
    b for b in blocks["Blocks"]
    if b.get('BlockType') == 'LINE' and b.get('Page') >= 24
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
#     if last_page is not None and page != last_page and 'entity' in current_doc:
#         finalize_current_doc()
#         current_doc = {}
#     last_page = page

    # Nouveau début de document
    validEntity = is_valid_entity(normalized_text)

    if validEntity:
        # Si on a déjà un doc en cours, on le sauvegarde
        if 'entity' in current_doc and current_doc.get('full_text', '').strip():
            finalize_current_doc()
        # On commence un nouveau document
        current_doc = {
            'full_text': '',
            'source_page': page,
            'entity': text,
        }
        top_position = b['Geometry']['BoundingBox']['Top']
        bottom_position = b['Geometry']['BoundingBox']['Top']
    else:
        if 'entity' in current_doc:
            current_doc['full_text'] += ' ' + text
            bottom_position = b['Geometry']['BoundingBox']['Top']

            documentNumberMatch = re.search(r"N[°º]?\s*(\d+)(?:\s*\((bis)\))?.*?(\d{4})", text, re.IGNORECASE)
#             if documentNumberMatch:
#                 numero = documentNumberMatch.group(1)
#                 bis = documentNumberMatch.group(2)
#                 annee = documentNumberMatch.group(3)
#
#                 bis_suffix = "-bis" if bis else ""
#                 current_doc['reference_number'] = f"offre-{numero}{bis_suffix}-{annee}"
            current_doc['reference_number'] = "offre-4122-4123-2025"
            if text.startswith('Avis'):
                current_doc['type'] = text

            reference_match = re.search(
                r'(?:(?:AAOO[I|N])?\s*)?(?:N[°ºo]?\s*|No\s*|n°\s*|:)?\s*(\d{4}[-/]?\d{2,4}[^\s]*)|(\d{1,4}[-/]\d{4}[^\s]*)',
                text,
                re.IGNORECASE
            )
            if reference_match:
                # Combine les groupes, filtre les None
                reference = next((g for g in reference_match.groups() if g), None)
                current_doc['reference'] = reference
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
with open('offre-4122-4123-2025.json', 'w', encoding='utf-8') as f:
    json.dump(results, f, indent=2, ensure_ascii=False)

print(f"{len(results)} appels d'offres extraits.")
