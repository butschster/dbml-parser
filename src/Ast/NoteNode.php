<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Values\StringNode;

class NoteNode
{
    private string $description;

    public function __construct(private int $offset, StringNode $string)
    {
        $this->description = $string->getValue();
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get note description
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
