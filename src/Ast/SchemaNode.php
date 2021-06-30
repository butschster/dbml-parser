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
            } else if ($child instanceof TableNode) {
                $this->tables[$child->getName()] = $child;
            } else if ($child instanceof TableGroupNode) {
                $this->tableGroups[$child->getName()] = $child;
            } else if ($child instanceof EnumNode) {
                $this->enums[$child->getName()] = $child;
            } else if ($child instanceof RefNode) {
                $this->refs[] = $child;
            } else if ($child instanceof GroupNode) {
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
