<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

use Butschster\Dbml\Ast\Values\AbstractValue;

class SettingWithValueNode extends SettingNode
{
    public function __construct(
        int $offset,
        private string $name,
        private AbstractValue $value,
    ) {
        parent::__construct($offset);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): AbstractValue
    {
        return $this->value;
    }
}
