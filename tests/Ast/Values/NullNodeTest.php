<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast\Values;

use Butschster\Dbml\Ast\Values\NullNode;
use Butschster\Tests\Ast\TestCase;

class NullNodeTest extends TestCase
{
    public function test_it_should_return_null(): void
    {
        $node = new NullNode(123);

        $this->assertNull($node->getValue());
        $this->assertEquals(123, $node->getOffset());
    }
}
