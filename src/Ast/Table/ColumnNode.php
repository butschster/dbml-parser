<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table;

use Butschster\Dbml\Ast\NoteNode;
use Butschster\Dbml\Ast\RefNode;
use Butschster\Dbml\Ast\Table\Column\Setting\IncrementNode;
use Butschster\Dbml\Ast\Table\Column\Setting\NotNullNode;
use Butschster\Dbml\Ast\Table\Column\Setting\NullNode;
use Butschster\Dbml\Ast\Table\Column\Setting\PrimaryKeyNode;
use Butschster\Dbml\Ast\Table\Column\Setting\UniqueNode;
use Butschster\Dbml\Ast\Table\Column\SettingWithValueNode;
use Butschster\Dbml\Ast\Table\Column\TypeNode;
use Butschster\Dbml\Ast\Values\AbstractValue;

class ColumnNode
{
    private string $name;
    private TypeNode $type;
    private ?string $note = null;
    private ?AbstractValue $default = null;
    private bool $primaryKey = false;
    private bool $increment = false;
    private bool $unique = false;
    private bool $null = true;
    /** @var SettingWithValueNode[] */
    private array $settings = [];
    /** @var RefNode[]  */
    private array $refs = [];

    public function __construct(
        private int $offset, \Butschster\Dbml\Ast\Table\Column\NameNode $name, TypeNode $type, array $settings = []
    )
    {
        $this->name = $name->getValue();
        $this->type = $type;

        foreach ($settings as $setting) {
            if ($setting instanceof NoteNode) {
                $this->note = $setting->getDescription();
            } else if ($setting instanceof UniqueNode) {
                $this->unique = true;
            } else if ($setting instanceof NotNullNode) {
                $this->null = false;
            } else if ($setting instanceof NullNode) {
                $this->null = true;
            } else if ($setting instanceof IncrementNode) {
                $this->increment = true;
            } else if ($setting instanceof PrimaryKeyNode) {
                $this->primaryKey = true;
            } else if ($setting instanceof SettingWithValueNode && $setting->getName() === 'default') {
                $this->default = $setting->getValue();
            } else if ($setting instanceof SettingWithValueNode) {
                $this->settings[] = $setting;
            } else if ($setting instanceof RefNode) {
                $this->refs[] = $setting;
            }
        }
    }

    /**
     * Get column name
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
     * Get column type
     */
    public function getType(): TypeNode
    {
        return $this->type;
    }

    /**
     * Get column default value
     */
    public function getDefault(): ?AbstractValue
    {
        return $this->default;
    }

    /**
     * Get column note
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * Get column settings
     * @return SettingWithValueNode[]
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * Check if column is primary
     */
    public function isPrimaryKey(): bool
    {
        return $this->primaryKey;
    }

    /**
     * Check if column is auto increment
     */
    public function isIncrement(): bool
    {
        return $this->increment;
    }

    /**
     * Check if column is unique
     */
    public function isUnique(): bool
    {
        return $this->unique;
    }

    /**
     * Check if column is nullable
     */
    public function isNull(): bool
    {
        return $this->null;
    }

    /**
     * Get column refs
     * @return RefNode[]
     */
    public function getRefs(): array
    {
        return $this->refs;
    }
}
