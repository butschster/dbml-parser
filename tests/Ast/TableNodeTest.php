<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\Ast\TableNode;
use Butschster\Dbml\Exceptions\ColumnNotFoundException;

class TableNodeTest extends TestCase
{
    private TableNode $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = $this->parser->parse(
            <<<DBML
Table users as U {
    id int [pk, not null, unique, increment, note: 'hello world'] // auto-increment
    full_name varchar(150) [not null, unique, default: 1, ref: > profiles.id, ref: > countries.(id, name)]
    created_at timestamp [not null]
    country_code int
    type int
    note int
    Note: 'khong hieu duoc'

    indexes {
        id [name: 'created_at_index', note: 'Date', type: hash, pk]
        (id, name)
    }
}
DBML
        )->getTable('users');
    }

    public function testFieldsShouldBeParsed()
    {
        $this->assertCount(6, $this->node->getColumns());
    }

    public function testIndexedShouldBeParsed()
    {
        $this->assertCount(2, $this->node->getIndexes());
    }

    public function testNonExistsColumnShouldThrowAnException()
    {
        $this->expectException(ColumnNotFoundException::class);
        $this->expectErrorMessage('Column [not_exists] not found.');
        $this->node->getColumn('not_exists');
    }

    public function testGetsIdColumn()
    {
        // id int [pk, unique, increment, note: 'hello world'] // auto-increment
        $column = $this->node->getColumn('id');

        $this->assertEquals('id', $column->getName());
        $this->assertEquals('int', $column->getType()->getName());
        $this->assertEquals('hello world', $column->getNote());
        $this->assertNull($column->getDefault());
        $this->assertNull($column->getType()->getSize());
        $this->assertTrue($column->isPrimaryKey());
        $this->assertTrue($column->isUnique());
        $this->assertTrue($column->isIncrement());
        $this->assertFalse($column->isNull());
    }

    public function testGetsFullNameColumn()
    {
        // full_name varchar(150) [not null, unique, default: 1, ref: > profiles.id, ref: > countries.(id, name)]
        $column = $this->node->getColumn('full_name');

        $this->assertEquals('full_name', $column->getName());
        $this->assertEquals('varchar', $column->getType()->getName());
        $this->assertEquals(150, $column->getType()->getSize());

        $this->assertNull($column->getNote());
        $this->assertSame(1, $column->getDefault()->getValue());
        $this->assertFalse($column->isPrimaryKey());
        $this->assertTrue($column->isUnique());
        $this->assertFalse($column->isIncrement());
        $this->assertFalse($column->isNull());

        $this->assertCount(2, $column->getRefs());
        $ref = $column->getRefs()[0];

        $this->assertNull($ref->getLeftTable());
        $this->assertEquals('profiles', $ref->getRightTable()->getTable());
        $this->assertEquals(['id'], $ref->getRightTable()->getColumns());

        $ref = $column->getRefs()[1];

        $this->assertNull($ref->getLeftTable());
        $this->assertEquals('countries', $ref->getRightTable()->getTable());
        $this->assertEquals(['id', 'name'], $ref->getRightTable()->getColumns());
    }

    public function testGetsCreatedAtColumn()
    {
        // created_at timestamp
        $column = $this->node->getColumn('created_at');

        $this->assertEquals('created_at', $column->getName());
        $this->assertEquals('timestamp', $column->getType()->getName());
        $this->assertNull($column->getType()->getSize());

        $this->assertNull($column->getNote());
        $this->assertNull($column->getDefault());
        $this->assertFalse($column->isPrimaryKey());
        $this->assertFalse($column->isUnique());
        $this->assertFalse($column->isIncrement());
        $this->assertFalse($column->isNull());
    }

    public function testGetsName()
    {
        $this->assertEquals('users', $this->node->getName());
    }

    public function testGetsAlias()
    {
        $this->assertEquals('U', $this->node->getAlias());
    }

    public function testGetsNote()
    {
        $this->assertEquals('khong hieu duoc', $this->node->getNote());
    }

    public function testGetsColumns()
    {
        $this->assertCount(6, $this->node->getColumns());
    }

    public function testGetsIndexes()
    {
        $this->assertCount(2, $this->node->getIndexes());
    }

    public function testGetsIdIndex()
    {
        // id [name: 'created_at_index', note: 'Date', type: hash, pk]
        $index = $this->node->getIndexes()[0];

        $this->assertCount(1, $index->getColumns());
        $this->assertEquals('id', $index->getColumns()[0]->getValue());
        $this->assertCount(4, $index->getSettings());

        $this->assertTrue($index->isPrimaryKey());
        $this->assertFalse($index->isUnique());
        $this->assertEquals('created_at_index', $index->getName());
        $this->assertEquals('Date', $index->getNote());
    }

    public function testGetsIdNameIndex()
    {
        // (id, name)
        $index = $this->node->getIndexes()[1];

        $this->assertCount(2, $index->getColumns());
        $this->assertEquals('id', $index->getColumns()[0]->getValue());
        $this->assertEquals('name', $index->getColumns()[1]->getValue());
        $this->assertCount(0, $index->getSettings());

        $this->assertFalse($index->isPrimaryKey());
        $this->assertFalse($index->isUnique());
        $this->assertNull($index->getName());
        $this->assertNull($index->getNote());
    }
}
