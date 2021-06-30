<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast;

class ProjectNodeTest extends TestCase
{
    function test_parse_project_with_note()
    {
        $schema = $this->parser->parse(<<<DBML
Project project_name {
  database_type: 'PostgreSQL'
  Note: 'Description of the project'
}
DBML
        );

        $project = $schema->getProject();
        $setting = $project->getSettings()[0];

        $this->assertEquals('project_name', $project->getName());
        $this->assertEquals('Description of the project', $project->getNote());
        $this->assertCount(1, $project->getSettings());

        $this->assertEquals('database_type', $setting->getKey());
        $this->assertEquals('PostgreSQL', $setting->getValue());
        $this->assertEquals(25, $setting->getOffset());
    }

    function test_parse_project_without_note()
    {
        $schema = $this->parser->parse(<<<DBML
Project project_name {
  database_type: 'PostgreSQL'
}
DBML
        );

        $project = $schema->getProject();

        $this->assertEquals('project_name', $project->getName());
        $this->assertNull($project->getNote());
    }

    function test_parse_project_without_settings()
    {
        $schema = $this->parser->parse(<<<DBML
Project project_name {

}
DBML
        );

        $project = $schema->getProject();

        $this->assertEquals('project_name', $project->getName());
        $this->assertCount(0, $project->getSettings());
    }
}
