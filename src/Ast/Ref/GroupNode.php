<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Ref;

use Butschster\Dbml\Ast\RefNode;

class GroupNode
{
    /** @var RefNode[] */
    private array $refs = [];

    public function __construct(
        private int $offset, array $children = []
    )
    {
        $name = null;
        foreach ($children as $child) {
            if ($child instanceof NameNode) {
                $name = $child;
            }
        }

        foreach ($children as $child) {
            if ($child instanceof ColumnsNode) {
                $this->refs[] = new RefNode($offset, [
                    $name,
                    $child
                ]);
            }
        }
    }

    /**
     * Get nodes
     * @return RefNode[]
     */
    public function getRefs(): array
    {
        return $this->refs;
    }
}
