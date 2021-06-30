<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

abstract class AbstractValue
{
    private $value;

    public function __construct(private int $offset, $value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
