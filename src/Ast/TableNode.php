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
