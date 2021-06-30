# DBML parser written on PHP8

[![Support me on Patreon](https://img.shields.io/endpoint.svg?url=https%3A%2F%2Fshieldsio-patreon.vercel.app%2Fapi%3Fusername%3Dbutschster%26type%3Dpatrons&style=flat)](https://patreon.com/butschster)
[![Latest Stable Version](https://poser.pugx.org/butschster/dbml-parser/v/stable)](https://packagist.org/packages/butschster/dbml-parser)
[![Total Downloads](https://poser.pugx.org/butschster/dbml-parser/downloads)](https://packagist.org/packages/butschster/dbml-parser)
[![License](https://poser.pugx.org/butschster/dbml-parser/license)](https://packagist.org/packages/butschster/dbml-parser)

DBML (database markup language) is a simple, readable DSL language designed to define database structures. This page
outlines the full syntax documentations of DBML.

**See** https://www.dbml.org

Work on this parser inspired by service - https://dbdiagram.io/ I like using db diagram service for visualizing database
structure. It will be great to use db diagram to build database schema and then convert it to Object tree and then
generate, for example, Laravel models and migrations.

For parsing dbml structure I used a very useful php package - https://phplrt.org.

## Features

- DBML parser

## Requirements

- PHP 8.0 and above

## Quick start

From the command line run

```shell
composer require butschster/dbml-parser
```

That's it!

## Usage

```php
use Butschster\Dbml\DbmlParserFactory;

$parser = DbmlParserFactory::create();

$schema = $parser->parse(<<<DBML
    Project test {
        database_type: 'PostgreSQL'
        Note: 'Description of the project'
    }
    
    //// -- LEVEL 1
    //// -- Tables and References
    
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
    
    Table merchants {
        id int
    }
    
    Table countries {
        code int [pk]
        name varchar
        continent_name varchar
    }
    
    // Creating references
    // You can also define relationship separately
    // > many-to-one; < one-to-many; - one-to-one
    Ref{
        U.country_code > countries.code
        merchants.country_code > countries.code
    }
    
    //----------------------------------------------//
    
    //// -- LEVEL 2
    //// -- Adding column settings
    
    Table order_items {
        order_id int [ref: > orders.id]
        product_id int
        quantity int [default: 1] // default value
    }
    
    Ref: order_items.product_id > products.id
    
    Table orders {
        id int [pk] // primary key
        user_id int [not null, unique]
        status varchar
        created_at varchar [note: '''When order created'''] // add column note
    }
    
    Table int {
        id int
    }
    
    //----------------------------------------------//
    
    //// -- Level 3
    //// -- Enum, Indexes
    
    // Enum for 'products' table below
    Enum products_status {
        out_of_stock
        in_stock
        running_low [note: 'less than 20'] // add column note
    }
    
    // Indexes: You can define a single or multi-column index
    Table products {
        id int [pk]
        name varchar
        merchant_id int [not null]
        price int
        status products_status
        created_at datetime [default: `now()`]
    
        Indexes {
            (merchant_id, status) [name:'product_status', type: hash]
            id [unique]
        }
    }
    
    Ref: products.merchant_id > merchants.id // many-to-one
    
    TableGroup hello_world {
        just_test
        just_a_test
    }

    DBML
);
```

### Schema data

```php
// List of tables
$tables = $schema->getTables(); // \Butschster\Dbml\Ast\TableNode[]

// Check if table exists
$schema->hasTable('users');

// Get table by name
$table = $schema->getTable('users'); // \Butschster\Dbml\Ast\TableNode[]

// Get project data
$project = $schema->getProject(); // \Butschster\Dbml\Ast\ProjectNode

// Get table groups
$tableGroups = $schema->getTableGroups(); // \Butschster\Dbml\Ast\TableGroupNode[]

// Check if table group with given name exists
$schema->hasTableGroup('name');

// Get table group object by name
$tableGroup = $schema->getTableGroup('name'); // \Butschster\Dbml\Ast\TableGroupNode

// Get enums
$enums = $schema->getEnums(); // \Butschster\Dbml\Ast\EnumNode[]

// Check if enum with given name exists
$schema->hasEnum('name');

// Get enum object by name
$enum = $schema->getEnum('name'); // \Butschster\Dbml\Ast\EnumNode

// Get refs
$refs = $schema->getRefs(); // \Butschster\Dbml\Ast\RefNode[]
```

### Project data
```
Project test {
    database_type: 'PostgreSQL'
    Note: 'Description of the project'
}
```

```php
/** @var \Butschster\Dbml\Ast\ProjectNode $project */
$project = $schema->getProject();
$name = $project->getName(); // test
$note = $project->getNote(); // Description of the project

/** @var \Butschster\Dbml\Ast\Project\SettingNode $setting */
$setting = $project->getSetting('database_type');
$databaseType = $setting->getValue(); // PostgreSQL
$key = $setting->getKey(); // database_type
```

### Table data
```
Table users as U {
    id int [pk, unique, increment] // auto-increment
    full_name varchar [not null, unique, default: 1]
    created_at timestamp
    country_code int
    type int
    note int
    Note: 'khong hieu duoc'
}
```

```php
/** @var \Butschster\Dbml\Ast\TableNode $table */
$table = $schema->getTable('users');

$name = $table->getName(); // users
$alias = $table->getAlias(); // U

$note = $table->getNote(); // khong hieu duoc

// Get table columns
$columns = $table->getColumns(); // \Butschster\Dbml\Ast\Table\ColumnNode[]

// Check if table column exists
$table->hasColumn('id');

// Get column by name
$column = $table->getColumn('id');

// Get table indexes
$indexes = $table->getIndexes(); // \Butschster\Dbml\Ast\Table\IndexNode[]
```

### Table column data
```
Table users as U {
    id int [pk, unique, increment] // auto-increment
}
```

```php
/** @var \Butschster\Dbml\Ast\Table\ColumnNode $column */
$column = $schema->getTable('users')->getColumn('id');

$name = $column->getName(); // id
$type = $column->getType()->getName(); // int
$size = $column->getType()->getSize(); // null|int

$note = $column->getNote(); // string

$refs = $column->getRefs(); // \Butschster\Dbml\Ast\RefNode[]

/** @var \Butschster\Dbml\Ast\Values\IntNode $default */
$default = $column->getDefault(); 
$value = $default->getValue(); // 1

// Check if column is primary
$column->isPrimaryKey();

// Check if column is auto increment
$column->isIncrement();

// Check if column is unique
$column->isUnique();

// heck if column is nullable
$column->isNull();
```

### Table index data
```
Table products {
    id int [pk]
    name varchar
    merchant_id int [not null]
    price int
    status products_status
    created_at datetime [default: `now()`]
    
    Indexes {
        (merchant_id, status) [name:'product_status', type: hash]
        id [unique]
    }
}
```

```php
/** @var \Butschster\Dbml\Ast\Table\IndexNode $index */
$index = $schema->getTable('products')->getIndexes()[0];

/** @var \Butschster\Dbml\Ast\Values\StringNode[]|\Butschster\Dbml\Ast\Values\ExpressionNode[] $columns */
$columns = $index->getColumns();

count($columns); // 2

$column1 = $index->getColumns()[0]->getValue(); // merchant_id
$column2 = $index->getColumns()[1]->getValue(); // status

$type = $index->getType(); // hash
$name = $index->getName(); // product_status

$note = $index->getNote();

// Check if index is pk
$index->isPrimaryKey(); 

// Check if index is unique
$index->isUnique(); 
```

### Enum data
```
Enum products_status {
  out_of_stock
  in_stock
  running_low [note: 'less than 20'] // add column note
}
```

```php
/** @var \Butschster\Dbml\Ast\EnumNode $enum */
$enum = $schema->getEnum('products_status');

$name = $enum->getName(); // products_status

// Get amount of values
$enum->count(); // 3

// Check if enum contains value
$enum->hasValue('out_of_stock'); // true

// Get enum value object by name
$value = $enum->getValue('running_low'); //  \Butschster\Dbml\Ast\Enum\ValueNode

$note = $value->getNote();
$value = $value->getValue();
```

### Table group data
```
TableGroup hello_world {
    just_test
    just_a_test
}
```

```php
/** @var \Butschster\Dbml\Ast\TableGroupNode $group */
$group = $schema->getTableGroup('hello_world');

$name = $group->getName(); // hello_world

// Check if table with given name contains in this group
$group->hasTable('just_test');

// Get list of tables
$tables = $group->getTables(); // string[]
```

### Ref data
```
Ref optional_name: products.merchant_id > merchants.(id, name) [delete: cascade, update: no action]
```

```php
/** @var \Butschster\Dbml\Ast\RefNode $ref */
$ref = $schema->getRefs()[0];

$name = $ref->getName(); // optional_name

$type = $ref->getType(); // \Butschster\Dbml\Ast\Ref\Type\ManyToOneNode

$leftTable = $ref->getLeftTable(); // \Butschster\Dbml\Ast\Ref\LeftTableNode
$table = $leftTable->getTable(); // products
$columns = $leftTable->getColumns(); // ['merchant_id']

$rightTable = $ref->getRightTable(); // \Butschster\Dbml\Ast\Ref\RightTableNode
$table = $rightTable->getTable(); // merchants
$columns = $rightTable->getColumns(); // ['id', 'name']

$onDelete = $ref->getAction('delete');
$action = $onDelete->getAction(); // cascade

$onUpdate = $ref->getAction('update');
$action = $onUpdate->getAction(); // no action
```

# Enjoy!
