<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Enum;

use Butschster\Dbml\Ast\NoteNode;

class ValueNode
{
    private ?string $note = null;

    public function __construct(
        private int $offset, private string $value, ?NoteNode $note = null
    )
    {
        if ($note) {
            $this->note = $note->getDescription();
        }
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }
}
