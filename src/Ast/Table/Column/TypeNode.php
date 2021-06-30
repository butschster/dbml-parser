<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

use Butschster\Dbml\Ast\Table\NameNode;
use Butschster\Dbml\Ast\Values\IntNode;

class TypeNode
{
    private string $name;
    private ?int $size = null;

    public function __construct(
        private int $offset, NameNode $type, ?IntNode $size = null
    )
    {
        $this->name = $type->getValue();
        $this->size = $size ? $size->getValue() : null;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get type name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get max size
     */
    public function getSize(): ?int
    {
        return $this->size;
    }
}
