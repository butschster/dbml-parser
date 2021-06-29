<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class IntNode
{
    private int $value;

    public function __construct(private int $offset, string $number)
    {
        $this->value = (int) $number;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
