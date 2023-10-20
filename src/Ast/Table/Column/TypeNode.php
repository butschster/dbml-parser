<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

use Butschster\Dbml\Ast\Table\NameNode;

class TypeNode
{
    private string $name;
    private ?array $size = null;

    public function __construct(
        private int $offset,
        NameNode $type,
        ?SizeNode $size = null,
    ) {
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
        return $this->size[0] ?? null;
    }

    /**
     * Get max size as array
     */
    public function getSizeArray(): array
    {
        return $this->size ?? [];
    }
}
