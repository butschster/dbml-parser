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
            'T_QUOTED_STRING' => $this->unquoteTokenValue($token->getValue())
        };

        parent::__construct($offset, $value);
    }

    private function unquoteTokenValue(string $value): string
    {
        return trim(preg_replace('/(\'{3}|[\"\']{1})([^\'\"][\s\S]*?)\1/i', '$2', $value));
    }
}
