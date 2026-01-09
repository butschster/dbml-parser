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
