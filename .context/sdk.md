# SDK
```
// Structure of documents
└── src/
    └── Ast/
        ├── Enum/
        │   ├── ValueNode.php
        ├── EnumNode.php
        ├── NoteNode.php
        ├── Project/
        │   ├── NameNode.php
        │   ├── SettingKeyNode.php
        │   ├── SettingNode.php
        ├── ProjectNode.php
        ├── Ref/
        │   ├── Action/
        │   │   ├── ActionNode.php
        │   │   ├── OnDeleteNode.php
        │   │   ├── OnUpdateNode.php
        │   ├── ColumnsNode.php
        │   ├── GroupNode.php
        │   ├── LeftTableNode.php
        │   ├── NameNode.php
        │   ├── RightTableNode.php
        │   ├── SettingNode.php
        │   ├── TableNode.php
        │   ├── Type/
        │   │   ├── ManyToOneNode.php
        │   │   ├── OneToManyNode.php
        │   │   ├── OneToOneNode.php
        │   ├── TypeNode.php
        ├── RefNode.php
        ├── SchemaNode.php
        ├── Table/
        │   ├── AliasNode.php
        │   ├── Column/
        │   │   ├── NameNode.php
        │   │   ├── Setting/
        │   │   │   ├── IncrementNode.php
        │   │   │   ├── NotNullNode.php
        │   │   │   ├── NullNode.php
        │   │   │   ├── PrimaryKeyNode.php
        │   │   │   ├── UniqueNode.php
        │   │   ├── SettingNode.php
        │   │   ├── SettingWithValueNode.php
        │   │   ├── SizeNode.php
        │   │   ├── TypeNode.php
        │   ├── ColumnNode.php
        │   ├── Index/
        │   │   ├── FieldsNode.php
        │   ├── IndexNode.php
        │   ├── NameNode.php
        ├── TableGroupNode.php
        ├── TableNode.php
        ├── Values/
        │   └── AbstractValue.php
        │   └── BooleanNode.php
        │   └── ExpressionNode.php
        │   └── FloatNode.php
        │   └── IntNode.php
        │   └── NullNode.php
        │   └── StringNode.php
    └── DbmlParser.php
    └── DbmlParserFactory.php
    └── Exceptions/
        └── ColumnNotFoundException.php
        └── EnumNotFoundException.php
        └── EnumValueNotFoundException.php
        └── GrammarFileNotFoundException.php
        └── ProjectSettingNotFoundException.php
        └── RefActionNotFoundException.php
        └── TableGroupNotFoundException.php
        └── TableNotFoundException.php

```
###  Path: `/src/Ast/Enum/ValueNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Enum;

use Butschster\Dbml\Ast\NoteNode;

class ValueNode
{
    private ?string $note = null;

    public function __construct(
        private int $offset,
        private string $value,
        ?NoteNode $note = null,
    ) {
        if ($note) {
            $this->note = $note->getDescription();
        }
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }
}

```
###  Path: `/src/Ast/EnumNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Enum\ValueNode;
use Butschster\Dbml\Exceptions\EnumValueNotFoundException;

class EnumNode
{
    /** @var ValueNode[] */
    private array $values = [];

    public function __construct(
        private int $offset,
        private string $name,
        array $values = [],
    ) {
        foreach ($values as $value) {
            $this->values[$value->getValue()] = $value;
        }
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get enum name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get amount of values
     */
    public function count(): int
    {
        return \count($this->values);
    }

    /**
     * Get enum values
     * @return ValueNode[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Check if enum contains value
     */
    public function hasValue(string $name): bool
    {
        return \array_key_exists($name, $this->values);
    }

    /**
     * Get enum value object by name
     * @throws EnumValueNotFoundException
     */
    public function getValue(string $value): ValueNode
    {
        if (!$this->hasValue($value)) {
            throw new EnumValueNotFoundException("Enum value [{$value}] not found.");
        }

        return $this->values[$value];
    }
}

```
###  Path: `/src/Ast/NoteNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Values\StringNode;

class NoteNode
{
    private string $description;

