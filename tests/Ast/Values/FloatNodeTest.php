<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast\Values;

use Butschster\Dbml\Ast\Values\FloatNode;
use Butschster\Tests\Ast\TestCase;

class FloatNodeTest extends TestCase
{
    /**
     * @dataProvider floatStringValues
     * @param mixed $value
     */
    public function test_value_should_be_converted_to_float($value, float $result): void
    {
        $node = new FloatNode(0, $value);

        $this->assertSame($result, $node->getValue());
    }

    public function floatStringValues()
    {
        return [
            ['123.123', 123.123],
            [123.123, 123.123],
            ['123', 123.0],
        ];
    }
}
