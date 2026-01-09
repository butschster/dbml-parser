<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast\Values;

use Butschster\Dbml\Ast\Values\BooleanNode;
use Butschster\Tests\Ast\TestCase;

class BooleanNodeTest extends TestCase
{
    public function test_T_BOOL_TRUE_should_be_return_true(): void
    {
        $node = new BooleanNode(0, true);
        $this->assertTrue($node->getValue());
    }

    public function test_T_BOOL_FALSE_should_be_return_false(): void
    {
        $node = new BooleanNode(0, false);
        $this->assertFalse($node->getValue());
    }

    public function test_gets_offset(): void
    {
        $node = new BooleanNode(123, false);
        $this->assertEquals(123, $node->getOffset());
    }
}
