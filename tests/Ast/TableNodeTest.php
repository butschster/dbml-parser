<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\Ast\TableNode;

class TableNodeTest extends TestCase
{
    private TableNode $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = $this->parser->parse(<<<DBML
Table users as U {
    id int [pk, unique, increment] // auto-increment
    full_name varchar(150) [not null, unique, default: 1]
    created_at timestamp
    country_code int
    type int
    note int
    Note: 'khong hieu duoc'

    indexes {
        id [name: 'created_at_index', note: 'Date', type: hash, pk]
    }
}
DBML
        )->getTables()['users'];

    }

    function test_gets_name()
    {
        $this->assertEquals('users', $this->node->getName());
    }

    function test_gets_alias()
    {
        $this->assertEquals('U', $this->node->getAlias());
    }

    function test_gets_note()
    {
        $this->assertEquals('khong hieu duoc', $this->node->getNote());
    }

    function test_gets_columns()
    {
        $this->assertCount(6, $this->node->getColumns());
    }

    function test_gets_indexes()
    {
        $this->assertCount(1, $this->node->getIndexes());
    }
}
