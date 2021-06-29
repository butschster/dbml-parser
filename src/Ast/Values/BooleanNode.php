<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class BooleanNode
{
    private bool $value;

    public function __construct(private int $offset, bool $value)
    {
        $this->value = $value;
    }

    public function getValue(): bool
    {
        return $this->value;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
