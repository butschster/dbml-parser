<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast;

use Butschster\Dbml\Ast\Project\NameNode;
use Butschster\Dbml\Ast\Project\SettingNode;
use Butschster\Dbml\Exceptions\ProjectSettingNotFoundException;

class ProjectNode
{
    private ?string $note = null;
    /** @var SettingNode[] */
    private array $settings = [];
    private string $name;

    public function __construct(
        private int $offset,
        array $children
    )
    {
        foreach ($children as $child) {
            if ($child instanceof NoteNode) {
                $this->note = $child->getDescription();
            } else if ($child instanceof SettingNode) {
                $this->settings[$child->getKey()] = $child;
            } else if ($child instanceof NameNode) {
                $this->name = $child->getValue();
            }
        }
    }

    /**
     * Get project name
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get project note
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * Get project settings
     * @return SettingNode[]
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * Check if project has settings with given name
     */
    public function hasSetting(string $name): bool
    {
        return isset($this->settings[$name]);
    }

    /**
     * Get setting by name
     * @throws ProjectSettingNotFoundException
     */
    public function getSetting(string $name): SettingNode
    {
        if (!$this->hasSetting($name)) {
            throw new ProjectSettingNotFoundException("Project setting [{$name}] not found.");
        }

        return $this->settings[$name];
    }
}
