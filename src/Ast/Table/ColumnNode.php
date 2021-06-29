<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table;

use Butschster\Dbml\Ast\Table\Column\SettingsNode;
use Butschster\Dbml\Ast\Table\Column\TypeNode;

class ColumnNode
{
    private string $name;
    private TypeNode $type;

    public function __construct(
        private int $offset, NameNode $name, TypeNode $type, ?SettingsNode $settings = null
    )
    {
        $this->name = $name->getValue();
        $this->type = $type;
    }
}
