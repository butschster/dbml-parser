<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\Ast\SchemaNode;
use Butschster\Dbml\Exceptions\EnumNotFoundException;
use Butschster\Dbml\Exceptions\TableGroupNotFoundException;
use Butschster\Dbml\Exceptions\TableNotFoundException;

class SchemaNodeTest extends TestCase
{
    private ?SchemaNode $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = $this->parser->parse(<<<DBML
Project project_test {
  database_type: 'PostgreSQL'
  Note: 'Description of the project'
}

TableGroup foo_bar {
    just_test
    just_a_test
}

Table merchants {
  id int
}

Table orders {
  id int
}

Enum products_status {
  out_of_stock
  in_stock
  running_low [note: 'less than 20'] // add column note
}

Ref: order_items.product_id > products.id
DBML
        );
    }

    function test_gets_project()
    {
        $this->assertEquals('project_test', $this->node->getProject()->getName());
    }

    function test_check_if_project_exists()
    {
        $this->assertTrue($this->node->hasProject());
    }

    function test_gets_not_exists_table_should_throw_an_exception()
    {
        $this->expectException(TableNotFoundException::class);
        $this->expectErrorMessage('Table [test] not found.');
        $this->node->getTable('test');
    }

    function test_gets_table_list()
    {
        $this->assertCount(2, $this->node->getTables());
    }

    function test_gets_table_by_name()
    {
        $this->assertEquals('merchants', $this->node->getTable('merchants')->getName());
    }

    function test_has_table_should_return_true_if_it_exists()
    {
        $this->assertTrue($this->node->hasTable('merchants'));
    }

    function test_has_table_should_return_false_if_it_not_exist()
    {
        $this->assertFalse($this->node->hasTable('bar'));
    }

    function test_gets_not_exists_table_group_should_throw_an_exception()
    {
        $this->expectException(TableGroupNotFoundException::class);
        $this->expectErrorMessage('Table group [test] not found.');
        $this->node->getTableGroup('test');
    }

    function test_gets_table_group_by_name()
    {
        $this->assertEquals('foo_bar', $this->node->getTableGroup('foo_bar')->getName());
    }

    function test_has_table_group_should_return_true_if_it_exist()
    {
        $this->assertTrue($this->node->hasTableGroup('foo_bar'));
    }

    function test_has_table_group_should_return_false_if_it_not_exist()
    {
        $this->assertFalse($this->node->hasTableGroup('bar'));
    }

    function test_gets_not_exists_enums_should_throw_an_exception()
    {
        $this->expectException(EnumNotFoundException::class);
        $this->expectErrorMessage('Enum [test] not found.');
        $this->node->getEnum('test');
    }

    function test_gets_enum_by_name()
    {
        $this->assertEquals('products_status', $this->node->getEnum('products_status')->getName());
    }

    function test_has_enum_should_return_true_if_it_exist()
    {
        $this->assertTrue($this->node->hasEnum('products_status'));
    }

    function test_has_enum_should_return_false_if_it_not_exist()
    {
        $this->assertFalse($this->node->hasEnum('bar'));
    }
}
