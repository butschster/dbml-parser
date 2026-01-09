<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\Ast\Ref\Type\ManyToOneNode;
use Butschster\Dbml\Ast\Ref\Type\OneToManyNode;
use Butschster\Dbml\Ast\Ref\Type\OneToOneNode;
use Butschster\Dbml\Ast\SchemaNode;

class RefNodeTest extends TestCase
{
    private SchemaNode $node;

    public function test_ref_with_single_columns(): void
    {
        // Ref name_optional: table1.column1 < table2.column2
        $ref = $this->node->getRefs()[0];

        $this->assertEquals('name_optional', $ref->getName());
        $this->assertInstanceOf(OneToManyNode::class, $ref->getType());

        $this->assertEquals('table1', $ref->getLeftTable()->getTable());
        $this->assertEquals(['column1'], $ref->getLeftTable()->getColumns());

        $this->assertEquals('table2', $ref->getRightTable()->getTable());
        $this->assertEquals(['column2'], $ref->getRightTable()->getColumns());
    }

    public function test_ref_with_composite_columns(): void
    {
        // Ref: table1.column1 < table2.(id, name)
        $ref = $this->node->getRefs()[1];

        $this->assertNull($ref->getName());
        $this->assertInstanceOf(OneToOneNode::class, $ref->getType());

        $this->assertEquals('table1', $ref->getLeftTable()->getTable());
        $this->assertEquals(['column1'], $ref->getLeftTable()->getColumns());

        $this->assertEquals('table2', $ref->getRightTable()->getTable());
        $this->assertEquals(['id', 'name'], $ref->getRightTable()->getColumns());
    }

    public function test_ref_long_form(): void
    {
        // Ref name_optional {
        //    U.country_code > countries.code
        //    merchants.country_code > C.test
        // }

        $ref = $this->node->getRefs()[2];

        $this->assertEquals('name_optional', $ref->getName());
        $this->assertInstanceOf(ManyToOneNode::class, $ref->getType());

        $this->assertEquals('U', $ref->getLeftTable()->getTable());
        $this->assertEquals(['country_code'], $ref->getLeftTable()->getColumns());

        $this->assertEquals('countries', $ref->getRightTable()->getTable());
        $this->assertEquals(['code'], $ref->getRightTable()->getColumns());


        $ref = $this->node->getRefs()[3];

        $this->assertEquals('name_optional', $ref->getName());
        $this->assertInstanceOf(ManyToOneNode::class, $ref->getType());

        $this->assertEquals('merchants', $ref->getLeftTable()->getTable());
        $this->assertEquals(['country_code'], $ref->getLeftTable()->getColumns());

        $this->assertEquals('C', $ref->getRightTable()->getTable());
        $this->assertEquals(['test'], $ref->getRightTable()->getColumns());
    }

    public function test_ref_long_form_without_name(): void
    {
        // Ref {
        //    table1.column1 < table2.column2
        // }

        $ref = $this->node->getRefs()[4];

        $this->assertNull($ref->getName());
        $this->assertInstanceOf(OneToManyNode::class, $ref->getType());

        $this->assertEquals('table1', $ref->getLeftTable()->getTable());
        $this->assertEquals(['column1'], $ref->getLeftTable()->getColumns());

        $this->assertEquals('table2', $ref->getRightTable()->getTable());
        $this->assertEquals(['column2'], $ref->getRightTable()->getColumns());
    }

    public function test_ref_with_actions(): void
    {
        // Ref: products.merchant_id > merchants.id [delete: cascade, update: no action]

        $ref = $this->node->getRefs()[5];

        $this->assertNull($ref->getName());
        $this->assertInstanceOf(ManyToOneNode::class, $ref->getType());


        $this->assertEquals('products', $ref->getLeftTable()->getTable());
        $this->assertEquals(['merchant_id'], $ref->getLeftTable()->getColumns());

        $this->assertEquals('merchants', $ref->getRightTable()->getTable());
        $this->assertEquals(['id'], $ref->getRightTable()->getColumns());

        $onDelete = $ref->getAction('delete');
        $this->assertEquals('cascade', $onDelete->getAction());

        $onUpdate = $ref->getAction('update');
        $this->assertEquals('no action', $onUpdate->getAction());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = $this->parser->parse(
            <<<DBML
Ref name_optional: table1.column1 < table2.column2
Ref: table1.column1 - table2.(id, name)

Ref name_optional {
  U.country_code > countries.code
  merchants.country_code > C.test
}

Ref {
  table1.column1 < table2.column2
}

Ref: products.merchant_id > merchants.id [delete: cascade, update: no action]
DBML,
        );
    }
}
