<?php
declare(strict_types=1);

namespace Butschster\Tests\Parsers;

class ForeignKeysParserTest extends TestCase
{
    function test_column_many_to_one_relation_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table posts {
    id integer
    user_id integer [ref: > users.id] // many-to-one
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">posts</T_WORD>
        </TableName>
        <TableColumn offset="18">
            <TableColumnName offset="18">
                <T_WORD offset="18">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="21">
                <TableColumnTypeName offset="21">
                    <T_WORD offset="21">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="33">
            <TableColumnName offset="33">
                <T_WORD offset="33">user_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="41">
                <TableColumnTypeName offset="41">
                    <T_WORD offset="41">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnRef offset="50">
                <RefType offset="55">
                    <T_GT offset="55">></T_GT>
                </RefType>
                <RefRightColumn offset="57">
                    <TableName offset="57">
                        <T_WORD offset="57">users</T_WORD>
                    </TableName>
                    <TableColumnName offset="63">
                        <T_WORD offset="63">id</T_WORD>
                    </TableColumnName>
                </RefRightColumn>
            </TableColumnRef>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }


    function test_column_relation_with_composite_key_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table posts {
    id integer
    user_id integer [ref: > users.(id, country_code)] // many-to-one
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">posts</T_WORD>
        </TableName>
        <TableColumn offset="18">
            <TableColumnName offset="18">
                <T_WORD offset="18">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="21">
                <TableColumnTypeName offset="21">
                    <T_WORD offset="21">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="33">
            <TableColumnName offset="33">
                <T_WORD offset="33">user_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="41">
                <TableColumnTypeName offset="41">
                    <T_WORD offset="41">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnRef offset="50">
                <RefType offset="55">
                    <T_GT offset="55">></T_GT>
                </RefType>
                <RefRightColumn offset="57">
                    <TableName offset="57">
                        <T_WORD offset="57">users</T_WORD>
                    </TableName>
                    <RefCompositeTableColumn offset="63">
                        <TableColumnName offset="64">
                            <T_WORD offset="64">id</T_WORD>
                        </TableColumnName>
                        <TableColumnName offset="68">
                            <T_WORD offset="68">country_code</T_WORD>
                        </TableColumnName>
                    </RefCompositeTableColumn>
                </RefRightColumn>
            </TableColumnRef>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_column_one_tomany_relation_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table users {
    id integer [ref: < posts.user_id, ref: < reviews.user_id] // one to many
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">users</T_WORD>
        </TableName>
        <TableColumn offset="18">
            <TableColumnName offset="18">
                <T_WORD offset="18">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="21">
                <TableColumnTypeName offset="21">
                    <T_WORD offset="21">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnRef offset="30">
                <RefType offset="35">
                    <T_LT offset="35"><</T_LT>
                </RefType>
                <RefRightColumn offset="37">
                    <TableName offset="37">
                        <T_WORD offset="37">posts</T_WORD>
                    </TableName>
                    <TableColumnName offset="43">
                        <T_WORD offset="43">user_id</T_WORD>
                    </TableColumnName>
                </RefRightColumn>
            </TableColumnRef>
            <TableColumnRef offset="52">
                <RefType offset="57">
                    <T_LT offset="57"><</T_LT>
                </RefType>
                <RefRightColumn offset="59">
                    <TableName offset="59">
                        <T_WORD offset="59">reviews</T_WORD>
                    </TableName>
                    <TableColumnName offset="67">
                        <T_WORD offset="67">user_id</T_WORD>
                    </TableColumnName>
                </RefRightColumn>
            </TableColumnRef>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_relationship_short_form_without_name_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Ref: merchant_periods.(merchant_id, country_code) > merchants.(id, country_code)
DBML
            , <<<AST
<Schema offset="0">
    <Ref offset="0">
        <RefLeftColumn offset="5">
            <TableName offset="5">
                <T_WORD offset="5">merchant_periods</T_WORD>
            </TableName>
            <RefCompositeTableColumn offset="22">
                <TableColumnName offset="23">
                    <T_WORD offset="23">merchant_id</T_WORD>
                </TableColumnName>
                <TableColumnName offset="36">
                    <T_WORD offset="36">country_code</T_WORD>
                </TableColumnName>
            </RefCompositeTableColumn>
        </RefLeftColumn>
        <RefType offset="50">
            <T_GT offset="50">></T_GT>
        </RefType>
        <RefRightColumn offset="52">
            <TableName offset="52">
                <T_WORD offset="52">merchants</T_WORD>
            </TableName>
            <RefCompositeTableColumn offset="62">
                <TableColumnName offset="63">
                    <T_WORD offset="63">id</T_WORD>
                </TableColumnName>
                <TableColumnName offset="67">
                    <T_WORD offset="67">country_code</T_WORD>
                </TableColumnName>
            </RefCompositeTableColumn>
        </RefRightColumn>
    </Ref>
</Schema>
AST
        );
    }

