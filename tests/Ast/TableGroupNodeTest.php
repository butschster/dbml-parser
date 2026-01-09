<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\Ast\TableGroupNode;

class TableGroupNodeTest extends TestCase
{
    private TableGroupNode $node;

    public function test_gets_offset(): void
    {
        $this->assertEquals(0, $this->node->getOffset());
    }

    public function test_gets_name(): void
    {
        $this->assertEquals('hello_world', $this->node->getName());
    }

    public function test_gets_tables(): void
    {
        $tables = $this->node->getTables();
        $this->assertCount(2, $tables);

        $this->assertEquals('just_test', $tables[0]);
        $this->assertEquals('just_a_test', $tables[1]);
    }

    public function test_check_table_exists(): void
    {
        $this->assertTrue($this->node->hasTable('just_test'));
        $this->assertTrue($this->node->hasTable('just_a_test'));
        $this->assertFalse($this->node->hasTable('test'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = $this->parser->parse(
            <<<DBML
TableGroup hello_world {
    just_test
    just_a_test
}
DBML,
        )->getTableGroup('hello_world');
    }
}
