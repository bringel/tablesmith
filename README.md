# Tablesmith

Tablesmith is a tool that takes files that describe your database schema and some data, and inserts the data into your database. It is designed to be used to initially seed your database if your database is designed to hold mostly static data. In addition to easily adding data, Tablesmith takes care of finding linked records to you by text searching a column in the linked table and creating the mapping for you

## Tablesmith file format

Tablesmith reads both JSON and YAML formatted files with the following structure:

```json
{
  "table": {
    "tableName": "<table name>",
    "columns": [
      {
        "name": "<column name>",
        "type": "<column data type",
        "linkTo": "<linked table name>",
        "linkType": "one-to-one | one-to-many | many-to-many",
        "linkToColumnName": "<column in linked table to match on"
      }
    ]
  },
  "data": [

  ]
}
```
