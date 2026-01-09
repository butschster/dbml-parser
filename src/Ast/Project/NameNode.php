<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Project;

use Butschster\Dbml\Ast\Values\StringNode;

class NameNode
{
    private string $value;

    public function __construct(
        private int $offset,
        StringNode $string,
    ) {
        $this->value = $string->getValue();
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
