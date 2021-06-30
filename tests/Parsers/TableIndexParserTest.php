<?php
declare(strict_types=1);

namespace Butschster\Tests\Parsers;

class TableIndexParserTest extends TestCase
{
    function test_simple_index_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table bookings {
    id integer

    indexes {
      id
  }
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">bookings</T_WORD>
        </TableName>
        <TableColumn offset="21">
            <TableColumnName offset="21">
                <T_WORD offset="21">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="24">
                <TableColumnTypeName offset="24">
                    <T_WORD offset="24">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableIndex offset="53">
            <TableIndexSingleField offset="53">
                <String offset="53">
                    <T_WORD offset="53">id</T_WORD>
                </String>
            </TableIndexSingleField>
        </TableIndex>
    </Table>
</Schema>
AST
        );
    }

    function test_index_with_settings_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table bookings {
    id integer

    indexes {
      id [name: 'created_at_index', note: 'Date', type: hash, pk]
    }
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">bookings</T_WORD>
        </TableName>
        <TableColumn offset="21">
            <TableColumnName offset="21">
                <T_WORD offset="21">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="24">
                <TableColumnTypeName offset="24">
                    <T_WORD offset="24">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableIndex offset="53">
            <TableIndexSingleField offset="53">
                <String offset="53">
                    <T_WORD offset="53">id</T_WORD>
                </String>
            </TableIndexSingleField>
            <TableIndexSettings offset="56">
                <TableIndexSettingWithValue offset="57">
                    <T_WORD offset="57">name</T_WORD>
                    <String offset="63">
                        <T_QUOTED_STRING offset="63">'created_at_index'</T_QUOTED_STRING>
                    </String>
                </TableIndexSettingWithValue>
                <SettingNote offset="83">
                    <String offset="89">
                        <T_QUOTED_STRING offset="89">'Date'</T_QUOTED_STRING>
                    </String>
                </SettingNote>
                <TableIndexSettingWithValue offset="97">
                    <T_WORD offset="97">type</T_WORD>
                    <String offset="103">
                        <T_WORD offset="103">hash</T_WORD>
                    </String>
                </TableIndexSettingWithValue>
                <TableIndexSetting offset="109">
                    <T_TABLE_SETTING_PK offset="109">pk</T_TABLE_SETTING_PK>
                </TableIndexSetting>
            </TableIndexSettings>
        </TableIndex>
    </Table>
</Schema>
AST
        );
    }

    function test_composite_index_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table bookings {
    id integer

    indexes {
      (country, booking_date) [pk]
  }
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">bookings</T_WORD>
        </TableName>
        <TableColumn offset="21">
            <TableColumnName offset="21">
                <T_WORD offset="21">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="24">
                <TableColumnTypeName offset="24">
                    <T_WORD offset="24">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableIndex offset="53">
            <TableIndexCompositeField offset="53">
                <String offset="54">
                    <T_WORD offset="54">country</T_WORD>
                </String>
                <String offset="63">
                    <T_WORD offset="63">booking_date</T_WORD>
                </String>
            </TableIndexCompositeField>
            <TableIndexSettings offset="77">
                <TableIndexSetting offset="78">
                    <T_TABLE_SETTING_PK offset="78">pk</T_TABLE_SETTING_PK>
                </TableIndexSetting>
            </TableIndexSettings>
        </TableIndex>
    </Table>
</Schema>
AST
        );
    }

    function test_composite_index_with_expression_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table bookings {
    id integer

    indexes {
      (`id*2`,`getdate()`)
  }
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">bookings</T_WORD>
        </TableName>
        <TableColumn offset="21">
            <TableColumnName offset="21">
                <T_WORD offset="21">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="24">
                <TableColumnTypeName offset="24">
                    <T_WORD offset="24">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableIndex offset="53">
            <TableIndexCompositeField offset="53">
                <Expression offset="54">
                    <T_EXPRESSION offset="54">`id*2`</T_EXPRESSION>
                </Expression>
                <Expression offset="61">
                    <T_EXPRESSION offset="61">`getdate()`</T_EXPRESSION>
                </Expression>
            </TableIndexCompositeField>
        </TableIndex>
    </Table>
</Schema>
AST
        );
    }

    function test_full_example_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Table bookings {
  id integer

  indexes {
      (id, country) [pk] // composite primary key
      created_at [name: 'created_at_index', note: 'Date']
      booking_date
      (country, booking_date) [unique]
      booking_date [type: hash]
      (`id*2`)
      (`id*3`,`getdate()`)
      (`id*3`,id)
  }
}
DBML
            , <<<AST
