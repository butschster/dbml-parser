<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table;

use Butschster\Dbml\Ast\NoteNode;
use Butschster\Dbml\Ast\Table\Column\Setting\PrimaryKeyNode;
use Butschster\Dbml\Ast\Table\Column\Setting\UniqueNode;
use Butschster\Dbml\Ast\Table\Column\SettingWithValueNode;
use Butschster\Dbml\Ast\Table\Index\FieldsNode;
use Butschster\Dbml\Ast\Values\AbstractValue;

class IndexNode
{
    /** @var AbstractValue[] */
    private array $columns = [];
    private array $settings = [];
    private ?string $name = null;
    private ?string $type = null;
    private bool $primaryKey = false;
    private bool $unique = false;
    private ?string $note = null;

    public function __construct(
        private int $offset, FieldsNode $fields, array $settings = []
    )
    {
        $this->columns = $fields->getFields();

        foreach ($settings as $setting) {
            if ($setting instanceof PrimaryKeyNode) {
                $this->primaryKey = true;
            } else if ($setting instanceof NoteNode) {
                $this->note = $setting->getDescription();
            } else if ($setting instanceof UniqueNode) {
                $this->unique = true;
            } else if ($setting instanceof SettingWithValueNode && $setting->getName() === 'name') {
                $this->name = $setting->getValue()->getValue();
            } else if ($setting instanceof SettingWithValueNode && $setting->getName() === 'type') {
                $this->type = $setting->getValue()->getValue();
            }
        }

        $this->settings = $settings;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function isPrimaryKey(): bool
    {
        return $this->primaryKey;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isUnique(): bool
    {
        return $this->unique;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }
}
