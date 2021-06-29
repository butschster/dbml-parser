<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table\Column;

class SettingsNode
{
    public function __construct(
        private int $offset, array $children
    )
    {
    }
}
