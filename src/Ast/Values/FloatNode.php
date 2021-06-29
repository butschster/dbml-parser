<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class FloatNode
{
    private float $value;

    public function __construct(private int $offset, string $number)
    {
        $this->value = (float) $number;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
