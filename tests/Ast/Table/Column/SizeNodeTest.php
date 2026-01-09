<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast\Table\Column;

use Butschster\Dbml\Ast\Table\Column\SizeNode;
use Butschster\Tests\Ast\TestCase;

class SizeNodeTest extends TestCase
{
    public function test_gets_offset(): void
    {
        $node = new SizeNode(123, '(1)');
        $this->assertEquals(123, $node->getOffset());
    }

    public function test_gets_value(): void
    {
        $node = new SizeNode(123, '(1)');
        $this->assertSame([1], $node->getValue());
    }

    public function test_gets_coma_separated_value(): void
    {
        $node = new SizeNode(123, '(8,2)');
        $this->assertSame([8,2], $node->getValue());
    }
}
