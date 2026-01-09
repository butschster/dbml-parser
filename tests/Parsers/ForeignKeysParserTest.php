<?php

declare(strict_types=1);

namespace Butschster\Tests\Parsers;

class ForeignKeysParserTest extends TestCase
{
    public function test_column_many_to_one_relation_should_be_parsed(): void
    {
        $this->assertAst(
            <<<DBML
Table posts {
    id integer
    user_id integer [ref: > users.id] // many-to-one
}
DBML,
            <<<AST
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
                <T_GT offset="55">></T_GT>
                <RefRightTable offset="57">
                    <TableName offset="57">
                        <T_WORD offset="57">users</T_WORD>
                    </TableName>
                    <TableColumnName offset="63">
                        <T_WORD offset="63">id</T_WORD>
                    </TableColumnName>
                </RefRightTable>
            </TableColumnRef>
        </TableColumn>
    </Table>
</Schema>
AST,
        );
    }

    public function test_column_relation_with_composite_key_should_be_parsed(): void
    {
        $this->assertAst(
            <<<DBML
Table posts {
    id integer
    user_id integer [ref: > users.(id, country_code)] // many-to-one
}
DBML,
            <<<AST
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
                <T_GT offset="55">></T_GT>
                <RefRightTable offset="57">
                    <TableName offset="57">
                        <T_WORD offset="57">users</T_WORD>
                    </TableName>
                    <TableColumnName offset="64">
                        <T_WORD offset="64">id</T_WORD>
                    </TableColumnName>
                    <TableColumnName offset="68">
                        <T_WORD offset="68">country_code</T_WORD>
                    </TableColumnName>
                </RefRightTable>
            </TableColumnRef>
        </TableColumn>
    </Table>
</Schema>
AST,
        );
    }

    public function test_column_one_tomany_relation_should_be_parsed(): void
    {
        $this->assertAst(
            <<<DBML
Table users {
    id integer [ref: < posts.user_id, ref: < reviews.user_id] // one to many
}
DBML,
            <<<AST
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
                <T_LT offset="35"><</T_LT>
                <RefRightTable offset="37">
                    <TableName offset="37">
                        <T_WORD offset="37">posts</T_WORD>
                    </TableName>
                    <TableColumnName offset="43">
                        <T_WORD offset="43">user_id</T_WORD>
                    </TableColumnName>
                </RefRightTable>
            </TableColumnRef>
            <TableColumnRef offset="52">
                <T_LT offset="57"><</T_LT>
                <RefRightTable offset="59">
                    <TableName offset="59">
                        <T_WORD offset="59">reviews</T_WORD>
                    </TableName>
                    <TableColumnName offset="67">
                        <T_WORD offset="67">user_id</T_WORD>
                    </TableColumnName>
                </RefRightTable>
            </TableColumnRef>
        </TableColumn>
    </Table>
</Schema>
AST,
        );
    }

    public function test_relationship_short_form_without_name_should_be_parsed(): void
    {
        $this->assertAst(
            <<<DBML
Ref: merchant_periods.(merchant_id, country_code) > merchants.(id, country_code)
DBML,
            <<<AST
<Schema offset="0">
    <Ref offset="0">
        <RefLeftTable offset="5">
            <TableName offset="5">
                <T_WORD offset="5">merchant_periods</T_WORD>
            </TableName>
            <TableColumnName offset="23">
                <T_WORD offset="23">merchant_id</T_WORD>
            </TableColumnName>
            <TableColumnName offset="36">
                <T_WORD offset="36">country_code</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="50">></T_GT>
        <RefRightTable offset="52">
            <TableName offset="52">
                <T_WORD offset="52">merchants</T_WORD>
            </TableName>
            <TableColumnName offset="63">
                <T_WORD offset="63">id</T_WORD>
            </TableColumnName>
            <TableColumnName offset="67">
                <T_WORD offset="67">country_code</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
</Schema>
AST,
        );
    }

