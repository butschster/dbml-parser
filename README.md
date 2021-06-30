# DBML (database markup language) PHP8 parser.

DBML (database markup language) is a simple, readable DSL language designed to define database structures. This page
outlines the full syntax documentations of DBML.

**See** https://www.dbml.org

Work on this parser was inspired by service - https://dbdiagram.io It will be great to use dbdiagram to build database
schema and then convert it to Object tree and then generate for example Laravel models and migrations.

```php

use Butschster\Dbml\DbmlParserFactory;

$parser = DbmlParserFactory::createFromFile(__DIR__.'/src/grammar.php');

$structure = $parser->parse(<<<DBML
Project test {
  database_type: 'PostgreSQL'
  Note: 'Description of the project'
}

// Creating tables
Table users as U {
  id int [pk, unique, increment] // auto-increment
  full_name varchar [not null, unique, default: 1]
  created_at timestamp
  country_code int
  type int
  note int
  Note: 'khong hieu duoc'
}
DBML
);

var_dump($structure);
```
