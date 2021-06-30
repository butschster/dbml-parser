<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast\Values;

use Butschster\Dbml\Ast\NoteNode;
use Butschster\Dbml\Ast\Values\StringNode;
use Butschster\Tests\Ast\TestCase;
use Mockery as m;

class NoteNodeTest extends TestCase
{
    function test_value_should_be_returned()
    {
        $string = m::mock(StringNode::class);
        $string->shouldReceive('getValue')->once()->andReturn('hello world');

        $note = new NoteNode(
            123, $string
        );

        $this->assertEquals('hello world', $note->getDescription());
        $this->assertEquals(123, $note->getOffset());
    }
}
