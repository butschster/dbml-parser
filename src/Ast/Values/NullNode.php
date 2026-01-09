<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class NullNode extends AbstractValue
{
    public function __construct(int $offset)
    {
        parent::__construct($offset, null);
    }
}
