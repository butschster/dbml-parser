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
