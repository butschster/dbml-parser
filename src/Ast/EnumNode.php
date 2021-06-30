<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Enum\ValueNode;
use Butschster\Dbml\Exceptions\EnumValueNotFoundException;

class EnumNode
{
    /** @var ValueNode[] */
    private array $values = [];

    public function __construct(
        private int $offset, private string $name, array $values = []
    )
    {
        foreach ($values as $value) {
            $this->values[$value->getValue()] = $value;
        }
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get enum name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get amount of values
     */
    public function count(): int
    {
        return count($this->values);
    }

    /**
     * Get enum values
     * @return ValueNode[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Check if enum contains value
     * @param string $name
     * @return bool
     */
    public function hasValue(string $name): bool
    {
        return array_key_exists($name, $this->values);
    }

    /**
     * Get enum value object by name
     * @throws EnumValueNotFoundException
     */
    public function getValue(string $value): ValueNode
    {
        if (!$this->hasValue($value)) {
            throw new EnumValueNotFoundException("Enum value [{$value}] not found.");
        }

        return $this->values[$value];
    }
}
