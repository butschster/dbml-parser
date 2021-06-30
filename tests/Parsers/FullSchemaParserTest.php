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
    <Ref offset="587">
        <TableLongRefColumn offset="594">
            <RefLeftColumn offset="594">
                <TableName offset="594">
                    <T_WORD offset="594">U</T_WORD>
                </TableName>
                <TableColumnName offset="596">
                    <T_WORD offset="596">country_code</T_WORD>
                </TableColumnName>
            </RefLeftColumn>
            <RefType offset="609">
                <T_GT offset="609">></T_GT>
            </RefType>
            <RefRightColumn offset="611">
                <TableName offset="611">
                    <T_WORD offset="611">countries</T_WORD>
                </TableName>
                <TableColumnName offset="621">
                    <T_WORD offset="621">code</T_WORD>
                </TableColumnName>
            </RefRightColumn>
        </TableLongRefColumn>
        <TableLongRefColumn offset="628">
            <RefLeftColumn offset="628">
                <TableName offset="628">
                    <T_WORD offset="628">merchants</T_WORD>
                </TableName>
                <TableColumnName offset="638">
                    <T_WORD offset="638">country_code</T_WORD>
                </TableColumnName>
            </RefLeftColumn>
            <RefType offset="651">
                <T_GT offset="651">></T_GT>
            </RefType>
            <RefRightColumn offset="653">
                <TableName offset="653">
                    <T_WORD offset="653">countries</T_WORD>
                </TableName>
                <TableColumnName offset="663">
                    <T_WORD offset="663">code</T_WORD>
                </TableColumnName>
            </RefRightColumn>
        </TableLongRefColumn>
    </Ref>
    <Table offset="771">
        <TableName offset="777">
            <T_WORD offset="777">order_items</T_WORD>
        </TableName>
        <TableColumn offset="793">
            <TableColumnName offset="793">
                <T_WORD offset="793">order_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="802">
                <TableColumnTypeName offset="802">
                    <T_WORD offset="802">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnRef offset="807">
                <RefType offset="812">
                    <T_GT offset="812">></T_GT>
                </RefType>
                <RefRightColumn offset="814">
                    <TableName offset="814">
                        <T_WORD offset="814">orders</T_WORD>
                    </TableName>
                    <TableColumnName offset="821">
                        <T_WORD offset="821">id</T_WORD>
                    </TableColumnName>
                </RefRightColumn>
            </TableColumnRef>
        </TableColumn>
        <TableColumn offset="827">
            <TableColumnName offset="827">
                <T_WORD offset="827">product_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="838">
                <TableColumnTypeName offset="838">
                    <T_WORD offset="838">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="844">
            <TableColumnName offset="844">
                <T_WORD offset="844">quantity</T_WORD>
            </TableColumnName>
            <TableColumnType offset="853">
                <TableColumnTypeName offset="853">
                    <T_WORD offset="853">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_DEFAULT offset="858">default</T_TABLE_SETTING_DEFAULT>
            <Int offset="867">
                <T_INT offset="867">1</T_INT>
            </Int>
        </TableColumn>
    </Table>
    <Ref offset="890">
        <RefLeftColumn offset="895">
            <TableName offset="895">
                <T_WORD offset="895">order_items</T_WORD>
            </TableName>
            <TableColumnName offset="907">
                <T_WORD offset="907">product_id</T_WORD>
            </TableColumnName>
        </RefLeftColumn>
        <RefType offset="918">
            <T_GT offset="918">></T_GT>
        </RefType>
        <RefRightColumn offset="920">
            <TableName offset="920">
                <T_WORD offset="920">products</T_WORD>
            </TableName>
            <TableColumnName offset="929">
                <T_WORD offset="929">id</T_WORD>
            </TableColumnName>
        </RefRightColumn>
    </Ref>
    <Table offset="933">
        <TableName offset="939">
            <T_WORD offset="939">orders</T_WORD>
        </TableName>
        <TableColumn offset="950">
            <TableColumnName offset="950">
                <T_WORD offset="950">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="953">
                <TableColumnTypeName offset="953">
                    <T_WORD offset="953">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="958">pk</T_TABLE_SETTING_PK>
        </TableColumn>
        <TableColumn offset="979">
            <TableColumnName offset="979">
                <T_WORD offset="979">user_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="987">
                <TableColumnTypeName offset="987">
                    <T_WORD offset="987">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_NOT_NULL offset="992">not null</T_TABLE_SETTING_NOT_NULL>
            <T_TABLE_SETTING_UNIQUE offset="1002">unique</T_TABLE_SETTING_UNIQUE>
        </TableColumn>
        <TableColumn offset="1012">
            <TableColumnName offset="1012">
                <T_WORD offset="1012">status</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1019">
                <TableColumnTypeName offset="1019">
                    <T_WORD offset="1019">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1029">
            <TableColumnName offset="1029">
                <T_WORD offset="1029">created_at</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1040">
                <TableColumnTypeName offset="1040">
                    <T_WORD offset="1040">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <SettingNote offset="1049">
                <String offset="1055">
                    <T_QUOTED_STRING offset="1055">'''When order created'''</T_QUOTED_STRING>
                </String>
            </SettingNote>
        </TableColumn>
    </Table>
    <Table offset="1103">
        <TableName offset="1109">
            <T_WORD offset="1109">int</T_WORD>
        </TableName>
        <TableColumn offset="1117">
            <TableColumnName offset="1117">
                <T_WORD offset="1117">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1120">
                <TableColumnTypeName offset="1120">
                    <T_WORD offset="1120">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
    </Table>
    <Enum offset="1253">
        <EnumName offset="1258">
            <T_WORD offset="1258">products_status</T_WORD>
        </EnumName>
        <EnumValue offset="1278">
            <T_WORD offset="1278">out_of_stock</T_WORD>
        </EnumValue>
        <EnumValue offset="1293">
            <T_WORD offset="1293">in_stock</T_WORD>
        </EnumValue>
        <EnumValue offset="1304">
            <T_WORD offset="1304">running_low</T_WORD>
            <SettingNote offset="1317">
                <String offset="1323">
                    <T_QUOTED_STRING offset="1323">'less than 20'</T_QUOTED_STRING>
                </String>
            </SettingNote>
        </EnumValue>
    </Enum>
    <Table offset="1419">
        <TableName offset="1425">
            <T_WORD offset="1425">products</T_WORD>
        </TableName>
        <TableColumn offset="1438">
            <TableColumnName offset="1438">
                <T_WORD offset="1438">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1441">
                <TableColumnTypeName offset="1441">
                    <T_WORD offset="1441">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="1446">pk</T_TABLE_SETTING_PK>
        </TableColumn>
        <TableColumn offset="1452">
            <TableColumnName offset="1452">
                <T_WORD offset="1452">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1457">
                <TableColumnTypeName offset="1457">
                    <T_WORD offset="1457">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1467">
            <TableColumnName offset="1467">
                <T_WORD offset="1467">merchant_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1479">
                <TableColumnTypeName offset="1479">
                    <T_WORD offset="1479">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_NOT_NULL offset="1484">not null</T_TABLE_SETTING_NOT_NULL>
        </TableColumn>
        <TableColumn offset="1496">
            <TableColumnName offset="1496">
                <T_WORD offset="1496">price</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1502">
                <TableColumnTypeName offset="1502">
                    <T_WORD offset="1502">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1508">
            <TableColumnName offset="1508">
                <T_WORD offset="1508">status</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1515">
                <TableColumnTypeName offset="1515">
                    <T_WORD offset="1515">products_status</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1533">
            <TableColumnName offset="1533">
                <T_WORD offset="1533">created_at</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1544">
                <TableColumnTypeName offset="1544">
                    <T_WORD offset="1544">datetime</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_DEFAULT offset="1554">default</T_TABLE_SETTING_DEFAULT>
            <Expression offset="1563">
                <T_EXPRESSION offset="1563">`now()`</T_EXPRESSION>
            </Expression>
        </TableColumn>
        <TableIndex offset="1589">
            <TableIndexCompositeField offset="1589">
                <String offset="1590">
                    <T_WORD offset="1590">merchant_id</T_WORD>
                </String>
                <String offset="1603">
                    <T_WORD offset="1603">status</T_WORD>
                </String>
            </TableIndexCompositeField>
            <TableIndexSettings offset="1611">
                <TableIndexSettingWithValue offset="1612">
                    <T_WORD offset="1612">name</T_WORD>
                    <String offset="1617">
                        <T_QUOTED_STRING offset="1617">'product_status'</T_QUOTED_STRING>
                    </String>
                </TableIndexSettingWithValue>
                <TableIndexSettingWithValue offset="1635">
                    <T_WORD offset="1635">type</T_WORD>
                    <String offset="1641">
                        <T_WORD offset="1641">hash</T_WORD>
                    </String>
                </TableIndexSettingWithValue>
            </TableIndexSettings>
        </TableIndex>
        <TableIndex offset="1651">
            <TableIndexSingleField offset="1651">
                <String offset="1651">
                    <T_WORD offset="1651">id</T_WORD>
                </String>
            </TableIndexSingleField>
            <TableIndexSettings offset="1654">
                <TableIndexSetting offset="1655">
                    <T_TABLE_SETTING_UNIQUE offset="1655">unique</T_TABLE_SETTING_UNIQUE>
                </TableIndexSetting>
            </TableIndexSettings>
        </TableIndex>
    </Table>
    <Ref offset="1670">
        <RefLeftColumn offset="1675">
            <TableName offset="1675">
                <T_WORD offset="1675">products</T_WORD>
            </TableName>
            <TableColumnName offset="1684">
                <T_WORD offset="1684">merchant_id</T_WORD>
            </TableColumnName>
        </RefLeftColumn>
        <RefType offset="1696">
            <T_GT offset="1696">></T_GT>
        </RefType>
        <RefRightColumn offset="1698">
            <TableName offset="1698">
                <T_WORD offset="1698">merchants</T_WORD>
            </TableName>
            <TableColumnName offset="1708">
                <T_WORD offset="1708">id</T_WORD>
            </TableColumnName>
        </RefRightColumn>
    </Ref>
    <TableGroup offset="1727">
        <TableGroupName offset="1738">
            <T_WORD offset="1738">hello_world</T_WORD>
        </TableGroupName>
        <TableName offset="1756">
            <T_WORD offset="1756">just_test</T_WORD>
        </TableName>
        <TableName offset="1770">
            <T_WORD offset="1770">just_a_test</T_WORD>
        </TableName>
    </TableGroup>
</Schema>
AST
        );
    }
}
