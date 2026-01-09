<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast\Values;

use Butschster\Dbml\Ast\Values\ExpressionNode;
use Butschster\Tests\Ast\TestCase;

class ExpressionNodeTest extends TestCase
{
    public function test_value_should_be_unquoted(): void
    {
        $node = new ExpressionNode(0, '`now()`');
        $this->assertEquals('now()', $node->getValue());
    }
}
