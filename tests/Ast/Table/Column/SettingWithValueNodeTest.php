<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast\Table\Column;

use Butschster\Dbml\Ast\Table\Column\SettingWithValueNode;
use Butschster\Dbml\Ast\Values\AbstractValue;
use Butschster\Tests\Ast\TestCase;

class SettingWithValueNodeTest extends TestCase
{
    private SettingWithValueNode $node;

    protected function setUp(): void
    {
        parent::setUp();

        $value = \Mockery::mock(AbstractValue::class);
        $value->shouldReceive('getValue')->once()->andReturn('bar');

        $this->node = new SettingWithValueNode(123, 'key', $value);
    }

    function test_gets_offset()
    {
        $this->assertEquals(123, $this->node->getOffset());
    }

    function test_gets_name()
    {
        $this->assertEquals('key', $this->node->getName());
    }

    function test_gets_value()
    {
        $this->assertEquals('bar', $this->node->getValue()->getValue());
    }
}
