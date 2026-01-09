<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast\Table;

use Butschster\Dbml\Ast\Table\NameNode;
use Butschster\Tests\Ast\TestCase;

class NameNodeTest extends TestCase
{
    private NameNode $node;

    public function test_gets_offset(): void
    {
        $this->assertEquals(123, $this->node->getOffset());
    }

    public function test_gets_value(): void
    {
        $this->assertEquals('user', $this->node->getValue());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = new NameNode(123, 'user');
    }
}