    public function __construct(private int $offset, StringNode $string)
    {
        $this->description = $string->getValue();
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get note description
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}

```
###  Path: `/src/Ast/Project/NameNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Project;

use Butschster\Dbml\Ast\Values\StringNode;

class NameNode
{
    private string $value;

    public function __construct(
        private int $offset,
        StringNode $string,
    ) {
        $this->value = $string->getValue();
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

```
###  Path: `/src/Ast/Project/SettingKeyNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Project;

class SettingKeyNode
{
    public function __construct(
        private int $offset,
        private string $value,
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

```
###  Path: `/src/Ast/Project/SettingNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Project;

use Butschster\Dbml\Ast\Values\StringNode;

class SettingNode
{
    private string $key;
    private string $value;

    public function __construct(
        private int $offset,
        SettingKeyNode $key,
        StringNode $value,
    ) {
        $this->key = $key->getValue();
        $this->value = $value->getValue();
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

```
###  Path: `/src/Ast/ProjectNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Project\NameNode;
use Butschster\Dbml\Ast\Project\SettingNode;
use Butschster\Dbml\Exceptions\ProjectSettingNotFoundException;

class ProjectNode
{
    private ?string $note = null;

    /** @var SettingNode[] */
    private array $settings = [];

    private string $name;

    public function __construct(
        private int $offset,
        array $children,
    ) {
        foreach ($children as $child) {
            if ($child instanceof NoteNode) {
                $this->note = $child->getDescription();
            } elseif ($child instanceof SettingNode) {
                $this->settings[$child->getKey()] = $child;
            } elseif ($child instanceof NameNode) {
                $this->name = $child->getValue();
            }
        }
    }

    /**
     * Get project name
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get project note
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * Get project settings
     * @return SettingNode[]
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * Check if project has settings with given name
     */
    public function hasSetting(string $name): bool
    {
        return isset($this->settings[$name]);
    }

    /**
     * Get setting by name
     * @throws ProjectSettingNotFoundException
     */
    public function getSetting(string $name): SettingNode
    {
        if (!$this->hasSetting($name)) {
            throw new ProjectSettingNotFoundException("Project setting [{$name}] not found.");
        }

        return $this->settings[$name];
    }
}

```
###  Path: `/src/Ast/Ref/Action/ActionNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref\Action;

abstract class ActionNode
{
    public function __construct(
        private int $offset,
        private string $name,
        private string $action,
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

```
###  Path: `/src/Ast/Ref/Action/OnDeleteNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref\Action;

class OnDeleteNode extends ActionNode
{
    public function __construct(int $offset, string $action)
    {
        parent::__construct($offset, 'delete', $action);
    }
}

```
###  Path: `/src/Ast/Ref/Action/OnUpdateNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref\Action;

class OnUpdateNode extends ActionNode
{
    public function __construct(int $offset, string $action)
    {
        parent::__construct($offset, 'update', $action);
    }
}

```
###  Path: `/src/Ast/Ref/ColumnsNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

class ColumnsNode
{
    public function __construct(
        private int $offset,
        private array $columns = [],
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}

```
###  Path: `/src/Ast/Ref/GroupNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

use Butschster\Dbml\Ast\RefNode;

class GroupNode
{
    /** @var RefNode[] */
    private array $refs = [];

    public function __construct(
        private int $offset,
        array $children = [],
    ) {
        $name = null;
        foreach ($children as $child) {
            if ($child instanceof NameNode) {
                $name = $child;
            }
        }

        foreach ($children as $child) {
            if ($child instanceof ColumnsNode) {
                $this->refs[] = new RefNode($offset, [
                    $name,
                    $child,
                ]);
            }
        }
    }

    /**
     * Get nodes
     * @return RefNode[]
     */
    public function getRefs(): array
    {
        return $this->refs;
    }
}

```
###  Path: `/src/Ast/Ref/LeftTableNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

class LeftTableNode extends TableNode {}

```
###  Path: `/src/Ast/Ref/NameNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

class NameNode
{
    public function __construct(
        private int $offset,
        private string $value,
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

```
###  Path: `/src/Ast/Ref/RightTableNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

class RightTableNode extends TableNode {}

```
###  Path: `/src/Ast/Ref/SettingNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

class SettingNode
{
    public function __construct() {}
}

```
###  Path: `/src/Ast/Ref/TableNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

use Butschster\Dbml\Ast\Table\NameNode;

abstract class TableNode
{
    private string $table;

    /** @var string[] */
    private array $columns = [];

    public function __construct(
        private int $offset,
        NameNode $table,
        array $columns = [],
    ) {
        $this->table = $table->getValue();
        $this->columns = \array_map(static fn(\Butschster\Dbml\Ast\Table\Column\NameNode $column) => $column->getValue(), $columns);
    }

    /**
     * Get table name
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * Get columns
     * @return string[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }
}

```
###  Path: `/src/Ast/Ref/Type/ManyToOneNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref\Type;

use Butschster\Dbml\Ast\Ref\TypeNode;

class ManyToOneNode extends TypeNode {}

```
###  Path: `/src/Ast/Ref/Type/OneToManyNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref\Type;

use Butschster\Dbml\Ast\Ref\TypeNode;

class OneToManyNode extends TypeNode {}

```
###  Path: `/src/Ast/Ref/Type/OneToOneNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref\Type;

use Butschster\Dbml\Ast\Ref\TypeNode;

class OneToOneNode extends TypeNode {}

```
###  Path: `/src/Ast/Ref/TypeNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

abstract class TypeNode
{
    public function __construct(private int $offset) {}

    public function getOffset(): int
    {
        return $this->offset;
    }
}

```
###  Path: `/src/Ast/RefNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Ref\Action\ActionNode;
use Butschster\Dbml\Ast\Ref\ColumnsNode;
use Butschster\Dbml\Ast\Ref\LeftTableNode;
use Butschster\Dbml\Ast\Ref\NameNode;
use Butschster\Dbml\Ast\Ref\RightTableNode;
use Butschster\Dbml\Ast\Ref\TypeNode;
use Butschster\Dbml\Exceptions\RefActionNotFoundException;

class RefNode
{
    private ?string $name = null;
    private ?TypeNode $type = null;
    private ?LeftTableNode $leftTable = null;
    private ?RightTableNode $rightTable = null;

    /** @var ActionNode[] */
    private array $actions = [];

    public function __construct(
        private int $offset,
        array $children = [],
    ) {
        foreach ($children as $child) {
            if ($child instanceof NameNode) {
                $this->name = $child->getValue();
            } elseif ($child instanceof ColumnsNode) {
                foreach ($child->getColumns() as $column) {
                    if ($column instanceof LeftTableNode) {
                        $this->leftTable = $column;
                    } elseif ($column instanceof RightTableNode) {
                        $this->rightTable = $column;
                    } elseif ($column instanceof TypeNode) {
                        $this->type = $column;
                    } elseif ($column instanceof ActionNode) {
                        $this->actions[$column->getName()] = $column;
                    }
                }
            }
        }
    }

    public function getLeftTable(): ?LeftTableNode
    {
        return $this->leftTable;
    }

    public function getRightTable(): ?RightTableNode
    {
        return $this->rightTable;
    }

    /**
     * Get ref type
     */
    public function getType(): TypeNode
    {
        return $this->type;
    }

    /**
     * Get ref name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get ref actions
     * @return ActionNode[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Check if ref action exists
     */
    public function hasAction(string $name): bool
    {
        return isset($this->actions[$name]);
    }

    /**
     * Get action by name
     * @throws RefActionNotFoundException
     */
    public function getAction(string $name): ActionNode
    {
        if (!$this->hasAction($name)) {
            throw new RefActionNotFoundException('Ref action [$name] not found.');
        }

        return $this->actions[$name];
    }
}

```
###  Path: `/src/Ast/SchemaNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Ref\GroupNode;
use Butschster\Dbml\Exceptions\EnumNotFoundException;
use Butschster\Dbml\Exceptions\TableGroupNotFoundException;
use Butschster\Dbml\Exceptions\TableNotFoundException;

class SchemaNode
{
    private ?ProjectNode $project = null;

    /** @var TableNode[] */
    private array $tables = [];

    /** @var EnumNode[] */
    private array $enums = [];

    /** @var RefNode[] */
    private array $refs = [];

    /** @var TableGroupNode[] */
    private array $tableGroups = [];

    public function __construct(array $children)
    {
        foreach ($children as $child) {
            if ($child instanceof ProjectNode) {
                $this->project = $child;
            } elseif ($child instanceof TableNode) {
                $this->tables[$child->getName()] = $child;
            } elseif ($child instanceof TableGroupNode) {
                $this->tableGroups[$child->getName()] = $child;
            } elseif ($child instanceof EnumNode) {
                $this->enums[$child->getName()] = $child;
            } elseif ($child instanceof RefNode) {
                $this->refs[] = $child;
            } elseif ($child instanceof GroupNode) {
                foreach ($child->getRefs() as $ref) {
                    $this->refs[] = $ref;
                }
            }
        }
    }

    /**
     * Get project object
     */
    public function getProject(): ?ProjectNode
    {
        return $this->project;
    }

    /**
     * Check if schema has a project
     */
    public function hasProject(): bool
    {
        return $this->getProject() !== null;
    }

    /**
     * Get list of available tables
     * @return TableNode[]
     */
    public function getTables(): array
    {
        return $this->tables;
    }

    /**
     * Check if table with given name exists
     */
    public function hasTable(string $name): bool
    {
        return isset($this->tables[$name]);
    }

    /**
     * Get table object by name
     * @throws TableNotFoundException
     */
    public function getTable(string $name): TableNode
    {
        if (!$this->hasTable($name)) {
            throw new TableNotFoundException("Table [{$name}] not found.");
        }

        return $this->tables[$name];
    }

    /**
     * Get available table groups
     * @return TableGroupNode[]
     */
    public function getTableGroups(): array
    {
        return $this->tableGroups;
    }

    /**
     * Check if table group with given name exists
     */
    public function hasTableGroup(string $name): bool
    {
        return isset($this->tableGroups[$name]);
    }

    /**
     * Get table group object by name
     * @throws TableGroupNotFoundException
     */
    public function getTableGroup(string $name): TableGroupNode
    {
        if (!$this->hasTableGroup($name)) {
            throw new TableGroupNotFoundException("Table group [{$name}] not found.");
        }

        return $this->tableGroups[$name];
    }

    /**
     * Get available enums
     * @return EnumNode[]
     */
    public function getEnums(): array
    {
        return $this->enums;
    }

    /**
     * Check if enum with given name exists
     */
    public function hasEnum(string $name): bool
    {
        return isset($this->enums[$name]);
    }

    /**
     * Get enum object by name
     * @throws EnumNotFoundException
     */
    public function getEnum(string $name): EnumNode
    {
        if (!$this->hasEnum($name)) {
            throw new EnumNotFoundException("Enum [{$name}] not found.");
        }

        return $this->enums[$name];
    }

    /**
     * Get relationships
     * @return RefNode[]
     */
    public function getRefs(): array
    {
        return $this->refs;
    }
}

```
###  Path: `/src/Ast/Table/AliasNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table;

class AliasNode
{
    public function __construct(
        private int $offset,
        private string $value,
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

```
###  Path: `/src/Ast/Table/Column/NameNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

class NameNode
{
    public function __construct(
        private int $offset,
        private string $value,
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

```
###  Path: `/src/Ast/Table/Column/Setting/IncrementNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column\Setting;

use Butschster\Dbml\Ast\Table\Column\SettingNode;

class IncrementNode extends SettingNode {}

```
###  Path: `/src/Ast/Table/Column/Setting/NotNullNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column\Setting;

use Butschster\Dbml\Ast\Table\Column\SettingNode;

class NotNullNode extends SettingNode {}

```
###  Path: `/src/Ast/Table/Column/Setting/NullNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column\Setting;

use Butschster\Dbml\Ast\Table\Column\SettingNode;

class NullNode extends SettingNode {}

```
###  Path: `/src/Ast/Table/Column/Setting/PrimaryKeyNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column\Setting;

use Butschster\Dbml\Ast\Table\Column\SettingNode;

class PrimaryKeyNode extends SettingNode {}

```
###  Path: `/src/Ast/Table/Column/Setting/UniqueNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column\Setting;

use Butschster\Dbml\Ast\Table\Column\SettingNode;

class UniqueNode extends SettingNode {}

```
###  Path: `/src/Ast/Table/Column/SettingNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

abstract class SettingNode
{
    public function __construct(
        private int $offset,
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }
}

```
###  Path: `/src/Ast/Table/Column/SettingWithValueNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

use Butschster\Dbml\Ast\Values\AbstractValue;

class SettingWithValueNode extends SettingNode
{
    public function __construct(
        int $offset,
        private string $name,
        private AbstractValue $value,
    ) {
        parent::__construct($offset);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): AbstractValue
    {
        return $this->value;
    }
}

```
###  Path: `/src/Ast/Table/Column/SizeNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

class SizeNode
{
    public function __construct(
        private int $offset,
        private string $value,
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): array
    {
        return \array_map('intval', \explode(',', \substr($this->value, 1, -1)));
    }
}

```
###  Path: `/src/Ast/Table/Column/TypeNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

use Butschster\Dbml\Ast\Table\NameNode;

class TypeNode
{
    private string $name;
    private ?array $size = null;

    public function __construct(
        private int $offset,
        NameNode $type,
        ?SizeNode $size = null,
    ) {
        $this->name = $type->getValue();
        $this->size = $size ? $size->getValue() : null;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get type name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get max size
     */
    public function getSize(): ?int
    {
        return $this->size[0] ?? null;
    }

    /**
     * Get max size as array
     */
    public function getSizeArray(): array
    {
        return $this->size ?? [];
    }
}

```
###  Path: `/src/Ast/Table/ColumnNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table;

use Butschster\Dbml\Ast\NoteNode;
use Butschster\Dbml\Ast\RefNode;
use Butschster\Dbml\Ast\Table\Column\Setting\IncrementNode;
use Butschster\Dbml\Ast\Table\Column\Setting\NotNullNode;
use Butschster\Dbml\Ast\Table\Column\Setting\NullNode;
use Butschster\Dbml\Ast\Table\Column\Setting\PrimaryKeyNode;
use Butschster\Dbml\Ast\Table\Column\Setting\UniqueNode;
use Butschster\Dbml\Ast\Table\Column\SettingWithValueNode;
use Butschster\Dbml\Ast\Table\Column\TypeNode;
use Butschster\Dbml\Ast\Values\AbstractValue;

class ColumnNode
{
    private string $name;
    private ?string $note = null;
    private ?AbstractValue $default = null;
    private bool $primaryKey = false;
    private bool $increment = false;
    private bool $unique = false;
    private bool $null = true;

    /** @var SettingWithValueNode[] */
    private array $settings = [];

    /** @var RefNode[]  */
    private array $refs = [];

    public function __construct(
        private int $offset,
        \Butschster\Dbml\Ast\Table\Column\NameNode $name,
        private TypeNode $type,
        array $settings = [],
    ) {
        $this->name = $name->getValue();

        foreach ($settings as $setting) {
            if ($setting instanceof NoteNode) {
                $this->note = $setting->getDescription();
            } elseif ($setting instanceof UniqueNode) {
                $this->unique = true;
            } elseif ($setting instanceof NotNullNode) {
                $this->null = false;
            } elseif ($setting instanceof NullNode) {
                $this->null = true;
            } elseif ($setting instanceof IncrementNode) {
                $this->increment = true;
            } elseif ($setting instanceof PrimaryKeyNode) {
                $this->primaryKey = true;
            } elseif ($setting instanceof SettingWithValueNode && $setting->getName() === 'default') {
                $this->default = $setting->getValue();
            } elseif ($setting instanceof SettingWithValueNode) {
                $this->settings[] = $setting;
            } elseif ($setting instanceof RefNode) {
                $this->refs[] = $setting;
            }
        }
    }

    /**
     * Get column name
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get column type
     */
    public function getType(): TypeNode
    {
        return $this->type;
    }

    /**
     * Get column default value
     */
    public function getDefault(): ?AbstractValue
    {
        return $this->default;
    }

    /**
     * Get column note
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * Get column settings
     * @return SettingWithValueNode[]
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * Check if column is primary
     */
    public function isPrimaryKey(): bool
    {
        return $this->primaryKey;
    }

    /**
     * Check if column is auto increment
     */
    public function isIncrement(): bool
    {
        return $this->increment;
    }

    /**
     * Check if column is unique
     */
    public function isUnique(): bool
    {
        return $this->unique;
    }

    /**
     * Check if column is nullable
     */
    public function isNull(): bool
    {
        return $this->null;
    }

    /**
     * Get column refs
     * @return RefNode[]
     */
    public function getRefs(): array
    {
        return $this->refs;
    }
}

```
###  Path: `/src/Ast/Table/Index/FieldsNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Index;

class FieldsNode
{
    public function __construct(
        private int $offset,
        private array $fields,
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}

```
###  Path: `/src/Ast/Table/IndexNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table;

use Butschster\Dbml\Ast\NoteNode;
use Butschster\Dbml\Ast\Table\Column\Setting\PrimaryKeyNode;
use Butschster\Dbml\Ast\Table\Column\Setting\UniqueNode;
use Butschster\Dbml\Ast\Table\Column\SettingWithValueNode;
use Butschster\Dbml\Ast\Table\Index\FieldsNode;
use Butschster\Dbml\Ast\Values\AbstractValue;

class IndexNode
{
    /** @var AbstractValue[] */
    private array $columns = [];

    private array $settings = [];
    private ?string $name = null;
    private ?string $type = null;
    private bool $primaryKey = false;
    private bool $unique = false;
    private ?string $note = null;

    public function __construct(
        private int $offset,
        FieldsNode $fields,
        array $settings = [],
    ) {
        $this->columns = $fields->getFields();

        foreach ($settings as $setting) {
            if ($setting instanceof PrimaryKeyNode) {
                $this->primaryKey = true;
            } elseif ($setting instanceof NoteNode) {
                $this->note = $setting->getDescription();
            } elseif ($setting instanceof UniqueNode) {
                $this->unique = true;
            } elseif ($setting instanceof SettingWithValueNode && $setting->getName() === 'name') {
                $this->name = $setting->getValue()->getValue();
            } elseif ($setting instanceof SettingWithValueNode && $setting->getName() === 'type') {
                $this->type = $setting->getValue()->getValue();
            }
        }

        $this->settings = $settings;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function isPrimaryKey(): bool
    {
        return $this->primaryKey;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isUnique(): bool
    {
        return $this->unique;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }
}

```
###  Path: `/src/Ast/Table/NameNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table;

class NameNode
{
    public function __construct(
        private int $offset,
        private string $value,
    ) {}

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

```
###  Path: `/src/Ast/TableGroupNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast;

class TableGroupNode
{
    /** @var string[] */
    private array $tables = [];

    public function __construct(
        private int $offset,
        private string $name,
        array $tables,
    ) {
        foreach ($tables as $table) {
            $this->tables[] = $table->getValue();
        }
    }

    /**
     * Check if table with given name contains in this group
     */
    public function hasTable(string $table): bool
    {
        return \in_array($table, $this->tables);
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get group name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get list of tables
     * @return string[]
     */
    public function getTables(): array
    {
        return $this->tables;
    }
}

```
###  Path: `/src/Ast/TableNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Table\AliasNode;
use Butschster\Dbml\Ast\Table\ColumnNode;
use Butschster\Dbml\Ast\Table\IndexNode;
use Butschster\Dbml\Exceptions\ColumnNotFoundException;

class TableNode
{
    private ?string $alias = null;

    /** @var ColumnNode[] */
    private array $columns = [];

    /** @var IndexNode[] */
    private array $indexes = [];

    private ?string $note = null;

    public function __construct(
        private int $offset,
        private string $name,
        array $children,
    ) {
        foreach ($children as $child) {
            if ($child instanceof AliasNode) {
                $this->alias = $child->getValue();
            } elseif ($child instanceof NoteNode) {
                $this->note = $child->getDescription();
            } elseif ($child instanceof ColumnNode) {
                $this->columns[$child->getName()] = $child;
            } elseif ($child instanceof IndexNode) {
                $this->indexes[] = $child;
            }
        }
    }

    /**
     * Get table name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get table alias
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get columns
     * @return ColumnNode[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Check if table column exists
     */
    public function hasColumn(string $name): bool
    {
        return isset($this->columns[$name]);
    }

    /**
     * Get column by name
     * @throws ColumnNotFoundException
     */
    public function getColumn(string $name): ColumnNode
    {
        if (!$this->hasColumn($name)) {
            throw new ColumnNotFoundException("Column [{$name}] not found.");
        }

        return $this->columns[$name];
    }

    /**
     * Get table note
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * Get table indexes
     * @return IndexNode[]
     */
    public function getIndexes(): array
    {
        return $this->indexes;
    }
}

```
###  Path: `/src/Ast/Values/AbstractValue.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

abstract class AbstractValue
{
    public function __construct(private int $offset, private $value)
    {
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}

```
###  Path: `/src/Ast/Values/BooleanNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class BooleanNode extends AbstractValue
{
    public function __construct(int $offset, $value)
    {
        parent::__construct($offset, (bool) $value);
    }
}

```
###  Path: `/src/Ast/Values/ExpressionNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class ExpressionNode extends AbstractValue
{
    public function __construct(int $offset, string $value)
    {
        parent::__construct($offset, $this->unquoteTokenValue($value));
    }

    private function unquoteTokenValue(string $value): string
    {
        return \trim(\preg_replace('/(\`{1})([\s\S]*?)\1/i', '$2', $value));
    }
}

```
###  Path: `/src/Ast/Values/FloatNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class FloatNode extends AbstractValue
{
    public function __construct(int $offset, $value)
    {
        parent::__construct($offset, (float) $value);
    }
}

```
###  Path: `/src/Ast/Values/IntNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class IntNode extends AbstractValue
{
    public function __construct(int $offset, $value)
    {
        parent::__construct($offset, (int) $value);
    }
}

```
###  Path: `/src/Ast/Values/NullNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class NullNode extends AbstractValue
{
    public function __construct(int $offset)
    {
        parent::__construct($offset, null);
    }
}

```
###  Path: `/src/Ast/Values/StringNode.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

use Phplrt\Lexer\Token\Token;

class StringNode extends AbstractValue
{
    public function __construct(int $offset, Token $token)
    {
        $value = match ($token->getName()) {
            'T_WORD' => $token->getValue(),
            'T_QUOTED_STRING' => $this->unquoteTokenValue($token->getValue()),
        };

        parent::__construct($offset, $this->convertType($value));
    }

    private function convertType(string $value): mixed
    {
        if (\ctype_digit($value)) {
            return (int) $value;
        }

        if (\is_numeric($value)) {
            return (float) $value;
        }

        if (\in_array(\strtolower($value), ['true', 'false'])) {
            return \strtolower($value) === 'true';
        }

        return $value;
    }

    private function unquoteTokenValue(string $value): string
    {
        return \trim(\preg_replace('/(\'{3}|[\"\']{1})([^\'\"][\s\S]*?)\1/i', '$2', $value));
    }
}

```
###  Path: `/src/DbmlParser.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml;

use Butschster\Dbml\Ast\SchemaNode;
use Butschster\Dbml\Exceptions\GrammarFileNotFoundException;
use Phplrt\Contracts\Lexer\LexerInterface;
use Phplrt\Lexer\Lexer;
use Phplrt\Parser\Parser;
use Phplrt\Parser\BuilderInterface;
use Phplrt\Parser\ContextInterface;
use Phplrt\Contracts\Parser\ParserInterface;

class DbmlParser
{
    private ParserInterface $parser;

    public function __construct(array $grammar)
    {
        $lexer = $this->createLexer($grammar);
        $builder = $this->createBuilder($grammar['reducers']);

        $this->parser = $this->createParser($lexer, $grammar, $builder);
    }

    /**
     * Parse DBML schema
     * @throws \Phplrt\Contracts\Exception\RuntimeExceptionInterface
     */
    public function parse(string $dbml, array $options = []): ?SchemaNode
    {
        return $this->parser->parse($dbml, $options)[0] ?? null;
    }

    /**
     * Create Lexer from compiled data.
     */
    private function createLexer(array $data): LexerInterface
    {
        return new Lexer(
            $data['tokens']['default'],
            $data['skip'],
        );
    }

    /**
     * Create AST builder from compiled data.
     */
    private function createBuilder(array $reducers)
    {
        return new class($reducers) implements BuilderInterface {
            public function __construct(private array $reducers) {}

            public function build(ContextInterface $context, $result)
            {
                $state = $context->getState();

                return isset($this->reducers[$state])
                    ? $this->reducers[$state]($context, $result)
                    : $result;
            }
        };
    }

    /**
     * Create Parser from compiled data.
     */
    private function createParser(LexerInterface $lexer, mixed $data, BuilderInterface $builder): ParserInterface
    {
        return new Parser($lexer, $data['grammar'], [
            // Recognition will start from the specified rule.
            Parser::CONFIG_INITIAL_RULE => $data['initial'],

            // Rules for the abstract syntax tree builder.
            // In this case, we use the data found in the compiled grammar.
            Parser::CONFIG_AST_BUILDER => $builder,
        ]);
    }

    private function ensureGrammarFileExists(string $grammarFilePatch): void
    {
        if (!\file_exists($grammarFilePatch)) {
            throw new GrammarFileNotFoundException(
                "File {$grammarFilePatch} not found",
            );
        }
    }
}

```
###  Path: `/src/DbmlParserFactory.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml;

use Butschster\Dbml\Exceptions\GrammarFileNotFoundException;

class DbmlParserFactory
{
    /**
     * Create parser from grammar file
     */
    public static function create(): DbmlParser
    {
        $path = __DIR__ . '/grammar.php';
        if (!\file_exists($path)) {
            throw new GrammarFileNotFoundException("Grammar file [{$path}] not found.");
        }

        $data = require $path;

        return new DbmlParser(
            $data,
        );
    }
}

```
###  Path: `/src/Exceptions/ColumnNotFoundException.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Exceptions;

class ColumnNotFoundException extends \Exception {}

```
###  Path: `/src/Exceptions/EnumNotFoundException.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Exceptions;

class EnumNotFoundException extends \Exception {}

```
###  Path: `/src/Exceptions/EnumValueNotFoundException.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Exceptions;

class EnumValueNotFoundException extends \Exception {}

```
###  Path: `/src/Exceptions/GrammarFileNotFoundException.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Exceptions;

class GrammarFileNotFoundException extends \RuntimeException {}

```
###  Path: `/src/Exceptions/ProjectSettingNotFoundException.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Exceptions;

class ProjectSettingNotFoundException extends \Exception {}

```
###  Path: `/src/Exceptions/RefActionNotFoundException.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Exceptions;

class RefActionNotFoundException extends \Exception {}

```
###  Path: `/src/Exceptions/TableGroupNotFoundException.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Exceptions;

class TableGroupNotFoundException extends \Exception {}

```
###  Path: `/src/Exceptions/TableNotFoundException.php`

```php
<?php

declare(strict_types=1);

namespace Butschster\Dbml\Exceptions;

class TableNotFoundException extends \Exception {}

```