<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class NullNode
{
    public function __construct(
        private int $offset
    )
    {
    }

    public function getValue()
    {
        return null;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
