<?php

declare(strict_types=1);

namespace Butschster\Tests\Parsers;

class EnumParserTest extends TestCase
{
    /**
     * @dataProvider enumKeyNames
     */
    public function test_enum_should_be_parsed(string $name): void
    {
        $this->assertAst(
            <<<DBML
{$name} job_status {
    created [note: 'Waiting to be processed']
    running
    done
    failure
}
DBML,
            <<<AST
<Schema offset="0">
    <Enum offset="0">
        <EnumName offset="5">
            <T_WORD offset="5">job_status</T_WORD>
        </EnumName>
        <EnumValue offset="22">
            <T_WORD offset="22">created</T_WORD>
            <SettingNote offset="31">
                <String offset="37">
                    <T_QUOTED_STRING offset="37">'Waiting to be processed'</T_QUOTED_STRING>
                </String>
            </SettingNote>
        </EnumValue>
        <EnumValue offset="68">
            <T_WORD offset="68">running</T_WORD>
        </EnumValue>
        <EnumValue offset="80">
            <T_WORD offset="80">done</T_WORD>
        </EnumValue>
        <EnumValue offset="89">
            <T_WORD offset="89">failure</T_WORD>
        </EnumValue>
    </Enum>
</Schema>
AST,
        );
    }

    public function enumKeyNames()
    {
        return [
            ['enum'],
            ['Enum'],
        ];
    }
}
