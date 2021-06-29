<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast\Table;

use Butschster\Dbml\Ast\Table\AliasNode;
use Butschster\Tests\Ast\TestCase;

class AliasNodeTest extends TestCase
{
    private AliasNode $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = new AliasNode(123, 'user');
    }

    function test_gets_offset()
    {
        $this->assertEquals(123, $this->node->getOffset());
    }

    function test_gets_value()
    {
        $this->assertEquals('user', $this->node->getValue());
    }
}
