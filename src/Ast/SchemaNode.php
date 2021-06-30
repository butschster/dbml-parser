<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast;

class SchemaNode
{
    private ?ProjectNode $project = null;

    /** @var TableNode[] */
    private array $tables = [];
    private array $enums = [];
    private array $refs = [];
    private array $tableGroups = [];

    public function __construct(array $children)
    {
        foreach ($children as $child) {
            if ($child instanceof ProjectNode) {
                $this->project = $child;
            } else if ($child instanceof TableNode) {
                $this->tables[$child->getName()] = $child;
            }
        }
    }

    public function getProject(): ?ProjectNode
    {
        return $this->project;
    }

    public function getTables(): array
    {
        return $this->tables;
    }
}
