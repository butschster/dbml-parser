<?php
declare(strict_types=1);

namespace Butschster\Tests\Parsers;

class FullSchemaParserTest extends TestCase
{
    function test_parse_schema()
    {
        $this->assertAst(file_get_contents(__DIR__.'/../schema.dbml')
            , <<<AST
<Schema offset="0">
    <Project offset="0">
        <ProjectName offset="8">
            <String offset="8">
                <T_WORD offset="8">test</T_WORD>
            </String>
        </ProjectName>
        <ProjectSetting offset="17">
            <ProjectSettingKey offset="17">
                <T_WORD offset="17">database_type</T_WORD>
            </ProjectSettingKey>
            <String offset="32">
                <T_QUOTED_STRING offset="32">'PostgreSQL'</T_QUOTED_STRING>
            </String>
        </ProjectSetting>
        <Note offset="47">
            <String offset="53">
                <T_QUOTED_STRING offset="53">'Description of the project'</T_QUOTED_STRING>
            </String>
        </Note>
    </Project>
    <Table offset="151">
        <TableName offset="157">
            <T_WORD offset="157">users</T_WORD>
        </TableName>
        <TableAlias offset="163">
            <T_WORD offset="166">U</T_WORD>
        </TableAlias>
        <TableColumn offset="172">
            <TableColumnName offset="172">
                <T_WORD offset="172">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="175">
                <TableColumnTypeName offset="175">
                    <T_WORD offset="175">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="180">pk</T_TABLE_SETTING_PK>
            <T_TABLE_SETTING_UNIQUE offset="184">unique</T_TABLE_SETTING_UNIQUE>
            <T_TABLE_SETTING_INCREMENT offset="192">increment</T_TABLE_SETTING_INCREMENT>
        </TableColumn>
        <TableColumn offset="223">
            <TableColumnName offset="223">
                <T_WORD offset="223">full_name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="233">
                <TableColumnTypeName offset="233">
                    <T_WORD offset="233">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_NOT_NULL offset="242">not null</T_TABLE_SETTING_NOT_NULL>
            <T_TABLE_SETTING_UNIQUE offset="252">unique</T_TABLE_SETTING_UNIQUE>
            <T_TABLE_SETTING_DEFAULT offset="260">default</T_TABLE_SETTING_DEFAULT>
            <Int offset="269">
                <T_INT offset="269">1</T_INT>
            </Int>
        </TableColumn>
        <TableColumn offset="274">
            <TableColumnName offset="274">
                <T_WORD offset="274">created_at</T_WORD>
            </TableColumnName>
            <TableColumnType offset="285">
                <TableColumnTypeName offset="285">
                    <T_WORD offset="285">timestamp</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="297">
            <TableColumnName offset="297">
                <T_WORD offset="297">country_code</T_WORD>
            </TableColumnName>
            <TableColumnType offset="310">
                <TableColumnTypeName offset="310">
                    <T_WORD offset="310">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="316">
            <TableColumnName offset="316">
                <T_WORD offset="316">type</T_WORD>
            </TableColumnName>
            <TableColumnType offset="321">
                <TableColumnTypeName offset="321">
                    <T_WORD offset="321">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="327">
            <TableColumnName offset="327">
                <T_WORD offset="327">note</T_WORD>
            </TableColumnName>
            <TableColumnType offset="332">
                <TableColumnTypeName offset="332">
                    <T_WORD offset="332">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <Note offset="338">
            <String offset="344">
                <T_QUOTED_STRING offset="344">'khong hieu duoc'</T_QUOTED_STRING>
            </String>
        </Note>
    </Table>
    <Table offset="365">
        <TableName offset="371">
            <T_WORD offset="371">merchants</T_WORD>
        </TableName>
        <TableColumn offset="385">
            <TableColumnName offset="385">
                <T_WORD offset="385">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="388">
                <TableColumnTypeName offset="388">
                    <T_WORD offset="388">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
    </Table>
    <Table offset="395">
        <TableName offset="401">
            <T_WORD offset="401">countries</T_WORD>
        </TableName>
        <TableColumn offset="415">
            <TableColumnName offset="415">
                <T_WORD offset="415">code</T_WORD>
            </TableColumnName>
            <TableColumnType offset="420">
                <TableColumnTypeName offset="420">
                    <T_WORD offset="420">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="425">pk</T_TABLE_SETTING_PK>
        </TableColumn>
        <TableColumn offset="431">
            <TableColumnName offset="431">
                <T_WORD offset="431">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="436">
                <TableColumnTypeName offset="436">
                    <T_WORD offset="436">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="446">
            <TableColumnName offset="446">
                <T_WORD offset="446">continent_name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="461">
                <TableColumnTypeName offset="461">
                    <T_WORD offset="461">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
    </Table>
    <Ref offset="588">
        <RefLeftTable offset="595">
            <TableName offset="595">
                <T_WORD offset="595">U</T_WORD>
            </TableName>
            <TableColumnName offset="597">
                <T_WORD offset="597">country_code</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="610">></T_GT>
        <RefRightTable offset="612">
            <TableName offset="612">
                <T_WORD offset="612">countries</T_WORD>
            </TableName>
            <TableColumnName offset="622">
                <T_WORD offset="622">code</T_WORD>
            </TableColumnName>
        </RefRightTable>
        <RefLeftTable offset="629">
            <TableName offset="629">
                <T_WORD offset="629">merchants</T_WORD>
            </TableName>
            <TableColumnName offset="639">
                <T_WORD offset="639">country_code</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="652">></T_GT>
        <RefRightTable offset="654">
            <TableName offset="654">
                <T_WORD offset="654">countries</T_WORD>
            </TableName>
            <TableColumnName offset="664">
                <T_WORD offset="664">code</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
    <Table offset="772">
        <TableName offset="778">
            <T_WORD offset="778">order_items</T_WORD>
        </TableName>
        <TableColumn offset="794">
            <TableColumnName offset="794">
                <T_WORD offset="794">order_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="803">
                <TableColumnTypeName offset="803">
                    <T_WORD offset="803">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnRef offset="808">
                <T_GT offset="813">></T_GT>
                <RefRightTable offset="815">
                    <TableName offset="815">
                        <T_WORD offset="815">orders</T_WORD>
                    </TableName>
                    <TableColumnName offset="822">
                        <T_WORD offset="822">id</T_WORD>
                    </TableColumnName>
                </RefRightTable>
            </TableColumnRef>
        </TableColumn>
        <TableColumn offset="828">
            <TableColumnName offset="828">
                <T_WORD offset="828">product_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="839">
                <TableColumnTypeName offset="839">
                    <T_WORD offset="839">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="845">
            <TableColumnName offset="845">
                <T_WORD offset="845">quantity</T_WORD>
            </TableColumnName>
            <TableColumnType offset="854">
                <TableColumnTypeName offset="854">
                    <T_WORD offset="854">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_DEFAULT offset="859">default</T_TABLE_SETTING_DEFAULT>
            <Int offset="868">
                <T_INT offset="868">1</T_INT>
            </Int>
        </TableColumn>
    </Table>
    <Ref offset="891">
        <RefLeftTable offset="896">
            <TableName offset="896">
                <T_WORD offset="896">order_items</T_WORD>
            </TableName>
            <TableColumnName offset="908">
                <T_WORD offset="908">product_id</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="919">></T_GT>
        <RefRightTable offset="921">
            <TableName offset="921">
                <T_WORD offset="921">products</T_WORD>
            </TableName>
            <TableColumnName offset="930">
                <T_WORD offset="930">id</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
    <Table offset="934">
        <TableName offset="940">
            <T_WORD offset="940">orders</T_WORD>
        </TableName>
        <TableColumn offset="951">
            <TableColumnName offset="951">
                <T_WORD offset="951">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="954">
                <TableColumnTypeName offset="954">
                    <T_WORD offset="954">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="959">pk</T_TABLE_SETTING_PK>
        </TableColumn>
        <TableColumn offset="980">
            <TableColumnName offset="980">
                <T_WORD offset="980">user_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="988">
                <TableColumnTypeName offset="988">
                    <T_WORD offset="988">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_NOT_NULL offset="993">not null</T_TABLE_SETTING_NOT_NULL>
            <T_TABLE_SETTING_UNIQUE offset="1003">unique</T_TABLE_SETTING_UNIQUE>
        </TableColumn>
        <TableColumn offset="1013">
            <TableColumnName offset="1013">
                <T_WORD offset="1013">status</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1020">
                <TableColumnTypeName offset="1020">
                    <T_WORD offset="1020">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1030">
            <TableColumnName offset="1030">
                <T_WORD offset="1030">created_at</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1041">
                <TableColumnTypeName offset="1041">
                    <T_WORD offset="1041">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <SettingNote offset="1050">
                <String offset="1056">
                    <T_QUOTED_STRING offset="1056">'''When order created'''</T_QUOTED_STRING>
                </String>
            </SettingNote>
        </TableColumn>
    </Table>
    <Table offset="1104">
        <TableName offset="1110">
            <T_WORD offset="1110">int</T_WORD>
        </TableName>
        <TableColumn offset="1118">
            <TableColumnName offset="1118">
                <T_WORD offset="1118">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1121">
                <TableColumnTypeName offset="1121">
                    <T_WORD offset="1121">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
    </Table>
    <Enum offset="1254">
        <EnumName offset="1259">
            <T_WORD offset="1259">products_status</T_WORD>
        </EnumName>
        <EnumValue offset="1279">
            <T_WORD offset="1279">out_of_stock</T_WORD>
        </EnumValue>
        <EnumValue offset="1294">
            <T_WORD offset="1294">in_stock</T_WORD>
        </EnumValue>
        <EnumValue offset="1305">
            <T_WORD offset="1305">running_low</T_WORD>
            <SettingNote offset="1318">
                <String offset="1324">
                    <T_QUOTED_STRING offset="1324">'less than 20'</T_QUOTED_STRING>
                </String>
            </SettingNote>
        </EnumValue>
    </Enum>
    <Table offset="1420">
        <TableName offset="1426">
            <T_WORD offset="1426">products</T_WORD>
        </TableName>
        <TableColumn offset="1439">
            <TableColumnName offset="1439">
                <T_WORD offset="1439">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1442">
                <TableColumnTypeName offset="1442">
                    <T_WORD offset="1442">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="1447">pk</T_TABLE_SETTING_PK>
        </TableColumn>
        <TableColumn offset="1453">
            <TableColumnName offset="1453">
                <T_WORD offset="1453">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1458">
                <TableColumnTypeName offset="1458">
                    <T_WORD offset="1458">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1468">
            <TableColumnName offset="1468">
                <T_WORD offset="1468">merchant_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1480">
                <TableColumnTypeName offset="1480">
                    <T_WORD offset="1480">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_NOT_NULL offset="1485">not null</T_TABLE_SETTING_NOT_NULL>
        </TableColumn>
        <TableColumn offset="1497">
            <TableColumnName offset="1497">
                <T_WORD offset="1497">price</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1503">
                <TableColumnTypeName offset="1503">
                    <T_WORD offset="1503">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1509">
            <TableColumnName offset="1509">
                <T_WORD offset="1509">status</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1516">
                <TableColumnTypeName offset="1516">
                    <T_WORD offset="1516">products_status</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1534">
            <TableColumnName offset="1534">
                <T_WORD offset="1534">created_at</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1545">
                <TableColumnTypeName offset="1545">
                    <T_WORD offset="1545">datetime</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_DEFAULT offset="1555">default</T_TABLE_SETTING_DEFAULT>
            <Expression offset="1564">
                <T_EXPRESSION offset="1564">`now()`</T_EXPRESSION>
            </Expression>
        </TableColumn>
        <TableIndex offset="1590">
            <TableIndexCompositeField offset="1590">
                <String offset="1591">
                    <T_WORD offset="1591">merchant_id</T_WORD>
                </String>
                <String offset="1604">
                    <T_WORD offset="1604">status</T_WORD>
                </String>
            </TableIndexCompositeField>
            <TableIndexSettings offset="1612">
                <TableIndexSettingWithValue offset="1613">
                    <T_WORD offset="1613">name</T_WORD>
                    <String offset="1618">
                        <T_QUOTED_STRING offset="1618">'product_status'</T_QUOTED_STRING>
                    </String>
                </TableIndexSettingWithValue>
                <TableIndexSettingWithValue offset="1636">
                    <T_WORD offset="1636">type</T_WORD>
                    <String offset="1642">
                        <T_WORD offset="1642">hash</T_WORD>
                    </String>
                </TableIndexSettingWithValue>
            </TableIndexSettings>
        </TableIndex>
        <TableIndex offset="1652">
            <TableIndexSingleField offset="1652">
                <String offset="1652">
                    <T_WORD offset="1652">id</T_WORD>
                </String>
            </TableIndexSingleField>
            <TableIndexSettings offset="1655">
                <TableIndexSetting offset="1656">
                    <T_TABLE_SETTING_UNIQUE offset="1656">unique</T_TABLE_SETTING_UNIQUE>
                </TableIndexSetting>
            </TableIndexSettings>
        </TableIndex>
    </Table>
    <Ref offset="1671">
        <RefLeftTable offset="1676">
            <TableName offset="1676">
                <T_WORD offset="1676">products</T_WORD>
            </TableName>
            <TableColumnName offset="1685">
                <T_WORD offset="1685">merchant_id</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="1697">></T_GT>
        <RefRightTable offset="1699">
            <TableName offset="1699">
                <T_WORD offset="1699">merchants</T_WORD>
            </TableName>
            <TableColumnName offset="1709">
                <T_WORD offset="1709">id</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
    <TableGroup offset="1728">
        <TableGroupName offset="1739">
            <T_WORD offset="1739">hello_world</T_WORD>
        </TableGroupName>
        <TableName offset="1757">
            <T_WORD offset="1757">just_test</T_WORD>
        </TableName>
        <TableName offset="1771">
            <T_WORD offset="1771">just_a_test</T_WORD>
        </TableName>
    </TableGroup>
</Schema>
AST
        );
    }
}
