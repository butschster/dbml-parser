<?php
declare(strict_types=1);

namespace Butschster\Tests\Parsers;

class TableGroupTest extends TestCase
{
    function test_table_group_should_be_parsed()
    {
        $this->assertAst(<<<DBML
TableGroup test {
    merchants
    countries
}
DBML
            , <<<AST
<Schema offset="0">
    <TableGroup offset="0">
        <T_WORD offset="11">test</T_WORD>
        <TableName offset="22">
            <T_WORD offset="22">merchants</T_WORD>
        </TableName>
        <TableName offset="36">
            <T_WORD offset="36">countries</T_WORD>
        </TableName>
    </TableGroup>
</Schema>
AST
        );
    }
}
