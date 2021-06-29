<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Project;

use Butschster\Dbml\Ast\Values\StringNode;

class SettingNode
{
    private string $key;
    private string $value;

    public function __construct(
        private int $offset, SettingKeyNode $key, StringNode $value
    )
    {
        $this->key = $key->getValue();
        $this->value = $value->getValue();
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
