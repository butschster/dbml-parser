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
