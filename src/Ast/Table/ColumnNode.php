<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Table;

use Butschster\Dbml\Ast\NoteNode;
use Butschster\Dbml\Ast\Table\Column\RefNode;
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
    private bool $null = false;
    private array $settings = [];
    private array $refs = [];

    public function __construct(
        private int $offset, NameNode $name, TypeNode $type, array $settings = []
    )
    {
        $this->name = $name->getValue();
        $this->type = $type;

        foreach ($settings as $setting) {
            if ($setting instanceof NoteNode) {
                $this->note = $setting->getValue();
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

            var_dump($this->refs);
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getType(): TypeNode
    {
        return $this->type;
    }

    public function getDefault(): ?AbstractValue
    {
        return $this->default;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function isPrimaryKey(): bool
    {
        return $this->primaryKey;
    }

    public function isIncrement(): bool
    {
        return $this->increment;
    }

    public function isUnique(): bool
    {
        return $this->unique;
    }

    public function isNull(): bool
    {
        return $this->null;
    }
}
