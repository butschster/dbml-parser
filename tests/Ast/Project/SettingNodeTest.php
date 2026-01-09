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

    public function test_gets_offset(): void
    {
        $this->assertEquals(123, $this->node->getOffset());
    }

    public function test_gets_key(): void
    {
        $this->assertEquals('key', $this->node->getKey());
    }

    public function test_gets_value(): void
    {
        $this->assertEquals('value', $this->node->getValue());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = new SettingNode(
            123,
            new SettingKeyNode(234, 'key'),
            new StringNode(345, new Token('T_WORD', 'value', 123)),
        );
    }
}
