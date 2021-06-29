<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast\Values;

use Butschster\Dbml\Ast\Values\StringNode;
use Butschster\Tests\Ast\TestCase;
use Phplrt\Lexer\Token\Token;

class StringNodeTest extends TestCase
{
    function test_T_WORD_should_be_return_as_is()
    {
        $node = new StringNode(0, new Token('T_WORD', 'project_name', 0));
        $this->assertEquals('project_name', $node->getValue());
    }

    /**
     * @dataProvider quotedStrings
     */
    function test_T_QUOTED_STRING_should_be_unquoted(string $string)
    {
        $node = new StringNode(0, new Token('T_QUOTED_STRING', $string, 0));

        $this->assertEquals('PostgreSql', $node->getValue());
    }

    public function quotedStrings()
    {
        return [
            ['\'PostgreSql\''],
            ['"PostgreSql"'],
            ['\'\'\'PostgreSql\'\'\''],
            [<<<EOL
'''
PostgreSql
'''
EOL
]
        ];
    }
}
