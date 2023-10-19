<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

use Phplrt\Lexer\Token\Token;

class StringNode extends AbstractValue
{

    public function __construct(int $offset, Token $token)
    {
        $value = match ($token->getName()) {
            'T_WORD' => $token->getValue(),
            'T_QUOTED_STRING' => $this->unquoteTokenValue($token->getValue()),
        };

        parent::__construct($offset, $this->convertType($value));
    }

    private function convertType(string $value): mixed
    {
        if (ctype_digit($value)) {
            return (int)$value;
        }

        if (is_numeric($value)) {
            return (float)$value;
        }

        if (in_array(strtolower($value), ['true', 'false'])) {
            return strtolower($value) === 'true';
        }

        return $value;
    }

    private function unquoteTokenValue(string $value): string
    {
        return trim(preg_replace('/(\'{3}|[\"\']{1})([^\'\"][\s\S]*?)\1/i', '$2', $value));
    }
}
