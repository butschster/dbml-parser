<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Ref\Action\ActionNode;
use Butschster\Dbml\Ast\Ref\ColumnsNode;
use Butschster\Dbml\Ast\Ref\LeftTableNode;
use Butschster\Dbml\Ast\Ref\NameNode;
use Butschster\Dbml\Ast\Ref\RightTableNode;
use Butschster\Dbml\Ast\Ref\TypeNode;
use Butschster\Dbml\Exceptions\RefActionNotFoundException;

class RefNode
{
    private ?string $name = null;
    private ?TypeNode $type = null;
    private ?LeftTableNode $leftTable = null;
    private ?RightTableNode $rightTable = null;
    /** @var ActionNode[] */
    private array $actions = [];


    public function __construct(
        private int $offset, array $children = []
    )
    {
        foreach ($children as $child) {
            if ($child instanceof NameNode) {
                $this->name = $child->getValue();
            } else if ($child instanceof ColumnsNode) {
                foreach ($child->getColumns() as $column) {
                    if ($column instanceof LeftTableNode) {
                        $this->leftTable = $column;
                    } else if ($column instanceof RightTableNode) {
                        $this->rightTable = $column;
                    } else if ($column instanceof TypeNode) {
                        $this->type = $column;
                    } else if ($column instanceof ActionNode) {
                        $this->actions[$column->getName()] = $column;
                    }
                }
            }
        }
    }

    public function getLeftTable(): ?LeftTableNode
    {
        return $this->leftTable;
    }

    public function getRightTable(): ?RightTableNode
    {
        return $this->rightTable;
    }

    /**
     * Get ref type
     */
    public function getType(): TypeNode
    {
        return $this->type;
    }

    /**
     * Get ref name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get ref actions
     * @return ActionNode[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Check if ref action exists
     */
    public function hasAction(string $name): bool
    {
        return isset($this->actions[$name]);
    }

    /**
     * Get action by name
     * @throws RefActionNotFoundException
     */
    public function getAction(string $name): ActionNode
    {
        if (!$this->hasAction($name)) {
            throw new RefActionNotFoundException('Ref action [$name] not found.');
        }

        return $this->actions[$name];
    }
}
