<?php
declare(strict_types=1);

namespace Butschster\Tests\Parsers;

class ProjectParserTest extends TestCase
{
    function test_project_with_single_line_note_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Project project_name {
    Note: 'Description of the project'
    database_type: 'PostgreSQL'
}
DBML
            , <<<AST
<Schema offset="0">
    <Project offset="0">
        <ProjectName offset="8">
            <String offset="8">
                <T_WORD offset="8">project_name</T_WORD>
            </String>
        </ProjectName>
        <Note offset="27">
            <String offset="33">
                <T_QUOTED_STRING offset="33">'Description of the project'</T_QUOTED_STRING>
            </String>
        </Note>
        <ProjectSetting offset="66">
            <ProjectSettingKey offset="66">
                <T_WORD offset="66">database_type</T_WORD>
            </ProjectSettingKey>
            <String offset="81">
                <T_QUOTED_STRING offset="81">'PostgreSQL'</T_QUOTED_STRING>
            </String>
        </ProjectSetting>
    </Project>
</Schema>
AST
        );
    }

    function test_project_with_multi_line_note_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Project project_name {
    database_type: 'PostgreSQL'
    Note: '''
        # DBML - Database Markup Language
        (database markup language) is a simple, readable DSL language designed to define database structures.

        ## Benefits
        * It is simple, flexible and highly human-readable
        * It is database agnostic, focusing on the essential database structure definition without worrying about the detailed syntaxes of each database
        * Comes with a free, simple database visualiser at [dbdiagram.io](http://dbdiagram.io)
    '''
}
DBML
            , <<<AST
<Schema offset="0">
    <Project offset="0">
        <ProjectName offset="8">
            <String offset="8">
                <T_WORD offset="8">project_name</T_WORD>
            </String>
        </ProjectName>
        <ProjectSetting offset="27">
            <ProjectSettingKey offset="27">
                <T_WORD offset="27">database_type</T_WORD>
            </ProjectSettingKey>
            <String offset="42">
                <T_QUOTED_STRING offset="42">'PostgreSQL'</T_QUOTED_STRING>
            </String>
        </ProjectSetting>
        <Note offset="59">
            <String offset="65">
                <T_QUOTED_STRING offset="65">'''
        # DBML - Database Markup Language
        (database markup language) is a simple, readable DSL language designed to define database structures.

        ## Benefits
        * It is simple, flexible and highly human-readable
        * It is database agnostic, focusing on the essential database structure definition without worrying about the detailed syntaxes of each database
        * Comes with a free, simple database visualiser at [dbdiagram.io](http://dbdiagram.io)
    '''</T_QUOTED_STRING>
            </String>
        </Note>
    </Project>
</Schema>
AST
        );
    }

    function test_project_with_block_note_should_be_parsed()
    {
        $this->assertAst(<<<DBML
Project project_name {
    database_type: 'PostgreSQL'
    Note {
        'This is a note of this table'
    }
}
DBML
            , <<<AST
<Schema offset="0">
    <Project offset="0">
        <ProjectName offset="8">
            <String offset="8">
                <T_WORD offset="8">project_name</T_WORD>
            </String>
        </ProjectName>
        <ProjectSetting offset="27">
            <ProjectSettingKey offset="27">
                <T_WORD offset="27">database_type</T_WORD>
            </ProjectSettingKey>
            <String offset="42">
                <T_QUOTED_STRING offset="42">'PostgreSQL'</T_QUOTED_STRING>
            </String>
        </ProjectSetting>
        <Note offset="59">
            <String offset="74">
                <T_QUOTED_STRING offset="74">'This is a note of this table'</T_QUOTED_STRING>
            </String>
        </Note>
    </Project>
</Schema>
AST
        );
    }
}
