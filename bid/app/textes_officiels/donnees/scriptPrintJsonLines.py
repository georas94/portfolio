import json
from trp import Document
import sys

with open('textract4120bis.json', 'r', encoding='utf-8') as f:
    data = json.load(f)
doc = Document(data)

# Iterate over elements in the document
for page_index, page in enumerate(doc.pages, start=1):
    print(f"Page: {page_index}")  # Numérotation manuelle
    # Print lines
    for line in page.lines:
        print("Line: {}--{}".format(line.text, line.confidence))
         # Print words
#         for word in line.words:
#             print("Word: {}--{}".format(word.text, word.confidence))

    # Print tables
    for table in page.tables:
        for r, row in enumerate(table.rows):
            for c, cell in enumerate(row.cells):
                print("Table[{}][{}] = {}-{}".format(r, c, cell.text, cell.confidence))

    # Print fields
    for field in page.form.fields:
        print("Field: Key: {}, Value: {}".format(field.key.text, field.value.text))

    # Get field by key
    key = "Phone Number:"
    field = page.form.getFieldByKey(key)
    if(field):
        print("Field: Key: {}, Value: {}".format(field.key, field.value))

    # Search fields by key
    key = "address"
    fields = page.form.searchFieldsByKey(key)
    for field in fields:
        print("Field: Key: {}, Value: {}".format(field.key, field.value))
    if page_index == 8:
        sys.exit()  # Arrêt immédiat