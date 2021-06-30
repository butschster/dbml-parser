<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

class ColumnsNode
{
    public function __construct(
        private int $offset, private array $columns = []
    )
    {
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}
