<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

use Butschster\Dbml\Ast\Table\NameNode;
use Butschster\Dbml\Ast\Values\IntNode;

class TypeNode
{
    private string $type;
    private ?int $size = null;

    public function __construct(
        private int $offset, NameNode $type, ?IntNode $size = null
    )
    {
        $this->type = $type->getValue();
        $this->size = $size ? $size->getValue() : null;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }
}
