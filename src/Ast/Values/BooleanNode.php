<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class BooleanNode extends AbstractValue
{
    public function __construct(int $offset, $value)
    {
        parent::__construct($offset, (bool) $value);
    }
}
