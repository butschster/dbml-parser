<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Index;

class FieldsNode
{
    public function __construct(
        private int $offset, private array $fields
    )
    {
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
