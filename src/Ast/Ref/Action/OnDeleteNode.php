<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref\Action;

class OnDeleteNode extends ActionNode
{
    public function __construct(int $offset, string $action)
    {
        parent::__construct($offset, 'delete', $action);
    }
}
