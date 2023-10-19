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
        <ProjectSetting offset="18">
            <ProjectSettingKey offset="18">
                <T_WORD offset="18">database_type</T_WORD>
            </ProjectSettingKey>
            <String offset="33">
                <T_QUOTED_STRING offset="33">'PostgreSQL'</T_QUOTED_STRING>
            </String>
        </ProjectSetting>
        <Note offset="49">
            <String offset="55">
                <T_QUOTED_STRING offset="55">'Description of the project'</T_QUOTED_STRING>
            </String>
        </Note>
    </Project>
    <Table offset="160">
        <TableName offset="166">
            <T_WORD offset="166">users</T_WORD>
        </TableName>
        <TableAlias offset="172">
            <T_WORD offset="175">U</T_WORD>
        </TableAlias>
        <TableColumn offset="182">
            <TableColumnName offset="182">
                <T_WORD offset="182">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="185">
                <TableColumnTypeName offset="185">
                    <T_WORD offset="185">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="190">pk</T_TABLE_SETTING_PK>
            <T_TABLE_SETTING_UNIQUE offset="194">unique</T_TABLE_SETTING_UNIQUE>
            <T_TABLE_SETTING_INCREMENT offset="202">increment</T_TABLE_SETTING_INCREMENT>
        </TableColumn>
        <TableColumn offset="234">
            <TableColumnName offset="234">
                <T_WORD offset="234">full_name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="244">
                <TableColumnTypeName offset="244">
                    <T_WORD offset="244">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_NOT_NULL offset="253">not null</T_TABLE_SETTING_NOT_NULL>
            <T_TABLE_SETTING_UNIQUE offset="263">unique</T_TABLE_SETTING_UNIQUE>
            <T_TABLE_SETTING_DEFAULT offset="271">default</T_TABLE_SETTING_DEFAULT>
            <String offset="280">
                <T_WORD offset="280">1</T_WORD>
            </String>
        </TableColumn>
        <TableColumn offset="286">
            <TableColumnName offset="286">
                <T_WORD offset="286">created_at</T_WORD>
            </TableColumnName>
            <TableColumnType offset="297">
                <TableColumnTypeName offset="297">
                    <T_WORD offset="297">timestamp</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="310">
            <TableColumnName offset="310">
                <T_WORD offset="310">country_code</T_WORD>
            </TableColumnName>
            <TableColumnType offset="323">
                <TableColumnTypeName offset="323">
                    <T_WORD offset="323">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="330">
            <TableColumnName offset="330">
                <T_WORD offset="330">type</T_WORD>
            </TableColumnName>
            <TableColumnType offset="335">
                <TableColumnTypeName offset="335">
                    <T_WORD offset="335">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="342">
            <TableColumnName offset="342">
                <T_WORD offset="342">note</T_WORD>
            </TableColumnName>
            <TableColumnType offset="347">
                <TableColumnTypeName offset="347">
                    <T_WORD offset="347">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <Note offset="354">
            <String offset="360">
                <T_QUOTED_STRING offset="360">'khong hieu duoc'</T_QUOTED_STRING>
            </String>
        </Note>
    </Table>
    <Table offset="384">
        <TableName offset="390">
            <T_WORD offset="390">merchants</T_WORD>
        </TableName>
        <TableColumn offset="405">
            <TableColumnName offset="405">
                <T_WORD offset="405">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="408">
                <TableColumnTypeName offset="408">
                    <T_WORD offset="408">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
    </Table>
    <Table offset="418">
        <TableName offset="424">
            <T_WORD offset="424">countries</T_WORD>
        </TableName>
        <TableColumn offset="439">
            <TableColumnName offset="439">
                <T_WORD offset="439">code</T_WORD>
            </TableColumnName>
            <TableColumnType offset="444">
                <TableColumnTypeName offset="444">
                    <T_WORD offset="444">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="449">pk</T_TABLE_SETTING_PK>
        </TableColumn>
        <TableColumn offset="456">
            <TableColumnName offset="456">
                <T_WORD offset="456">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="461">
                <TableColumnTypeName offset="461">
                    <T_WORD offset="461">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="472">
            <TableColumnName offset="472">
                <T_WORD offset="472">continent_name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="487">
                <TableColumnTypeName offset="487">
                    <T_WORD offset="487">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
    </Table>
    <Ref offset="620">
        <RefLeftTable offset="628">
            <TableName offset="628">
                <T_WORD offset="628">U</T_WORD>
            </TableName>
            <TableColumnName offset="630">
                <T_WORD offset="630">country_code</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="643">></T_GT>
        <RefRightTable offset="645">
            <TableName offset="645">
                <T_WORD offset="645">countries</T_WORD>
            </TableName>
            <TableColumnName offset="655">
                <T_WORD offset="655">code</T_WORD>
            </TableColumnName>
        </RefRightTable>
        <RefLeftTable offset="663">
            <TableName offset="663">
                <T_WORD offset="663">merchants</T_WORD>
            </TableName>
            <TableColumnName offset="673">
                <T_WORD offset="673">country_code</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="686">></T_GT>
        <RefRightTable offset="688">
            <TableName offset="688">
                <T_WORD offset="688">countries</T_WORD>
            </TableName>
            <TableColumnName offset="698">
                <T_WORD offset="698">code</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
    <Table offset="814">
        <TableName offset="820">
            <T_WORD offset="820">order_items</T_WORD>
        </TableName>
        <TableColumn offset="837">
            <TableColumnName offset="837">
                <T_WORD offset="837">order_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="846">
                <TableColumnTypeName offset="846">
                    <T_WORD offset="846">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <TableColumnRef offset="851">
                <T_GT offset="856">></T_GT>
                <RefRightTable offset="858">
                    <TableName offset="858">
                        <T_WORD offset="858">orders</T_WORD>
                    </TableName>
                    <TableColumnName offset="865">
                        <T_WORD offset="865">id</T_WORD>
                    </TableColumnName>
                </RefRightTable>
            </TableColumnRef>
        </TableColumn>
        <TableColumn offset="872">
            <TableColumnName offset="872">
                <T_WORD offset="872">product_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="883">
                <TableColumnTypeName offset="883">
                    <T_WORD offset="883">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="890">
            <TableColumnName offset="890">
                <T_WORD offset="890">quantity</T_WORD>
            </TableColumnName>
            <TableColumnType offset="899">
                <TableColumnTypeName offset="899">
                    <T_WORD offset="899">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_DEFAULT offset="904">default</T_TABLE_SETTING_DEFAULT>
            <String offset="913">
                <T_WORD offset="913">1</T_WORD>
            </String>
        </TableColumn>
    </Table>
    <Ref offset="939">
        <RefLeftTable offset="944">
            <TableName offset="944">
                <T_WORD offset="944">order_items</T_WORD>
            </TableName>
            <TableColumnName offset="956">
                <T_WORD offset="956">product_id</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="967">></T_GT>
        <RefRightTable offset="969">
            <TableName offset="969">
                <T_WORD offset="969">products</T_WORD>
            </TableName>
            <TableColumnName offset="978">
                <T_WORD offset="978">id</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
    <Table offset="984">
        <TableName offset="990">
            <T_WORD offset="990">orders</T_WORD>
        </TableName>
        <TableColumn offset="1002">
            <TableColumnName offset="1002">
                <T_WORD offset="1002">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1005">
                <TableColumnTypeName offset="1005">
                    <T_WORD offset="1005">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="1010">pk</T_TABLE_SETTING_PK>
        </TableColumn>
        <TableColumn offset="1032">
            <TableColumnName offset="1032">
                <T_WORD offset="1032">user_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1040">
                <TableColumnTypeName offset="1040">
                    <T_WORD offset="1040">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_NOT_NULL offset="1045">not null</T_TABLE_SETTING_NOT_NULL>
            <T_TABLE_SETTING_UNIQUE offset="1055">unique</T_TABLE_SETTING_UNIQUE>
        </TableColumn>
        <TableColumn offset="1066">
            <TableColumnName offset="1066">
                <T_WORD offset="1066">status</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1073">
                <TableColumnTypeName offset="1073">
                    <T_WORD offset="1073">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1084">
            <TableColumnName offset="1084">
                <T_WORD offset="1084">created_at</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1095">
                <TableColumnTypeName offset="1095">
                    <T_WORD offset="1095">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <SettingNote offset="1104">
                <String offset="1110">
                    <T_QUOTED_STRING offset="1110">'''When order created'''</T_QUOTED_STRING>
                </String>
            </SettingNote>
        </TableColumn>
    </Table>
    <Table offset="1161">
        <TableName offset="1167">
            <T_WORD offset="1167">int</T_WORD>
        </TableName>
        <TableColumn offset="1176">
            <TableColumnName offset="1176">
                <T_WORD offset="1176">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1179">
                <TableColumnTypeName offset="1179">
                    <T_WORD offset="1179">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
    </Table>
    <Enum offset="1321">
        <EnumName offset="1326">
            <T_WORD offset="1326">products_status</T_WORD>
        </EnumName>
        <EnumValue offset="1347">
            <T_WORD offset="1347">out_of_stock</T_WORD>
        </EnumValue>
        <EnumValue offset="1363">
            <T_WORD offset="1363">in_stock</T_WORD>
        </EnumValue>
        <EnumValue offset="1375">
            <T_WORD offset="1375">running_low</T_WORD>
            <SettingNote offset="1388">
                <String offset="1394">
                    <T_QUOTED_STRING offset="1394">'less than 20'</T_QUOTED_STRING>
                </String>
            </SettingNote>
        </EnumValue>
    </Enum>
    <Table offset="1494">
        <TableName offset="1500">
            <T_WORD offset="1500">products</T_WORD>
        </TableName>
        <TableColumn offset="1514">
            <TableColumnName offset="1514">
                <T_WORD offset="1514">id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1517">
                <TableColumnTypeName offset="1517">
                    <T_WORD offset="1517">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_PK offset="1522">pk</T_TABLE_SETTING_PK>
        </TableColumn>
        <TableColumn offset="1529">
            <TableColumnName offset="1529">
                <T_WORD offset="1529">name</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1534">
                <TableColumnTypeName offset="1534">
                    <T_WORD offset="1534">varchar</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1545">
            <TableColumnName offset="1545">
                <T_WORD offset="1545">merchant_id</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1557">
                <TableColumnTypeName offset="1557">
                    <T_WORD offset="1557">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_NOT_NULL offset="1562">not null</T_TABLE_SETTING_NOT_NULL>
        </TableColumn>
        <TableColumn offset="1575">
            <TableColumnName offset="1575">
                <T_WORD offset="1575">price</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1581">
                <TableColumnTypeName offset="1581">
                    <T_WORD offset="1581">int</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1588">
            <TableColumnName offset="1588">
                <T_WORD offset="1588">status</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1595">
                <TableColumnTypeName offset="1595">
                    <T_WORD offset="1595">products_status</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
        </TableColumn>
        <TableColumn offset="1614">
            <TableColumnName offset="1614">
                <T_WORD offset="1614">created_at</T_WORD>
            </TableColumnName>
            <TableColumnType offset="1625">
                <TableColumnTypeName offset="1625">
                    <T_WORD offset="1625">datetime</T_WORD>
                </TableColumnTypeName>
            </TableColumnType>
            <T_TABLE_SETTING_DEFAULT offset="1635">default</T_TABLE_SETTING_DEFAULT>
            <Expression offset="1644">
                <T_EXPRESSION offset="1644">`now()`</T_EXPRESSION>
            </Expression>
        </TableColumn>
        <TableIndex offset="1673">
            <TableIndexCompositeField offset="1673">
                <String offset="1674">
                    <T_WORD offset="1674">merchant_id</T_WORD>
                </String>
                <String offset="1687">
                    <T_WORD offset="1687">status</T_WORD>
                </String>
            </TableIndexCompositeField>
            <TableIndexSettings offset="1695">
                <TableIndexSettingWithValue offset="1696">
                    <T_WORD offset="1696">name</T_WORD>
                    <String offset="1701">
                        <T_QUOTED_STRING offset="1701">'product_status'</T_QUOTED_STRING>
                    </String>
                </TableIndexSettingWithValue>
                <TableIndexSettingWithValue offset="1719">
                    <T_WORD offset="1719">type</T_WORD>
                    <String offset="1725">
                        <T_WORD offset="1725">hash</T_WORD>
                    </String>
                </TableIndexSettingWithValue>
            </TableIndexSettings>
        </TableIndex>
        <TableIndex offset="1736">
            <TableIndexSingleField offset="1736">
                <String offset="1736">
                    <T_WORD offset="1736">id</T_WORD>
                </String>
            </TableIndexSingleField>
            <TableIndexSettings offset="1739">
                <TableIndexSetting offset="1740">
                    <T_TABLE_SETTING_UNIQUE offset="1740">unique</T_TABLE_SETTING_UNIQUE>
                </TableIndexSetting>
            </TableIndexSettings>
        </TableIndex>
    </Table>
    <Ref offset="1759">
        <RefLeftTable offset="1764">
            <TableName offset="1764">
                <T_WORD offset="1764">products</T_WORD>
            </TableName>
            <TableColumnName offset="1773">
                <T_WORD offset="1773">merchant_id</T_WORD>
            </TableColumnName>
        </RefLeftTable>
        <T_GT offset="1785">></T_GT>
        <RefRightTable offset="1787">
            <TableName offset="1787">
                <T_WORD offset="1787">merchants</T_WORD>
            </TableName>
            <TableColumnName offset="1797">
                <T_WORD offset="1797">id</T_WORD>
            </TableColumnName>
        </RefRightTable>
    </Ref>
    <TableGroup offset="1818">
        <TableGroupName offset="1829">
            <T_WORD offset="1829">hello_world</T_WORD>
        </TableGroupName>
        <TableName offset="1848">
            <T_WORD offset="1848">just_test</T_WORD>
        </TableName>
        <TableName offset="1863">
            <T_WORD offset="1863">just_a_test</T_WORD>
        </TableName>
    </TableGroup>
</Schema>
AST
        );
    }
}