    public function test_relationship_short_form_with_name_should_be_parsed(): void
    {
        $this->assertAst(
            <<<DBML
Ref name_optional: tabla.column < tabla.column
DBML,
            <<<AST
<Schema offset="0">
    <Ref offset="0">
        <RefName offset="4">
            <T_WORD offset="4">name_optional</T_WORD>
        </RefName>
        <RefLeftTable offset="19">
            <TableName offset="19">
                <T_WORD offset="19">tabla</T_WORD>
            </TableName>
            <TableColumnName offset="25">
                <T_WORD offset="25">column</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_LT offset="32"><</T_LT>
        <RefRightTable offset="34">
            <TableName offset="34">
                <T_WORD offset="34">tabla</T_WORD>
            </TableName>
            <TableColumnName offset="40">
                <T_WORD offset="40">column</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
</Schema>
AST,
        );
    }

    public function test_relationship_long_form_without_name_should_be_parsed(): void
    {
        $this->assertAst(
            <<<DBML
Ref {
    tabla.column < tabla.column
    table_second.column < table_second.column
}
DBML,
            <<<AST
<Schema offset="0">
    <Ref offset="0">
        <RefLeftTable offset="10">
            <TableName offset="10">
                <T_WORD offset="10">tabla</T_WORD>
            </TableName>
            <TableColumnName offset="16">
                <T_WORD offset="16">column</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_LT offset="23"><</T_LT>
        <RefRightTable offset="25">
            <TableName offset="25">
                <T_WORD offset="25">tabla</T_WORD>
            </TableName>
            <TableColumnName offset="31">
                <T_WORD offset="31">column</T_WORD>
            </TableColumnName>
        </RefRightTable>
        <RefLeftTable offset="42">
            <TableName offset="42">
                <T_WORD offset="42">table_second</T_WORD>
            </TableName>
            <TableColumnName offset="55">
                <T_WORD offset="55">column</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_LT offset="62"><</T_LT>
        <RefRightTable offset="64">
            <TableName offset="64">
                <T_WORD offset="64">table_second</T_WORD>
            </TableName>
            <TableColumnName offset="77">
                <T_WORD offset="77">column</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
</Schema>
AST,
        );
    }

    public function test_relationship_long_form_with_name_should_be_parsed(): void
    {
        $this->assertAst(
            <<<DBML
Ref name_optional {
    tabla.column < tabla.column
}
DBML,
            <<<AST
<Schema offset="0">
    <Ref offset="0">
        <RefName offset="4">
            <T_WORD offset="4">name_optional</T_WORD>
        </RefName>
        <RefLeftTable offset="24">
            <TableName offset="24">
                <T_WORD offset="24">tabla</T_WORD>
            </TableName>
            <TableColumnName offset="30">
                <T_WORD offset="30">column</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_LT offset="37"><</T_LT>
        <RefRightTable offset="39">
            <TableName offset="39">
                <T_WORD offset="39">tabla</T_WORD>
            </TableName>
            <TableColumnName offset="45">
                <T_WORD offset="45">column</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
</Schema>
AST,
        );
    }

    public function test_relationship_with_settings(): void
    {
        $this->assertAst(
            <<<DBML
Ref: products.merchant_id > merchants.id [delete: cascade, update: no action, destroy: cascade]
DBML,
            <<<AST
<Schema offset="0">
    <Ref offset="0">
        <RefLeftTable offset="5">
            <TableName offset="5">
                <T_WORD offset="5">products</T_WORD>
            </TableName>
            <TableColumnName offset="14">
                <T_WORD offset="14">merchant_id</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="26">></T_GT>
        <RefRightTable offset="28">
            <TableName offset="28">
                <T_WORD offset="28">merchants</T_WORD>
            </TableName>
            <TableColumnName offset="38">
                <T_WORD offset="38">id</T_WORD>
            </TableColumnName>
        </RefRightTable>
        <T_REF_ACTION_DELETE offset="42">delete</T_REF_ACTION_DELETE>
        <T_REF_ACTION_CASCADE offset="50">cascade</T_REF_ACTION_CASCADE>
        <T_REF_ACTION_UPDATE offset="59">update</T_REF_ACTION_UPDATE>
        <T_REF_ACTION_NO_ACTION offset="67">no action</T_REF_ACTION_NO_ACTION>
        <T_REF_ACTION_DESTROY offset="78">destroy</T_REF_ACTION_DESTROY>
        <T_REF_ACTION_CASCADE offset="87">cascade</T_REF_ACTION_CASCADE>
    </Ref>
</Schema>
AST,
        );
    }
}