<Schema offset="0">
    <Table offset="0">
        <TableName offset="6">
            <T_WORD offset="6">bookings</T_WORD>
        </TableName>
        <TableColumn offset="19">
            <TableColumnName offset="19">
                <T_WORD offset="19">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="22">
                <TableColumnTypeName offset="22">
                    <T_WORD offset="22">integer</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableIndex offset="49">
            <TableIndexCompositeField offset="49">
                <String offset="50">
                    <T_WORD offset="50">id</T_WORD>
                </String>
                <String offset="54">
                    <T_WORD offset="54">country</T_WORD>
                </String>
            </TableIndexCompositeField>
            <TableIndexSettings offset="63">
                <TableIndexSetting offset="64">
                    <T_TABLE_SETTING_PK offset="64">pk</T_TABLE_SETTING_PK>
                </TableIndexSetting>
            </TableIndexSettings>
        </TableIndex>
        <TableIndex offset="99">
            <TableIndexSingleField offset="99">
                <String offset="99">
                    <T_WORD offset="99">created_at</T_WORD>
                </String>
            </TableIndexSingleField>
            <TableIndexSettings offset="110">
                <TableIndexSettingWithValue offset="111">
                    <T_WORD offset="111">name</T_WORD>
                    <String offset="117">
                        <T_QUOTED_STRING offset="117">'created_at_index'</T_QUOTED_STRING>
                    </String>
                </TableIndexSettingWithValue>
                <SettingNote offset="137">
                    <String offset="143">
                        <T_QUOTED_STRING offset="143">'Date'</T_QUOTED_STRING>
                    </String>
                </SettingNote>
            </TableIndexSettings>
        </TableIndex>
        <TableIndex offset="157">
            <TableIndexSingleField offset="157">
                <String offset="157">
                    <T_WORD offset="157">booking_date</T_WORD>
                </String>
            </TableIndexSingleField>
        </TableIndex>
        <TableIndex offset="176">
            <TableIndexCompositeField offset="176">
                <String offset="177">
                    <T_WORD offset="177">country</T_WORD>
                </String>
                <String offset="186">
                    <T_WORD offset="186">booking_date</T_WORD>
                </String>
            </TableIndexCompositeField>
            <TableIndexSettings offset="200">
                <TableIndexSetting offset="201">
                    <T_TABLE_SETTING_UNIQUE offset="201">unique</T_TABLE_SETTING_UNIQUE>
                </TableIndexSetting>
            </TableIndexSettings>
        </TableIndex>
        <TableIndex offset="215">
            <TableIndexSingleField offset="215">
                <String offset="215">
                    <T_WORD offset="215">booking_date</T_WORD>
                </String>
            </TableIndexSingleField>
            <TableIndexSettings offset="228">
                <TableIndexSettingWithValue offset="229">
                    <T_WORD offset="229">type</T_WORD>
                    <String offset="235">
                        <T_WORD offset="235">hash</T_WORD>
                    </String>
                </TableIndexSettingWithValue>
            </TableIndexSettings>
        </TableIndex>
        <TableIndex offset="247">
            <TableIndexCompositeField offset="247">
                <Expression offset="248">
                    <T_EXPRESSION offset="248">`id*2`</T_EXPRESSION>
                </Expression>
            </TableIndexCompositeField>
        </TableIndex>
        <TableIndex offset="262">
            <TableIndexCompositeField offset="262">
                <Expression offset="263">
                    <T_EXPRESSION offset="263">`id*3`</T_EXPRESSION>
                </Expression>
                <Expression offset="270">
                    <T_EXPRESSION offset="270">`getdate()`</T_EXPRESSION>
                </Expression>
            </TableIndexCompositeField>
        </TableIndex>
        <TableIndex offset="289">
            <TableIndexCompositeField offset="289">
                <Expression offset="290">
                    <T_EXPRESSION offset="290">`id*3`</T_EXPRESSION>
                </Expression>
                <String offset="297">
                    <T_WORD offset="297">id</T_WORD>
                </String>
            </TableIndexCompositeField>
        </TableIndex>
    </Table>
</Schema>
AST
        );
    }
}
