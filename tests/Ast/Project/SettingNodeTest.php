<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast\Project;

use Butschster\Dbml\Ast\Project\SettingKeyNode;
use Butschster\Dbml\Ast\Project\SettingNode;
use Butschster\Dbml\Ast\Values\StringNode;
use Butschster\Tests\Ast\TestCase;
use Phplrt\Lexer\Token\Token;

class SettingNodeTest extends TestCase
{
    private SettingNode $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = new SettingNode(
            123,
            new SettingKeyNode(234, 'key'),
            new StringNode(345, new Token('T_WORD', 'value', 123))
        );
    }

    function test_gets_offset()
    {
        $this->assertEquals(123, $this->node->getOffset());
    }

    function test_gets_key()
    {
        $this->assertEquals('key', $this->node->getKey());
    }

    function test_gets_value()
    {
        $this->assertEquals('value', $this->node->getValue());
    }
}
