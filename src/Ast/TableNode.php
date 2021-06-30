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
        private int $offset, private string $name, array $children
    )
    {
        foreach ($children as $child) {
            if ($child instanceof AliasNode) {
                $this->alias = $child->getValue();
            } else if ($child instanceof NoteNode) {
                $this->note = $child->getValue();
            } else if ($child instanceof ColumnNode) {
                $this->columns[$child->getName()] = $child;
            } else if ($child instanceof IndexNode) {
                $this->indexes[] = $child;
            }
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getColumn(string $name): ColumnNode
    {
        if (!isset($this->columns[$name])) {
            throw new ColumnNotFoundException("Column [{$name}] not found.");
        }

        return $this->columns[$name];
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getIndexes(): array
    {
        return $this->indexes;
    }
}
