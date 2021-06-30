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
        <TableGroupName offset="11">
            <T_WORD offset="11">test</T_WORD>
        </TableGroupName>
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


    function test_table_group_with_extra_symbols_should_be_parsed()
    {
        $this->assertAst(<<<DBML
TableGroup ecommerce1 {
    merchants
    countries
}
DBML
            , <<<AST
<Schema offset="0">
    <TableGroup offset="0">
        <TableGroupName offset="11">
            <T_WORD offset="11">ecommerce1</T_WORD>
        </TableGroupName>
        <TableName offset="28">
            <T_WORD offset="28">merchants</T_WORD>
        </TableName>
        <TableName offset="42">
            <T_WORD offset="42">countries</T_WORD>
        </TableName>
    </TableGroup>
</Schema>
AST
        );
    }
}