    function test_relationship_short_form_with_name_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Ref name_optional: table.column < table.column
DBML
            , <<<AST
<Schema offset="0">
    <Ref offset="0">
        <TableRefName offset="4">
            <T_WORD offset="4">name_optional</T_WORD>
        </TableRefName>
        <RefLeftColumn offset="19">
            <TableName offset="19">
                <T_WORD offset="19">table</T_WORD>
            </TableName>
            <TableColumnName offset="25">
                <T_WORD offset="25">column</T_WORD>
            </TableColumnName>
        </RefLeftColumn>
        <RefType offset="32">
            <T_LT offset="32"><</T_LT>
        </RefType>
        <RefRightColumn offset="34">
            <TableName offset="34">
                <T_WORD offset="34">table</T_WORD>
            </TableName>
            <TableColumnName offset="40">
                <T_WORD offset="40">column</T_WORD>
            </TableColumnName>
        </RefRightColumn>
    </Ref>
</Schema>
AST
        );
    }

    function test_relationship_long_form_without_name_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Ref {
    table.column < table.column
    table_second.column < table_second.column
}
DBML
            , <<<AST
<Schema offset="0">
    <Ref offset="0">
        <TableLongRefColumn offset="10">
            <RefLeftColumn offset="10">
                <TableName offset="10">
                    <T_WORD offset="10">table</T_WORD>
                </TableName>
                <TableColumnName offset="16">
                    <T_WORD offset="16">column</T_WORD>
                </TableColumnName>
            </RefLeftColumn>
            <RefType offset="23">
                <T_LT offset="23"><</T_LT>
            </RefType>
            <RefRightColumn offset="25">
                <TableName offset="25">
                    <T_WORD offset="25">table</T_WORD>
                </TableName>
                <TableColumnName offset="31">
                    <T_WORD offset="31">column</T_WORD>
                </TableColumnName>
            </RefRightColumn>
        </TableLongRefColumn>
        <TableLongRefColumn offset="42">
            <RefLeftColumn offset="42">
                <TableName offset="42">
                    <T_WORD offset="42">table_second</T_WORD>
                </TableName>
                <TableColumnName offset="55">
                    <T_WORD offset="55">column</T_WORD>
                </TableColumnName>
            </RefLeftColumn>
            <RefType offset="62">
                <T_LT offset="62"><</T_LT>
            </RefType>
            <RefRightColumn offset="64">
                <TableName offset="64">
                    <T_WORD offset="64">table_second</T_WORD>
                </TableName>
                <TableColumnName offset="77">
                    <T_WORD offset="77">column</T_WORD>
                </TableColumnName>
            </RefRightColumn>
        </TableLongRefColumn>
    </Ref>
</Schema>
AST
        );
    }

    function test_relationship_long_form_with_name_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Ref name_optional {
    table.column < table.column
}
DBML
            , <<<AST
<Schema offset="0">
    <Ref offset="0">
        <TableRefName offset="4">
            <T_WORD offset="4">name_optional</T_WORD>
        </TableRefName>
        <TableLongRefColumn offset="24">
            <RefLeftColumn offset="24">
                <TableName offset="24">
                    <T_WORD offset="24">table</T_WORD>
                </TableName>
                <TableColumnName offset="30">
                    <T_WORD offset="30">column</T_WORD>
                </TableColumnName>
            </RefLeftColumn>
            <RefType offset="37">
                <T_LT offset="37"><</T_LT>
            </RefType>
            <RefRightColumn offset="39">
                <TableName offset="39">
                    <T_WORD offset="39">table</T_WORD>
                </TableName>
                <TableColumnName offset="45">
                    <T_WORD offset="45">column</T_WORD>
                </TableColumnName>
            </RefRightColumn>
        </TableLongRefColumn>
    </Ref>
</Schema>
AST
        );
    }
}
