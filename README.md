# DBML Parser for PHP

[![Support me on Patreon](https://img.shields.io/endpoint.svg?url=https%3A%2F%2Fshieldsio-patreon.vercel.app%2Fapi%3Fusername%3Dbutschster%26type%3Dpatrons&style=flat)](https://patreon.com/butschster)
[![Latest Stable Version](https://poser.pugx.org/butschster/dbml-parser/v/stable)](https://packagist.org/packages/butschster/dbml-parser)
[![Build Status](https://github.com/butschster/dbml-parser/actions/workflows/tests.yml/badge.svg)](https://github.com/butschster/dbml-parser/actions/workflows/tests.yml)
[![Total Downloads](https://poser.pugx.org/butschster/dbml-parser/downloads)](https://packagist.org/packages/butschster/dbml-parser)
[![License](https://poser.pugx.org/butschster/dbml-parser/license)](https://packagist.org/packages/butschster/dbml-parser)

![DBML-parser](https://user-images.githubusercontent.com/773481/125667174-8b349bc0-fb5f-49a2-a651-1cac06bba151.jpg)

A production-ready PHP 8.3+ parser for [DBML (Database Markup Language)](https://www.dbml.org/), transforming
human-readable database schemas into structured PHP objects. Generate migrations, ORM entities, documentation, or
visualization tools from a single DBML source.

## Table of Contents

- [Why DBML Parser?](#why-dbml-parser)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Core Concepts](#core-concepts)
- [Complete API Reference](#complete-api-reference)
    - [Schema Operations](#schema-operations)
    - [Project Definition](#project-definition)
    - [Table Operations](#table-operations)
    - [Column Properties](#column-properties)
    - [Index Configuration](#index-configuration)
    - [Enum Management](#enum-management)
    - [Table Groups](#table-groups)
    - [Relationships (Refs)](#relationships-refs)
- [Advanced Usage](#advanced-usage)
- [Use Cases](#use-cases)
- [Error Handling](#error-handling)
- [Contributing](#contributing)
- [Credits](#credits)

## Why DBML Parser?

DBML (Database Markup Language) is a simple, readable DSL for defining database structures. This parser enables you to:

- **Version Control Database Schemas**: Store your database design in git-friendly text format
- **Generate Code Automatically**: Create ORM entities, migrations, models, and documentation from DBML
- **Visualize Database Design**: Build interactive schema diagrams and documentation sites
- **Share Database Specs**: Communicate database structure with teams using human-readable syntax
- **Build Schema Tools**: Create custom tools for schema validation, transformation, or analysis

This library was inspired by [dbdiagram.io](https://dbdiagram.io/) and built using the
powerful [phplrt](https://phplrt.org) parser toolkit.

## Installation

**Requirements:**

- PHP 8.3 or higher
- Composer

Install via Composer:

```bash
composer require butschster/dbml-parser
```

## Quick Start

Parse a DBML schema and access its components:

```php
use Butschster\Dbml\DbmlParserFactory;

// Create parser instance
$parser = DbmlParserFactory::create();

// Parse DBML string
$schema = $parser->parse(<<<DBML
    Project ecommerce {
        database_type: 'PostgreSQL'
        Note: 'E-commerce database schema'
    }
    
    Table users {
        id int [pk, increment]
        email varchar(255) [unique, not null]
        created_at timestamp [default: `now()`]
    }
    
    Table orders {
        id int [pk, increment]
        user_id int [not null, ref: > users.id]
        status order_status
        total decimal(10,2)
    }
    
    Enum order_status {
        pending
        processing
        shipped
        delivered
    }
DBML);

// Access schema components
foreach ($schema->getTables() as $table) {
    echo "Table: {$table->getName()}\n";
    
    foreach ($table->getColumns() as $column) {
        echo "  - {$column->getName()}: {$column->getType()->getName()}\n";
    }
}
```

## Core Concepts

The parser transforms DBML into an Abstract Syntax Tree (AST) with these key node types:

| Node Type        | Purpose                          | Example                             |
|------------------|----------------------------------|-------------------------------------|
| `SchemaNode`     | Root container for entire schema | Top-level access to all components  |
| `ProjectNode`    | Project metadata and settings    | Database type, version, notes       |
| `TableNode`      | Table definition with columns    | `Table users { ... }`               |
| `ColumnNode`     | Column with type and constraints | `id int [pk, not null]`             |
| `IndexNode`      | Single or composite index        | `Indexes { (col1, col2) [unique] }` |
| `EnumNode`       | Enum type definition             | `Enum status { active, inactive }`  |
| `RefNode`        | Foreign key relationship         | `Ref: orders.user_id > users.id`    |
| `TableGroupNode` | Logical grouping of tables       | `TableGroup core { users, roles }`  |

## Complete API Reference

### Schema Operations

The `SchemaNode` is your entry point for accessing all parsed components.

#### Get All Tables

```php
/** @var \Butschster\Dbml\Ast\SchemaNode $schema */

// Get all tables as array
$tables = $schema->getTables();
// Returns: TableNode[]

foreach ($tables as $table) {
    echo $table->getName() . "\n";
}
```

#### Get Specific Table

```php
// Check if table exists
if ($schema->hasTable('users')) {
    $table = $schema->getTable('users');
    // Returns: TableNode
}

// Throws TableNotFoundException if not found
try {
    $table = $schema->getTable('nonexistent');
} catch (\Butschster\Dbml\Exceptions\TableNotFoundException $e) {
    // Handle missing table
}
```

#### Access Project Metadata

```php
// Check if project is defined
if ($schema->hasProject()) {
    $project = $schema->getProject();
    // Returns: ProjectNode|null
}
```

#### Get Table Groups

```php
// Get all table groups
$groups = $schema->getTableGroups();
// Returns: TableGroupNode[]

// Check specific group
if ($schema->hasTableGroup('core_tables')) {
    $group = $schema->getTableGroup('core_tables');
    // Returns: TableGroupNode
}

// Throws TableGroupNotFoundException if not found
```

#### Get Enums

```php
// Get all enums
$enums = $schema->getEnums();
// Returns: EnumNode[]

// Access specific enum
if ($schema->hasEnum('user_status')) {
    $enum = $schema->getEnum('user_status');
    // Returns: EnumNode
}

// Throws EnumNotFoundException if not found
```

#### Get Relationships

```php
// Get all foreign key relationships
$refs = $schema->getRefs();
// Returns: RefNode[]

foreach ($refs as $ref) {
    $leftTable = $ref->getLeftTable()->getTable();
    $rightTable = $ref->getRightTable()->getTable();
    echo "{$leftTable} references {$rightTable}\n";
}
```

**Complete Schema Example:**

```php
use Butschster\Dbml\Ast\SchemaNode;

/** @var SchemaNode $schema */

// Project information
$project = $schema->getProject();
$dbType = $project?->getSetting('database_type')->getValue();

// All components
$allTables = $schema->getTables();        // All table definitions
$allEnums = $schema->getEnums();          // All enum types
$allRefs = $schema->getRefs();            // All relationships
$allGroups = $schema->getTableGroups();   // All table groups

// Component counts
$tableCount = count($allTables);
$enumCount = count($allEnums);
$refCount = count($allRefs);

echo "Database: {$dbType}, Tables: {$tableCount}, Enums: {$enumCount}\n";
```

### Project Definition

The `ProjectNode` stores database-level metadata and configuration.

**DBML Syntax:**

```dbml
Project my_app {
    database_type: 'PostgreSQL'
    note: 'Application database schema'
}
```

#### Access Project Properties

```php
/** @var \Butschster\Dbml\Ast\ProjectNode $project */
$project = $schema->getProject();

// Get project name
$name = $project->getName();
// Returns: string (e.g., 'my_app')

// Get project note
$note = $project->getNote();
// Returns: string|null

// Get all settings
$settings = $project->getSettings();
// Returns: SettingNode[]
```

#### Access Project Settings

```php
// Check if setting exists
if ($project->hasSetting('database_type')) {
    $setting = $project->getSetting('database_type');
    // Returns: SettingNode
    
    $key = $setting->getKey();     // 'database_type'
    $value = $setting->getValue();  // 'PostgreSQL'
}

// Throws ProjectSettingNotFoundException if not found
try {
    $setting = $project->getSetting('unknown_setting');
} catch (\Butschster\Dbml\Exceptions\ProjectSettingNotFoundException $e) {
    // Handle missing setting
}
```

#### Get Node Position

```php
// Get offset in source DBML for debugging
$offset = $project->getOffset();
// Returns: int (character position in parsed string)
```

**Complete Project Example:**

```php
use Butschster\Dbml\Ast\ProjectNode;

/** @var ProjectNode $project */

echo "Project: {$project->getName()}\n";
echo "Note: {$project->getNote()}\n\n";

echo "Settings:\n";
foreach ($project->getSettings() as $setting) {
    echo "  {$setting->getKey()}: {$setting->getValue()}\n";
}

// Common settings to check
$dbType = $project->hasSetting('database_type') 
    ? $project->getSetting('database_type')->getValue() 
    : 'unknown';

$version = $project->hasSetting('version')
    ? $project->getSetting('version')->getValue()
    : null;
```

### Table Operations

The `TableNode` represents a database table with columns, indexes, and relationships.

**DBML Syntax:**

```dbml
Table users as U {
    id int [pk, increment]
    email varchar(255) [unique, not null]
    created_at timestamp
    
    Note: 'User accounts'
    
    Indexes {
        email [unique]
        (email, created_at) [name: 'email_created_idx']
    }
}
```

#### Access Table Properties

```php
/** @var \Butschster\Dbml\Ast\TableNode $table */
$table = $schema->getTable('users');

// Table name
$name = $table->getName();
// Returns: string (e.g., 'users')

// Table alias (from "as U")
$alias = $table->getAlias();
// Returns: string|null (e.g., 'U')

// Table note
$note = $table->getNote();
// Returns: string|null

// Source position
$offset = $table->getOffset();
// Returns: int
```

#### Get Table Columns

```php
// Get all columns
$columns = $table->getColumns();
// Returns: ColumnNode[] (associative array keyed by column name)

foreach ($columns as $columnName => $column) {
    echo "{$columnName}: {$column->getType()->getName()}\n";
}

// Check if column exists
if ($table->hasColumn('email')) {
    $column = $table->getColumn('email');
    // Returns: ColumnNode
}

// Throws ColumnNotFoundException if not found
try {
    $column = $table->getColumn('nonexistent');
} catch (\Butschster\Dbml\Exceptions\ColumnNotFoundException $e) {
    // Handle missing column
}
```

#### Get Table Indexes

```php
// Get all indexes
$indexes = $table->getIndexes();
// Returns: IndexNode[]

foreach ($indexes as $index) {
    $columns = $index->getColumns();
    $indexName = $index->getName();
    $isPrimary = $index->isPrimaryKey();
    $isUnique = $index->isUnique();
}
```

**Complete Table Example:**

```php
use Butschster\Dbml\Ast\TableNode;

/** @var TableNode $table */

echo "Table: {$table->getName()}";
if ($alias = $table->getAlias()) {
    echo " (alias: {$alias})";
}
echo "\n";

if ($note = $table->getNote()) {
    echo "Note: {$note}\n";
}

echo "\nColumns:\n";
foreach ($table->getColumns() as $column) {
    $type = $column->getType()->getName();
    $size = $column->getType()->getSize();
    $nullable = $column->isNull() ? 'NULL' : 'NOT NULL';
    $pk = $column->isPrimaryKey() ? '[PK]' : '';
    
    echo "  {$column->getName()} {$type}";
    if ($size) {echo "({$size})";}
    echo " {$nullable} {$pk}\n";
}

echo "\nIndexes:\n";
foreach ($table->getIndexes() as $index) {
    $indexType = $index->isPrimaryKey() ? 'PRIMARY' : ($index->isUnique() ? 'UNIQUE' : 'INDEX');
    $cols = implode(', ', array_map(fn($c) => $c->getValue(), $index->getColumns()));
    echo "  {$indexType} ({$cols})";
    if ($name = $index->getName()) {echo " [{$name}]";}
    echo "\n";
}
```

### Column Properties

The `ColumnNode` represents a table column with its type, constraints, and metadata.

**DBML Syntax:**

```dbml
Table products {
    id int [pk, increment]
    name varchar(255) [not null]
    price decimal(10,2) [default: 0.00]
    status product_status [not null]
    created_at timestamp [default: `now()`]
    note: 'Product catalog'
}
```

#### Access Basic Properties

```php
/** @var \Butschster\Dbml\Ast\Table\ColumnNode $column */
$column = $table->getColumn('price');

// Column name
$name = $column->getName();
// Returns: string (e.g., 'price')

// Source position
$offset = $column->getOffset();
// Returns: int

// Column note
$note = $column->getNote();
// Returns: string|null
```

#### Get Column Type

```php
// Get type information
$type = $column->getType();
// Returns: TypeNode

$typeName = $type->getName();
// Returns: string (e.g., 'decimal', 'varchar', 'int')

$size = $type->getSize();
// Returns: int|null (first size parameter, e.g., 10 from decimal(10,2))

$sizeArray = $type->getSizeArray();
// Returns: int[] (all size parameters, e.g., [10, 2] from decimal(10,2))

$offset = $type->getOffset();
// Returns: int
```

**Type Examples:**

```php
// varchar(255)
$type->getName();      // 'varchar'
$type->getSize();      // 255
$type->getSizeArray(); // [255]

// decimal(10,2)
$type->getName();      // 'decimal'
$type->getSize();      // 10
$type->getSizeArray(); // [10, 2]

// int (no size)
$type->getName();      // 'int'
$type->getSize();      // null
$type->getSizeArray(); // []
```

#### Check Column Constraints

```php
// Primary key
$isPrimaryKey = $column->isPrimaryKey();
// Returns: bool

// Auto-increment
$isIncrement = $column->isIncrement();
// Returns: bool

// Unique constraint
$isUnique = $column->isUnique();
// Returns: bool

// Nullable
$isNullable = $column->isNull();
// Returns: bool (true = NULL, false = NOT NULL)
```

#### Get Default Value

```php
// Get default value
$default = $column->getDefault();
// Returns: AbstractValue|null

if ($default !== null) {
    $value = $default->getValue();
    // Type depends on value node:
    // - IntNode: int
    // - FloatNode: float
    // - StringNode: string|int|float|bool
    // - BooleanNode: bool
    // - NullNode: null
    // - ExpressionNode: string (e.g., 'now()')
}
```

**Default Value Types:**

```php
use Butschster\Dbml\Ast\Values\{IntNode, FloatNode, StringNode, BooleanNode, NullNode, ExpressionNode};

$default = $column->getDefault();

// Check value type
if ($default instanceof IntNode) {
    $intValue = $default->getValue(); // int
}

if ($default instanceof FloatNode) {
    $floatValue = $default->getValue(); // float
}

if ($default instanceof StringNode) {
    $stringValue = $default->getValue(); // string|int|float|bool
}

if ($default instanceof BooleanNode) {
    $boolValue = $default->getValue(); // bool
}

if ($default instanceof NullNode) {
    $nullValue = $default->getValue(); // null
}

if ($default instanceof ExpressionNode) {
    $expression = $default->getValue(); // string (e.g., 'now()')
}
```

#### Get Additional Settings

```php
// Get custom settings (beyond standard constraints)
$settings = $column->getSettings();
// Returns: SettingWithValueNode[]

foreach ($settings as $setting) {
    $name = $setting->getName();   // string
    $value = $setting->getValue(); // AbstractValue
}
```

#### Get Column Relationships

```php
// Get foreign key references defined inline
$refs = $column->getRefs();
// Returns: RefNode[]

foreach ($refs as $ref) {
    $rightTable = $ref->getRightTable()->getTable();
    $rightColumns = $ref->getRightTable()->getColumns();
}
```

**Complete Column Example:**

```php
use Butschster\Dbml\Ast\Table\ColumnNode;

/** @var ColumnNode $column */

// Basic info
echo "Column: {$column->getName()}\n";
echo "Type: {$column->getType()->getName()}";
if ($size = $column->getType()->getSize()) {
    echo "({$size})";
}
echo "\n";

// Constraints
$constraints = [];
if ($column->isPrimaryKey()) {$constraints[] = 'PRIMARY KEY';}
if ($column->isIncrement()) {$constraints[] = 'AUTO_INCREMENT';}
if ($column->isUnique()) {$constraints[] = 'UNIQUE';}
if (!$column->isNull()) {$constraints[] = 'NOT NULL';}

if (!empty($constraints)) {
    echo "Constraints: " . implode(', ', $constraints) . "\n";
}

// Default value
if ($default = $column->getDefault()) {
    $defaultValue = $default->getValue();
    echo "Default: ";
    if ($default instanceof \Butschster\Dbml\Ast\Values\ExpressionNode) {
        echo "`{$defaultValue}`";
    } else {
        echo var_export($defaultValue, true);
    }
    echo "\n";
}

// Note
if ($note = $column->getNote()) {
    echo "Note: {$note}\n";
}

// Relationships
if ($refs = $column->getRefs()) {
    echo "References:\n";
    foreach ($refs as $ref) {
        $table = $ref->getRightTable()->getTable();
        $cols = implode(', ', $ref->getRightTable()->getColumns());
        echo "  -> {$table}({$cols})\n";
    }
}
```

### Index Configuration

The `IndexNode` represents a table index, which can be single-column or composite.

**DBML Syntax:**

```dbml
Table products {
    id int
    merchant_id int
    status varchar
    
    Indexes {
        id [pk]
        (merchant_id, status) [name: 'merchant_status_idx', type: hash]
        email [unique]
    }
}
```

#### Access Index Properties

```php
/** @var \Butschster\Dbml\Ast\Table\IndexNode $index */
$index = $table->getIndexes()[0];

// Index name (optional)
$name = $index->getName();
// Returns: string|null (e.g., 'merchant_status_idx')

// Index type (optional)
$type = $index->getType();
// Returns: string|null (e.g., 'hash', 'btree')

// Index note
$note = $index->getNote();
// Returns: string|null

// Check if primary key
$isPrimary = $index->isPrimaryKey();
// Returns: bool

// Check if unique
$isUnique = $index->isUnique();
// Returns: bool
```

#### Get Indexed Columns

```php
// Get columns in the index
$columns = $index->getColumns();
// Returns: AbstractValue[] (StringNode or ExpressionNode)

foreach ($columns as $column) {
    $columnName = $column->getValue();
    // For StringNode: column name
    // For ExpressionNode: expression like 'LOWER(email)'
}

// Example: Single column index
// Indexes { email [unique] }
$columns = $index->getColumns();
// Returns: [StringNode('email')]

// Example: Composite index
// Indexes { (merchant_id, status) [name: 'idx'] }
$columns = $index->getColumns();
// Returns: [StringNode('merchant_id'), StringNode('status')]

// Example: Expression index
// Indexes { `LOWER(email)` [unique] }
$columns = $index->getColumns();
// Returns: [ExpressionNode('LOWER(email)')]
```

#### Get Custom Settings

```php
// Get all settings (including custom ones)
$settings = $index->getSettings();
// Returns: array (mixed setting types)

// Settings can include:
// - PrimaryKeyNode
// - UniqueNode
// - NoteNode
// - SettingWithValueNode (for name, type, and custom settings)
```

**Complete Index Example:**

```php
use Butschster\Dbml\Ast\Table\IndexNode;
use Butschster\Dbml\Ast\Values\{StringNode, ExpressionNode};

/** @var IndexNode $index */

// Index type
if ($index->isPrimaryKey()) {
    echo "PRIMARY KEY";
} elseif ($index->isUnique()) {
    echo "UNIQUE INDEX";
} else {
    echo "INDEX";
}

// Index name
if ($name = $index->getName()) {
    echo " {$name}";
}

// Columns
$columnNames = array_map(
    fn($col) => $col->getValue(),
    $index->getColumns()
);
echo " (" . implode(', ', $columnNames) . ")";

// Index type (hash, btree, etc.)
if ($type = $index->getType()) {
    echo " USING {$type}";
}

// Note
if ($note = $index->getNote()) {
    echo "\n  Note: {$note}";
}

echo "\n";

// Determine if composite
$isComposite = count($index->getColumns()) > 1;
echo $isComposite ? "  (Composite index)\n" : "  (Single column)\n";

// Check for expression columns
$hasExpressions = array_reduce(
    $index->getColumns(),
    fn($has, $col) => $has || $col instanceof ExpressionNode,
    false
);
if ($hasExpressions) {
    echo "  (Contains expressions)\n";
}
```

### Enum Management

The `EnumNode` represents an enumeration type that can be used as a column type.

**DBML Syntax:**

```dbml
Enum order_status {
    pending
    processing
    shipped
    delivered [note: 'Order has been delivered to customer']
}
```

#### Access Enum Properties

```php
/** @var \Butschster\Dbml\Ast\EnumNode $enum */
$enum = $schema->getEnum('order_status');

// Enum name
$name = $enum->getName();
// Returns: string (e.g., 'order_status')

// Number of values
$count = $enum->count();
// Returns: int (e.g., 4)

// Source position
$offset = $enum->getOffset();
// Returns: int
```

#### Get Enum Values

```php
// Get all values
$values = $enum->getValues();
// Returns: ValueNode[] (associative array keyed by value name)

foreach ($values as $valueName => $valueNode) {
    echo "{$valueName}: {$valueNode->getValue()}\n";
    if ($note = $valueNode->getNote()) {
        echo "  Note: {$note}\n";
    }
}

// Check if value exists
if ($enum->hasValue('shipped')) {
    $value = $enum->getValue('shipped');
    // Returns: ValueNode
}

// Throws EnumValueNotFoundException if not found
try {
    $value = $enum->getValue('nonexistent');
} catch (\Butschster\Dbml\Exceptions\EnumValueNotFoundException $e) {
    // Handle missing enum value
}
```

#### Access Value Properties

```php
/** @var \Butschster\Dbml\Ast\Enum\ValueNode $value */
$value = $enum->getValue('delivered');

// Value name
$name = $value->getValue();
// Returns: string (e.g., 'delivered')

// Value note
$note = $value->getNote();
// Returns: string|null

// Source position
$offset = $value->getOffset();
// Returns: int
```

**Complete Enum Example:**

```php
use Butschster\Dbml\Ast\EnumNode;
use Butschster\Dbml\Ast\Enum\ValueNode;

/** @var EnumNode $enum */

echo "Enum: {$enum->getName()}\n";
echo "Values: {$enum->count()}\n\n";

// List all values
foreach ($enum->getValues() as $valueName => $value) {
    echo "  - {$valueName}";
    
    if ($note = $value->getNote()) {
        echo " // {$note}";
    }
    
    echo "\n";
}

// Check if specific values exist
$requiredValues = ['pending', 'processing', 'completed'];
foreach ($requiredValues as $required) {
    if (!$enum->hasValue($required)) {
        echo "Warning: Missing required value '{$required}'\n";
    }
}

// Generate PHP enum class
echo "\nenum {$enum->getName()}: string {\n";
foreach ($enum->getValues() as $valueName => $value) {
    echo "    case " . strtoupper($valueName) . " = '{$valueName}';\n";
}
echo "}\n";
```

### Table Groups

The `TableGroupNode` represents a logical grouping of related tables.

**DBML Syntax:**

```dbml
TableGroup core_tables {
    users
    roles
    permissions
}

TableGroup e_commerce {
    products
    orders
    order_items
}
```

#### Access Group Properties

```php
/** @var \Butschster\Dbml\Ast\TableGroupNode $group */
$group = $schema->getTableGroup('core_tables');

// Group name
$name = $group->getName();
// Returns: string (e.g., 'core_tables')

// Source position
$offset = $group->getOffset();
// Returns: int
```

#### Get Group Tables

```php
// Get all table names in group
$tables = $group->getTables();
// Returns: string[] (array of table names)

foreach ($tables as $tableName) {
    if ($schema->hasTable($tableName)) {
        $table = $schema->getTable($tableName);
        // Process table
    }
}

// Check if specific table is in group
if ($group->hasTable('users')) {
    echo "users table is in {$group->getName()} group\n";
}
```

**Complete Table Group Example:**

```php
use Butschster\Dbml\Ast\TableGroupNode;
use Butschster\Dbml\Ast\SchemaNode;

/** @var TableGroupNode $group */
/** @var SchemaNode $schema */

echo "Table Group: {$group->getName()}\n";
echo "Tables (" . count($group->getTables()) . "):\n";

foreach ($group->getTables() as $tableName) {
    echo "  - {$tableName}";
    
    if ($schema->hasTable($tableName)) {
        $table = $schema->getTable($tableName);
        $columnCount = count($table->getColumns());
        echo " ({$columnCount} columns)";
    } else {
        echo " [TABLE NOT FOUND]";
    }
    
    echo "\n";
}

// Group tables by their groups
$allGroups = $schema->getTableGroups();
$groupedTables = [];

foreach ($allGroups as $grp) {
    foreach ($grp->getTables() as $tableName) {
        $groupedTables[$tableName][] = $grp->getName();
    }
}

// Find tables in multiple groups
foreach ($groupedTables as $tableName => $groups) {
    if (count($groups) > 1) {
        echo "Table '{$tableName}' is in multiple groups: " . implode(', ', $groups) . "\n";
    }
}
```

### Relationships (Refs)

The `RefNode` represents a foreign key relationship between tables.

**DBML Syntax:**

```dbml
// Inline relationship
Table orders {
    user_id int [ref: > users.id]
}

// Standalone relationship (short form)
Ref: orders.user_id > users.id

// Standalone relationship (long form with actions)
Ref order_user_fk: products.merchant_id > merchants.id [
    delete: cascade,
    update: no action
]

// Composite foreign key
Ref: order_items.(order_id, product_id) > orders.(id, product_id)

// Relationship types:
// >  : many-to-one
// <  : one-to-many
// -  : one-to-one

// Grouped relationships
Ref {
    products.category_id > categories.id
    products.merchant_id > merchants.id
}
```

#### Access Relationship Properties

```php
/** @var \Butschster\Dbml\Ast\RefNode $ref */
$ref = $schema->getRefs()[0];

// Relationship name (optional)
$name = $ref->getName();
// Returns: string|null (e.g., 'order_user_fk')

// Source position
$offset = $ref->getOffset();
// Returns: int
```

#### Get Relationship Type

```php
// Get relationship type
$type = $ref->getType();
// Returns: TypeNode (one of the following)

use Butschster\Dbml\Ast\Ref\Type\{ManyToOneNode, OneToManyNode, OneToOneNode};

if ($type instanceof ManyToOneNode) {
    echo "Many-to-One (>)\n";
} elseif ($type instanceof OneToManyNode) {
    echo "One-to-Many (<)\n";
} elseif ($type instanceof OneToOneNode) {
    echo "One-to-One (-)\n";
}
```

#### Get Referenced Tables

```php
// Left side of relationship (source)
$leftTable = $ref->getLeftTable();
// Returns: LeftTableNode

$leftTableName = $leftTable->getTable();
// Returns: string (e.g., 'orders')

$leftColumns = $leftTable->getColumns();
// Returns: string[] (e.g., ['user_id'])

// Right side of relationship (target)
$rightTable = $ref->getRightTable();
// Returns: RightTableNode

$rightTableName = $rightTable->getTable();
// Returns: string (e.g., 'users')

$rightColumns = $rightTable->getColumns();
// Returns: string[] (e.g., ['id'])
```

**Composite Key Example:**

```dbml
Ref: order_items.(order_id, product_id) > orders.(id, product_id)
```

```php
$leftColumns = $ref->getLeftTable()->getColumns();
// Returns: ['order_id', 'product_id']

$rightColumns = $ref->getRightTable()->getColumns();
// Returns: ['id', 'product_id']
```

#### Get Referential Actions

```php
// Get all actions
$actions = $ref->getActions();
// Returns: ActionNode[] (associative array keyed by action name)

foreach ($actions as $actionName => $action) {
    echo "{$actionName}: {$action->getAction()}\n";
}

// Check if action exists
if ($ref->hasAction('delete')) {
    $action = $ref->getAction('delete');
    // Returns: OnDeleteNode
    
    $actionType = $action->getAction();
    // Returns: string (cascade, restrict, set null, set default, no action)
}

// Throws RefActionNotFoundException if not found
try {
    $action = $ref->getAction('nonexistent');
} catch (\Butschster\Dbml\Exceptions\RefActionNotFoundException $e) {
    // Handle missing action
}
```

**Action Types:**

| Action        | Description                               |
|---------------|-------------------------------------------|
| `cascade`     | Automatically update/delete related rows  |
| `restrict`    | Prevent action if related rows exist      |
| `set null`    | Set foreign key to NULL                   |
| `set default` | Set foreign key to default value          |
| `no action`   | No automatic action (similar to restrict) |

**Action Node Types:**

```php
use Butschster\Dbml\Ast\Ref\Action\{OnDeleteNode, OnUpdateNode};

// Check action type
if ($action instanceof OnDeleteNode) {
    echo "ON DELETE {$action->getAction()}\n";
}

if ($action instanceof OnUpdateNode) {
    echo "ON UPDATE {$action->getAction()}\n";
}

// Both extend ActionNode
$actionName = $action->getName(); // 'delete' or 'update'
$actionType = $action->getAction(); // 'cascade', 'restrict', etc.
```

**Complete Relationship Example:**

```php
use Butschster\Dbml\Ast\RefNode;
use Butschster\Dbml\Ast\Ref\Type\{ManyToOneNode, OneToManyNode, OneToOneNode};

/** @var RefNode $ref */

// Relationship name
if ($name = $ref->getName()) {
    echo "Relationship: {$name}\n";
}

// Tables and columns
$left = $ref->getLeftTable();
$right = $ref->getRightTable();

echo "{$left->getTable()}." . implode(', ', $left->getColumns());

// Relationship type
$type = $ref->getType();
if ($type instanceof ManyToOneNode) {
    echo " > ";
} elseif ($type instanceof OneToManyNode) {
    echo " < ";
} else {
    echo " - ";
}

echo "{$right->getTable()}." . implode(', ', $right->getColumns());
echo "\n";

// Actions
if ($actions = $ref->getActions()) {
    echo "Actions:\n";
    foreach ($actions as $actionName => $action) {
        echo "  ON " . strtoupper($actionName) . " {$action->getAction()}\n";
    }
}

// Generate SQL
$leftCols = implode(', ', $left->getColumns());
$rightCols = implode(', ', $right->getColumns());

echo "\nSQL:\n";
echo "ALTER TABLE {$left->getTable()}\n";
echo "  ADD CONSTRAINT " . ($name ?: "fk_{$left->getTable()}_{$right->getTable()}") . "\n";
echo "  FOREIGN KEY ({$leftCols})\n";
echo "  REFERENCES {$right->getTable()}({$rightCols})";

if ($ref->hasAction('delete')) {
    echo "\n  ON DELETE " . strtoupper($ref->getAction('delete')->getAction());
}
if ($ref->hasAction('update')) {
    echo "\n  ON UPDATE " . strtoupper($ref->getAction('update')->getAction());
}
echo ";\n";
```

## Advanced Usage

### Validating Schema Integrity

```php
use Butschster\Dbml\Ast\SchemaNode;

function validateSchema(SchemaNode $schema): array
{
    $errors = [];
    
    // Check for orphaned foreign keys
    foreach ($schema->getRefs() as $ref) {
        $leftTable = $ref->getLeftTable()->getTable();
        $rightTable = $ref->getRightTable()->getTable();
        
        if (!$schema->hasTable($leftTable)) {
            $errors[] = "Reference from non-existent table: {$leftTable}";
        }
        
        if (!$schema->hasTable($rightTable)) {
            $errors[] = "Reference to non-existent table: {$rightTable}";
        }
        
        // Validate columns exist
        if ($schema->hasTable($leftTable)) {
            $table = $schema->getTable($leftTable);
            foreach ($ref->getLeftTable()->getColumns() as $col) {
                if (!$table->hasColumn($col)) {
                    $errors[] = "Column {$leftTable}.{$col} not found";
                }
            }
        }
    }
    
    // Check for duplicate column names
    foreach ($schema->getTables() as $table) {
        $columnNames = array_map(fn($c) => $c->getName(), $table->getColumns());
        $duplicates = array_filter(
            array_count_values($columnNames),
            fn($count) => $count > 1
        );
        
        foreach ($duplicates as $colName => $count) {
            $errors[] = "Duplicate column '{$colName}' in table {$table->getName()}";
        }
    }
    
    return $errors;
}

$errors = validateSchema($schema);
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "Error: {$error}\n";
    }
}
```

### Generating Documentation

```php
use Butschster\Dbml\Ast\SchemaNode;

function generateMarkdownDocs(SchemaNode $schema): string
{
    $md = "# Database Schema\n\n";
    
    if ($project = $schema->getProject()) {
        $md .= "**Project:** {$project->getName()}\n\n";
        
        if ($note = $project->getNote()) {
            $md .= "> {$note}\n\n";
        }
    }
    
    // Tables
    $md .= "## Tables\n\n";
    foreach ($schema->getTables() as $table) {
        $md .= "### {$table->getName()}\n\n";
        
        if ($note = $table->getNote()) {
            $md .= "*{$note}*\n\n";
        }
        
        // Columns table
        $md .= "| Column | Type | Constraints |\n";
        $md .= "|--------|------|-------------|\n";
        
        foreach ($table->getColumns() as $column) {
            $type = $column->getType()->getName();
            if ($size = $column->getType()->getSize()) {
                $type .= "({$size})";
            }
            
            $constraints = [];
            if ($column->isPrimaryKey()) {$constraints[] = 'PK';}
            if ($column->isUnique()) {$constraints[] = 'UNIQUE';}
            if (!$column->isNull()) {$constraints[] = 'NOT NULL';}
            if ($column->isIncrement()) {$constraints[] = 'AUTO_INCREMENT';}
            
            $md .= "| {$column->getName()} | {$type} | " . implode(', ', $constraints) . " |\n";
        }
        
        $md .= "\n";
    }
    
    // Enums
    if (!empty($schema->getEnums())) {
        $md .= "## Enums\n\n";
        foreach ($schema->getEnums() as $enum) {
            $md .= "### {$enum->getName()}\n\n";
            foreach ($enum->getValues() as $value) {
                $md .= "- `{$value->getValue()}`";
                if ($note = $value->getNote()) {
                    $md .= " - {$note}";
                }
                $md .= "\n";
            }
            $md .= "\n";
        }
    }
    
    return $md;
}

$markdown = generateMarkdownDocs($schema);
file_put_contents('schema.md', $markdown);
```

### Converting to Different Formats

```php
use Butschster\Dbml\Ast\SchemaNode;

function convertToArray(SchemaNode $schema): array
{
    $result = [];
    
    // Project
    if ($project = $schema->getProject()) {
        $result['project'] = [
            'name' => $project->getName(),
            'note' => $project->getNote(),
            'settings' => array_map(
                fn($s) => ['key' => $s->getKey(), 'value' => $s->getValue()],
                $project->getSettings()
            ),
        ];
    }
    
    // Tables
    $result['tables'] = [];
    foreach ($schema->getTables() as $table) {
        $result['tables'][$table->getName()] = [
            'alias' => $table->getAlias(),
            'note' => $table->getNote(),
            'columns' => array_map(function($col) {
                return [
                    'name' => $col->getName(),
                    'type' => $col->getType()->getName(),
                    'size' => $col->getType()->getSizeArray(),
                    'primary_key' => $col->isPrimaryKey(),
                    'unique' => $col->isUnique(),
                    'nullable' => $col->isNull(),
                    'increment' => $col->isIncrement(),
                    'default' => $col->getDefault()?->getValue(),
                    'note' => $col->getNote(),
                ];
            }, $table->getColumns()),
            'indexes' => array_map(function($idx) {
                return [
                    'name' => $idx->getName(),
                    'columns' => array_map(fn($c) => $c->getValue(), $idx->getColumns()),
                    'primary_key' => $idx->isPrimaryKey(),
                    'unique' => $idx->isUnique(),
                    'type' => $idx->getType(),
                ];
            }, $table->getIndexes()),
        ];
    }
    
    // Enums
    $result['enums'] = [];
    foreach ($schema->getEnums() as $enum) {
        $result['enums'][$enum->getName()] = array_map(
            fn($v) => ['value' => $v->getValue(), 'note' => $v->getNote()],
            $enum->getValues()
        );
    }
    
    // Relationships
    $result['relationships'] = array_map(function($ref) {
        $type = match (get_class($ref->getType())) {
            \Butschster\Dbml\Ast\Ref\Type\ManyToOneNode::class => 'many-to-one',
            \Butschster\Dbml\Ast\Ref\Type\OneToManyNode::class => 'one-to-many',
            \Butschster\Dbml\Ast\Ref\Type\OneToOneNode::class => 'one-to-one',
        };
        
        return [
            'name' => $ref->getName(),
            'type' => $type,
            'from' => [
                'table' => $ref->getLeftTable()->getTable(),
                'columns' => $ref->getLeftTable()->getColumns(),
            ],
            'to' => [
                'table' => $ref->getRightTable()->getTable(),
                'columns' => $ref->getRightTable()->getColumns(),
            ],
            'actions' => array_map(
                fn($a) => ['name' => $a->getName(), 'action' => $a->getAction()],
                $ref->getActions()
            ),
        ];
    }, $schema->getRefs());
    
    return $result;
}

// Convert to JSON
$json = json_encode(convertToArray($schema), JSON_PRETTY_PRINT);
file_put_contents('schema.json', $json);

// Convert to YAML
$yaml = yaml_emit(convertToArray($schema));
file_put_contents('schema.yaml', $yaml);
```

### Generating Migration Code

```php
use Butschster\Dbml\Ast\{SchemaNode, TableNode};

function generateLaravelMigration(TableNode $table): string
{
    $className = 'Create' . str_replace('_', '', ucwords($table->getName(), '_')) . 'Table';
    $tableName = $table->getName();
    
    $code = "<?php\n\n";
    $code .= "use Illuminate\Database\Migrations\Migration;\n";
    $code .= "use Illuminate\Database\Schema\Blueprint;\n";
    $code .= "use Illuminate\Support\Facades\Schema;\n\n";
    $code .= "return new class extends Migration\n{\n";
    $code .= "    public function up(): void\n    {\n";
    $code .= "        Schema::create('{$tableName}', function (Blueprint \$table) {\n";
    
    foreach ($table->getColumns() as $column) {
        $type = $column->getType()->getName();
        $name = $column->getName();
        
        // Convert DBML types to Laravel types
        $laravelType = match($type) {
            'varchar' => 'string',
            'int' => 'integer',
            'bool', 'boolean' => 'boolean',
            'text' => 'text',
            'datetime' => 'dateTime',
            'timestamp' => 'timestamp',
            default => $type,
        };
        
        $line = "            \$table->{$laravelType}('{$name}'";
        
        if ($size = $column->getType()->getSize()) {
            $line .= ", {$size}";
        }
        
        $line .= ")";
        
        if ($column->isUnique()) {$line .= "->unique()";}
        if (!$column->isNull()) {$line .= "->nullable(false)";}
        if ($column->isIncrement()) {$line .= "->autoIncrement()";}
        if ($default = $column->getDefault()) {
            $line .= "->default(" . var_export($default->getValue(), true) . ")";
        }
        
        $line .= ";\n";
        $code .= $line;
    }
    
    $code .= "        });\n";
    $code .= "    }\n\n";
    $code .= "    public function down(): void\n    {\n";
    $code .= "        Schema::dropIfExists('{$tableName}');\n";
    $code .= "    }\n";
    $code .= "};\n";
    
    return $code;
}

// Generate migrations for all tables
foreach ($schema->getTables() as $table) {
    $migration = generateLaravelMigration($table);
    $filename = date('Y_m_d_His') . "_create_{$table->getName()}_table.php";
    file_put_contents("database/migrations/{$filename}", $migration);
}
```

## Use Cases

### 1. Database Schema Version Control

Store your database design in DBML format alongside your application code:

```php
// Store schema in version control
$dbml = file_get_contents('schema/database.dbml');
$parser = DbmlParserFactory::create();
$schema = $parser->parse($dbml);

// Validate before deployment
$errors = validateSchema($schema);
if (!empty($errors)) {
    throw new Exception("Schema validation failed: " . implode(', ', $errors));
}
```

### 2. ORM Entity Generation

Generate Doctrine, Eloquent, or Cycle ORM entities:

```php
use Butschster\Dbml\Ast\TableNode;

function generateCycleEntity(TableNode $table): string
{
    $className = str_replace('_', '', ucwords($table->getName(), '_'));
    
    $code = "<?php\n\nnamespace App\Entities;\n\n";
    $code .= "use Cycle\Annotated\Annotation as Cycle;\n\n";
    $code .= "#[Cycle\Entity(table: '{$table->getName()}')]\n";
    $code .= "class {$className}\n{\n";
    
    foreach ($table->getColumns() as $column) {
        $code .= "    #[Cycle\Column(type: '{$column->getType()->getName()}'";
        if ($column->isPrimaryKey()) $code .= ", primary: true";
        if (!$column->isNull()) $code .= ", nullable: false";
        $code .= ")]\n";
        $code .= "    private {$column->getName()};\n\n";
    }
    
    $code .= "}\n";
    return $code;
}
```

### 3. API Documentation Generation

Create OpenAPI/Swagger specifications from your database schema:

```php
function generateOpenAPISchema(SchemaNode $schema): array
{
    $openapi = [
        'openapi' => '3.0.0',
        'info' => [
            'title' => $schema->getProject()?->getName() ?? 'API',
            'version' => '1.0.0',
        ],
        'components' => [
            'schemas' => [],
        ],
    ];
    
    foreach ($schema->getTables() as $table) {
        $properties = [];
        $required = [];
        
        foreach ($table->getColumns() as $column) {
            $type = match($column->getType()->getName()) {
                'int', 'integer' => 'integer',
                'varchar', 'text' => 'string',
                'bool', 'boolean' => 'boolean',
                'decimal', 'float' => 'number',
                default => 'string',
            };
            
            $properties[$column->getName()] = ['type' => $type];
            
            if (!$column->isNull()) {
                $required[] = $column->getName();
            }
        }
        
        $openapi['components']['schemas'][$table->getName()] = [
            'type' => 'object',
            'properties' => $properties,
            'required' => $required,
        ];
    }
    
    return $openapi;
}
```

### 4. Database Comparison Tool

Compare two DBML schemas to detect changes:

```php
function compareSchemas(SchemaNode $old, SchemaNode $new): array
{
    $changes = [];
    
    // New tables
    foreach ($new->getTables() as $table) {
        if (!$old->hasTable($table->getName())) {
            $changes[] = "Added table: {$table->getName()}";
        }
    }
    
    // Removed tables
    foreach ($old->getTables() as $table) {
        if (!$new->hasTable($table->getName())) {
            $changes[] = "Removed table: {$table->getName()}";
        }
    }
    
    // Modified tables
    foreach ($new->getTables() as $newTable) {
        if ($old->hasTable($newTable->getName())) {
            $oldTable = $old->getTable($newTable->getName());
            
            // Column changes
            foreach ($newTable->getColumns() as $column) {
                if (!$oldTable->hasColumn($column->getName())) {
                    $changes[] = "Added column: {$newTable->getName()}.{$column->getName()}";
                }
            }
        }
    }
    
    return $changes;
}
```

### 5. Schema Visualization

Generate GraphViz DOT format for visual diagrams:

```php
function generateDotGraph(SchemaNode $schema): string
{
    $dot = "digraph schema {\n";
    $dot .= "  node [shape=record];\n\n";
    
    // Tables
    foreach ($schema->getTables() as $table) {
        $label = "{" . $table->getName() . "|";
        $columns = [];
        foreach ($table->getColumns() as $column) {
            $col = $column->getName();
            if ($column->isPrimaryKey()) {$col .= " (PK)";}
            $columns[] = $col;
        }
        $label .= implode("\\n", $columns) . "}";
        
        $dot .= "  {$table->getName()} [label=\"{$label}\"];\n";
    }
    
    $dot .= "\n";
    
    // Relationships
    foreach ($schema->getRefs() as $ref) {
        $from = $ref->getLeftTable()->getTable();
        $to = $ref->getRightTable()->getTable();
        $dot .= "  {$from} -> {$to};\n";
    }
    
    $dot .= "}\n";
    return $dot;
}

// Generate PNG: dot -Tpng schema.dot -o schema.png
file_put_contents('schema.dot', generateDotGraph($schema));
```

## Error Handling

The parser throws specific exceptions for different error conditions:

```php
use Butschster\Dbml\Exceptions\{
    GrammarFileNotFoundException,
    TableNotFoundException,
    ColumnNotFoundException,
    EnumNotFoundException,
    EnumValueNotFoundException,
    TableGroupNotFoundException,
    ProjectSettingNotFoundException,
    RefActionNotFoundException
};

try {
    // Parse DBML
    $parser = DbmlParserFactory::create();
    $schema = $parser->parse($dbml);
    
    // Access components
    $table = $schema->getTable('users');
    $column = $table->getColumn('email');
    $enum = $schema->getEnum('status');
    $value = $enum->getValue('active');
    
} catch (GrammarFileNotFoundException $e) {
    // Grammar file missing (shouldn't happen in normal usage)
    error_log("Parser initialization failed: " . $e->getMessage());
    
} catch (TableNotFoundException $e) {
    // Table doesn't exist in schema
    error_log("Table not found: " . $e->getMessage());
    
} catch (ColumnNotFoundException $e) {
    // Column doesn't exist in table
    error_log("Column not found: " . $e->getMessage());
    
} catch (EnumNotFoundException $e) {
    // Enum type doesn't exist
    error_log("Enum not found: " . $e->getMessage());
    
} catch (EnumValueNotFoundException $e) {
    // Enum value doesn't exist
    error_log("Enum value not found: " . $e->getMessage());
    
} catch (TableGroupNotFoundException $e) {
    // Table group doesn't exist
    error_log("Table group not found: " . $e->getMessage());
    
} catch (ProjectSettingNotFoundException $e) {
    // Project setting doesn't exist
    error_log("Project setting not found: " . $e->getMessage());
    
} catch (RefActionNotFoundException $e) {
    // Referential action doesn't exist
    error_log("Ref action not found: " . $e->getMessage());
    
} catch (\Phplrt\Contracts\Exception\RuntimeExceptionInterface $e) {
    // Parser error (syntax error in DBML)
    error_log("DBML parsing failed: " . $e->getMessage());
}
```

**Best Practices:**

1. **Always check existence before accessing** using `has*()` methods
2. **Catch specific exceptions** rather than generic Exception
3. **Validate DBML syntax** before parsing in production
4. **Handle parser errors gracefully** with user-friendly messages

## Contributing

Contributions are welcome! Please follow these guidelines:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Write tests for your changes
4. Ensure all tests pass (`composer test`)
5. Commit your changes (`git commit -m 'Add amazing feature'`)
6. Push to the branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

## Credits

- **Author**: [Pavel Buchnev (butschster)](https://github.com/butschster)
- **Parser Library**: Built with [phplrt](https://phplrt.org)
- **Inspiration**: [dbdiagram.io](https://dbdiagram.io/)
- **Specification**: [DBML Official Docs](https://www.dbml.org/)

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

**Support this project:**

- ⭐ Star this repository
- 🐛 Report bugs and suggest features via [GitHub Issues](https://github.com/butschster/dbml-parser/issues)
- 💖 [Support on Patreon](https://patreon.com/butschster)
- 📢 Share with your network

For more information about DBML syntax and features, visit [www.dbml.org](https://www.dbml.org/).
