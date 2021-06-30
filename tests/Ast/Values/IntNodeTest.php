<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast\Values;

use Butschster\Dbml\Ast\Values\IntNode;
use Butschster\Tests\Ast\TestCase;

class IntNodeTest extends TestCase
{
    /**
     * @dataProvider intStringValues
     */
    function test_value_should_be_converted_to_float($value, int $result)
    {
        $node = new IntNode(0, $value);

        $this->assertSame($result, $node->getValue());
    }

    public function intStringValues()
    {
        return [
            ['123', 123],
            [123, 123],
            ['123.123', 123]
        ];
    }
}
