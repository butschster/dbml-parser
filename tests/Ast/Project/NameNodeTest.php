<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast\Project;

use Butschster\Dbml\Ast\Project\NameNode;
use Butschster\Dbml\Ast\Values\StringNode;
use Butschster\Tests\Ast\TestCase;
use Mockery as m;

class NameNodeTest extends TestCase
{
    function test_value_should_be_returned()
    {
        $string = m::mock(StringNode::class);
        $string->shouldReceive('getValue')->once()->andReturn('hello world');

        $note = new NameNode(
            123, $string
        );

        $this->assertEquals('hello world', $note->getValue());
        $this->assertEquals(123, $note->getOffset());
    }
}
