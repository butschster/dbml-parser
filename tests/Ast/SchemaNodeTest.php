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

    public function test_gets_project(): void
    {
        $this->assertEquals('project_test', $this->node->getProject()->getName());
    }

    public function test_check_if_project_exists(): void
    {
        $this->assertTrue($this->node->hasProject());
    }

    public function test_gets_not_exists_table_should_throw_an_exception(): void
    {
        $this->expectException(TableNotFoundException::class);
        $this->expectExceptionMessage('Table [test] not found.');
        $this->node->getTable('test');
    }

    public function test_gets_table_list(): void
    {
        $this->assertCount(2, $this->node->getTables());
    }

    public function test_gets_table_by_name(): void
    {
        $this->assertEquals('merchants', $this->node->getTable('merchants')->getName());
    }

    public function test_has_table_should_return_true_if_it_exists(): void
    {
        $this->assertTrue($this->node->hasTable('merchants'));
    }

    public function test_has_table_should_return_false_if_it_not_exist(): void
    {
        $this->assertFalse($this->node->hasTable('bar'));
    }

    public function test_gets_not_exists_table_group_should_throw_an_exception(): void
    {
        $this->expectException(TableGroupNotFoundException::class);
        $this->expectExceptionMessage('Table group [test] not found.');
        $this->node->getTableGroup('test');
    }

    public function test_gets_table_group_by_name(): void
    {
        $this->assertEquals('foo_bar', $this->node->getTableGroup('foo_bar')->getName());
    }

    public function test_has_table_group_should_return_true_if_it_exist(): void
    {
        $this->assertTrue($this->node->hasTableGroup('foo_bar'));
    }

    public function test_has_table_group_should_return_false_if_it_not_exist(): void
    {
        $this->assertFalse($this->node->hasTableGroup('bar'));
    }

    public function test_gets_not_exists_enums_should_throw_an_exception(): void
    {
        $this->expectException(EnumNotFoundException::class);
        $this->expectExceptionMessage('Enum [test] not found.');
        $this->node->getEnum('test');
    }

    public function test_gets_enum_by_name(): void
    {
        $this->assertEquals('products_status', $this->node->getEnum('products_status')->getName());
    }

    public function test_has_enum_should_return_true_if_it_exist(): void
    {
        $this->assertTrue($this->node->hasEnum('products_status'));
    }

    public function test_has_enum_should_return_false_if_it_not_exist(): void
    {
        $this->assertFalse($this->node->hasEnum('bar'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = $this->parser->parse(
            <<<DBML
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
DBML,
        );
    }
}
