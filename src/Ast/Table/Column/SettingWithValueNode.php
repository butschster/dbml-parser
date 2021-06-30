<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

use Butschster\Dbml\Ast\Values\AbstractValue;

class SettingWithValueNode extends SettingNode
{
    private AbstractValue $value;

    public function __construct(
        int $offset,
        private string $name,
        AbstractValue $value
    )
    {
        parent::__construct($offset);
        $this->value = $value;
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
