<?php
declare(strict_types=1);

namespace Butschster\Tests\Parsers;

class TableParserTest extends TestCase
{
    function test_table_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table countries {
    address varchar(255) [unique, not null, note: 'to include unit number']
    id integer [ pk, unique, default: 123, note: 'Number' ]
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">countries</T_WORD>
        </TableName>
        <TableColumn offset="22">
            <TableColumnName offset="22">
                <T_WORD offset="22">address</T_WORD>
            </TableColumnName>
            <TableColumnType offset="30">
                <TableColumnTypeName offset="30">
                    <T_WORD offset="30">varchar</T_WORD>
                </TableColumnTypeName>
                <TableColumnTypeSize offset="37">
                    <Int offset="38">
                        <T_INT offset="38">255</T_INT>
                    </Int>
                </TableColumnTypeSize>
            </TableColumnType>
            <TableColumnSettings offset="43">
                <T_TABLE_SETTING offset="44">unique</T_TABLE_SETTING>
                <T_TABLE_SETTING offset="52">not null</T_TABLE_SETTING>
                <SettingNote offset="62">
                    <String offset="68">
                        <T_QUOTED_STRING offset="68">'to include unit number'</T_QUOTED_STRING>
                    </String>
                </SettingNote>
            </TableColumnSettings>
        </TableColumn>
        <TableColumn offset="98">
            <TableColumnName offset="98">
                <T_WORD offset="98">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="101">
                <TableColumnTypeName offset="101">
                    <T_WORD offset="101">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnSettings offset="109">
                <T_TABLE_SETTING offset="111">pk</T_TABLE_SETTING>
                <T_TABLE_SETTING offset="115">unique</T_TABLE_SETTING>
                <T_TABLE_SETTING offset="123">default</T_TABLE_SETTING>
                <Int offset="132">
                    <T_INT offset="132">123</T_INT>
                </Int>
                <SettingNote offset="137">
                    <String offset="143">
                        <T_QUOTED_STRING offset="143">'Number'</T_QUOTED_STRING>
                    </String>
                </SettingNote>
            </TableColumnSettings>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_table_with_alias_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table countries as C {
  name varchar
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">countries</T_WORD>
        </TableName>
        <TableAlias offset="16">
            <T_WORD offset="19">C</T_WORD>
        </TableAlias>
        <TableColumn offset="25">
            <TableColumnName offset="25">
                <T_WORD offset="25">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="30">
                <TableColumnTypeName offset="30">
                    <T_WORD offset="30">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_table_with_default_string_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table countries {
  name varchar [default: 'h']
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">countries</T_WORD>
        </TableName>
        <TableColumn offset="20">
            <TableColumnName offset="20">
                <T_WORD offset="20">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="25">
                <TableColumnTypeName offset="25">
                    <T_WORD offset="25">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnSettings offset="33">
                <T_TABLE_SETTING offset="34">default</T_TABLE_SETTING>
                <String offset="43">
                    <T_QUOTED_STRING offset="43">'h'</T_QUOTED_STRING>
                </String>
            </TableColumnSettings>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_table_with_default_int_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table countries {
  name varchar [default: 1]
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">countries</T_WORD>
        </TableName>
        <TableColumn offset="20">
            <TableColumnName offset="20">
                <T_WORD offset="20">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="25">
                <TableColumnTypeName offset="25">
                    <T_WORD offset="25">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnSettings offset="33">
                <T_TABLE_SETTING offset="34">default</T_TABLE_SETTING>
                <Int offset="43">
                    <T_INT offset="43">1</T_INT>
                </Int>
            </TableColumnSettings>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_table_with_default_float_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table countries {
  name varchar [default: 123.456]
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">countries</T_WORD>
        </TableName>
        <TableColumn offset="20">
            <TableColumnName offset="20">
                <T_WORD offset="20">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="25">
                <TableColumnTypeName offset="25">
                    <T_WORD offset="25">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnSettings offset="33">
                <T_TABLE_SETTING offset="34">default</T_TABLE_SETTING>
                <Float offset="43">
                    <T_FLOAT offset="43">123.456</T_FLOAT>
                </Float>
            </TableColumnSettings>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_table_with_default_expression_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table countries {
  name varchar [default: `now() - interval '5 days'`]
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">countries</T_WORD>
        </TableName>
        <TableColumn offset="20">
            <TableColumnName offset="20">
                <T_WORD offset="20">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="25">
                <TableColumnTypeName offset="25">
                    <T_WORD offset="25">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnSettings offset="33">
                <T_TABLE_SETTING offset="34">default</T_TABLE_SETTING>
                <Expression offset="43">
                    <T_EXPRESSION offset="43">`now() - interval '5 days'`</T_EXPRESSION>
                </Expression>
            </TableColumnSettings>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_table_with_default_null_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table countries {
  name varchar [default: null]
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">countries</T_WORD>
        </TableName>
        <TableColumn offset="20">
            <TableColumnName offset="20">
                <T_WORD offset="20">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="25">
                <TableColumnTypeName offset="25">
                    <T_WORD offset="25">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnSettings offset="33">
                <T_TABLE_SETTING offset="34">default</T_TABLE_SETTING>
                <Null offset="43">
                    <T_NULL offset="43">null</T_NULL>
                </Null>
            </TableColumnSettings>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_table_with_default_true_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table countries {
  name varchar [default: true]
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">countries</T_WORD>
        </TableName>
        <TableColumn offset="20">
            <TableColumnName offset="20">
                <T_WORD offset="20">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="25">
                <TableColumnTypeName offset="25">
                    <T_WORD offset="25">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnSettings offset="33">
                <T_TABLE_SETTING offset="34">default</T_TABLE_SETTING>
                <Boolean offset="43">
                    <T_BOOL_TRUE offset="43">true</T_BOOL_TRUE>
                </Boolean>
            </TableColumnSettings>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_table_with_default_false_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table countries {
  name varchar [default: false]
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">countries</T_WORD>
        </TableName>
        <TableColumn offset="20">
            <TableColumnName offset="20">
                <T_WORD offset="20">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="25">
                <TableColumnTypeName offset="25">
                    <T_WORD offset="25">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnSettings offset="33">
                <T_TABLE_SETTING offset="34">default</T_TABLE_SETTING>
                <Boolean offset="43">
                    <T_BOOL_FALSE offset="43">false</T_BOOL_FALSE>
                </Boolean>
            </TableColumnSettings>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }
}
