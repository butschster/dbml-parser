<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast\Project;

use Butschster\Dbml\Ast\Project\SettingKeyNode;
use Butschster\Tests\Ast\TestCase;

class SettingKeyNodeTest extends TestCase
{
    private SettingKeyNode $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = new SettingKeyNode(
            123, 'hello world'
        );
    }

    function test_gets_offset()
    {
        $this->assertEquals(123, $this->node->getOffset());
    }

    function test_gets_value()
    {
        $this->assertEquals('hello world', $this->node->getValue());
    }
}
