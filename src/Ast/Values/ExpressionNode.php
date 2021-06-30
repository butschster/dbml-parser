<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

class ExpressionNode extends AbstractValue
{
    public function __construct(int $offset, string $value)
    {
        parent::__construct($offset, $this->unquoteTokenValue($value));
    }

    private function unquoteTokenValue(string $value): string
    {
        return trim(preg_replace('/(\`{1})([\s\S]*?)\1/i', '$2', $value));
    }
}
