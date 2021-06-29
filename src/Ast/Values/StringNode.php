<?php
declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

use Phplrt\Lexer\Token\Token;

class StringNode
{
    private string $value;

    public function __construct(private int $offset, Token $token)
    {
        $this->value = match ($token->getName()) {
            'T_WORD' => $token->getValue(),
            'T_QUOTED_STRING' => $this->unquoteTokenValue($token->getValue())
        };
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    private function unquoteTokenValue(string $value): string
    {
        return trim(preg_replace('/(\'{3}|[\"\']{1})([^\'\"][\s\S]*?)\1/i', '$2', $value));
    }
}
