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
                    <T_TABLE_COLUMN_SIZE offset="37">(255)</T_TABLE_COLUMN_SIZE>
                </TableColumnTypeSize>
            </TableColumnType>
            <T_TABLE_SETTING_UNIQUE offset="44">unique</T_TABLE_SETTING_UNIQUE>
            <T_TABLE_SETTING_NOT_NULL offset="52">not null</T_TABLE_SETTING_NOT_NULL>
            <SettingNote offset="62">
                <String offset="68">
                    <T_QUOTED_STRING offset="68">'to include unit number'</T_QUOTED_STRING>
                </String>
            </SettingNote>
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
            <T_TABLE_SETTING_PK offset="111">pk</T_TABLE_SETTING_PK>
            <T_TABLE_SETTING_UNIQUE offset="115">unique</T_TABLE_SETTING_UNIQUE>
            <T_TABLE_SETTING_DEFAULT offset="123">default</T_TABLE_SETTING_DEFAULT>
            <String offset="132">
                <T_WORD offset="132">123</T_WORD>
            </String>
            <SettingNote offset="137">
                <String offset="143">
                    <T_QUOTED_STRING offset="143">'Number'</T_QUOTED_STRING>
                </String>
            </SettingNote>
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
            <T_TABLE_SETTING_DEFAULT offset="34">default</T_TABLE_SETTING_DEFAULT>
            <String offset="43">
                <T_QUOTED_STRING offset="43">'h'</T_QUOTED_STRING>
            </String>
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
            <T_TABLE_SETTING_DEFAULT offset="34">default</T_TABLE_SETTING_DEFAULT>
            <String offset="43">
                <T_WORD offset="43">1</T_WORD>
            </String>
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
            <T_TABLE_SETTING_DEFAULT offset="34">default</T_TABLE_SETTING_DEFAULT>
            <Float offset="43">
                <T_FLOAT offset="43">123.456</T_FLOAT>
            </Float>
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
            <T_TABLE_SETTING_DEFAULT offset="34">default</T_TABLE_SETTING_DEFAULT>
            <Expression offset="43">
                <T_EXPRESSION offset="43">`now() - interval '5 days'`</T_EXPRESSION>
            </Expression>
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
            <T_TABLE_SETTING_DEFAULT offset="34">default</T_TABLE_SETTING_DEFAULT>
            <Null offset="43">
                <T_NULL offset="43">null</T_NULL>
            </Null>
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
            <T_TABLE_SETTING_DEFAULT offset="34">default</T_TABLE_SETTING_DEFAULT>
            <Boolean offset="43">
                <T_BOOL_TRUE offset="43">true</T_BOOL_TRUE>
            </Boolean>
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
            <T_TABLE_SETTING_DEFAULT offset="34">default</T_TABLE_SETTING_DEFAULT>
            <Boolean offset="43">
                <T_BOOL_FALSE offset="43">false</T_BOOL_FALSE>
            </Boolean>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_table_name_can_be_int_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table 1 {
  id int
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">1</T_WORD>
        </TableName>
        <TableColumn offset="12">
            <TableColumnName offset="12">
                <T_WORD offset="12">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="15">
                <TableColumnTypeName offset="15">
                    <T_WORD offset="15">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_column_name_with_int()
    {
        $this->assertAst(<<<DBML
Table 1 {
  2fa_enabled tinyint(1) [not null, default: 0]
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">1</T_WORD>
        </TableName>
        <TableColumn offset="12">
            <TableColumnName offset="12">
                <T_WORD offset="12">2fa_enabled</T_WORD>
            </TableColumnName>
            <TableColumnType offset="24">
                <TableColumnTypeName offset="24">
                    <T_WORD offset="24">tinyint</T_WORD>
                </TableColumnTypeName>
                <TableColumnTypeSize offset="31">
                    <T_TABLE_COLUMN_SIZE offset="31">(1)</T_TABLE_COLUMN_SIZE>
                </TableColumnTypeSize>
            </TableColumnType>
            <T_TABLE_SETTING_NOT_NULL offset="36">not null</T_TABLE_SETTING_NOT_NULL>
            <T_TABLE_SETTING_DEFAULT offset="46">default</T_TABLE_SETTING_DEFAULT>
            <String offset="55">
                <T_WORD offset="55">0</T_WORD>
            </String>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }

    function test_column_name_with_decimal()
    {
        $this->assertAst(<<<DBML
Table account {
  balance decimal(8,2) [default: 0.00]
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">account</T_WORD>
        </TableName>
        <TableColumn offset="18">
            <TableColumnName offset="18">
                <T_WORD offset="18">balance</T_WORD>
            </TableColumnName>
            <TableColumnType offset="26">
                <TableColumnTypeName offset="26">
                    <T_WORD offset="26">decimal</T_WORD>
                </TableColumnTypeName>
                <TableColumnTypeSize offset="33">
                    <T_TABLE_COLUMN_SIZE offset="33">(8,2)</T_TABLE_COLUMN_SIZE>
                </TableColumnTypeSize>
            </TableColumnType>
            <T_TABLE_SETTING_DEFAULT offset="40">default</T_TABLE_SETTING_DEFAULT>
            <Float offset="49">
                <T_FLOAT offset="49">0.00</T_FLOAT>
            </Float>
        </TableColumn>
    </Table>
</Schema>
AST
        );
    }
}
