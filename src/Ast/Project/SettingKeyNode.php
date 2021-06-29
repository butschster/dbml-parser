<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Project;

class SettingKeyNode
{
    public function __construct(
        private int $offset, private string $value
    )
    {
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
