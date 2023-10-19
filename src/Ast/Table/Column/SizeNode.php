<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

class SizeNode
{
    public function __construct(
        private int $offset,
        private string $value,
    ) {
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): array
    {
        return array_map('intval', explode(',', substr($this->value, 1, -1)));
    }
}
