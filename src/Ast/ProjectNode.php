<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Project\NameNode;
use Butschster\Dbml\Ast\Project\SettingNode;
use Phplrt\Lexer\Token\Token;

class ProjectNode
{
    private ?string $note = null;
    private array $settings = [];
    private string $name;

    public function __construct(
        private int $offset,
        array $children
    )
    {
        foreach ($children as $child) {
            if ($child instanceof NoteNode) {
                $this->note = $child->getValue();
            } else if ($child instanceof SettingNode) {
                $this->settings[] = $child;
            } else if ($child instanceof NameNode) {
                $this->name = $child->getValue();
            }
        }
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
