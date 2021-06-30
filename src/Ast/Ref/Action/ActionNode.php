<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref\Action;

abstract class ActionNode
{
    public function __construct(
        private int $offset, private string $name, private string $action
    )
    {

    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
