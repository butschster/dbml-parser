<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

abstract class TypeNode
{
    public function __construct(private int $offset)
    {
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
