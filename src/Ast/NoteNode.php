<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Values\StringNode;

class NoteNode
{
    private string $value;

    public function __construct(private int $offset, StringNode $string)
    {
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
