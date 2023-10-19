<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\Ast\ProjectNode;
use Butschster\Dbml\Exceptions\ProjectSettingNotFoundException;

class ProjectNodeTest extends TestCase
{
    private ?ProjectNode $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = $this->parser->parse(<<<DBML
Project project_test {
  database_type: 'PostgreSQL'
  Note: 'Description of the project'
}
DBML
        )->getProject();
    }

    function test_gets_name()
    {
        $this->assertEquals('project_test', $this->node->getName());
    }

    function test_gets_node()
    {
        $this->assertEquals('Description of the project', $this->node->getNote());
    }

    function test_gets_settings()
    {
        $this->assertCount(1, $this->node->getSettings());
    }

    function test_non_exists_setting_should_throw_an_exception()
    {
        $this->expectException(ProjectSettingNotFoundException::class);
        $this->expectErrorMessage('Project setting [test] not found.');

        $this->node->getSetting('test');
    }

    function test_gets_setting_database_type()
    {
        $setting = $this->node->getSetting('database_type');

        $this->assertEquals('database_type', $setting->getKey());
        $this->assertEquals('PostgreSQL', $setting->getValue());
        $this->assertEquals(26, $setting->getOffset());
    }

    function test_parse_project_without_note()
    {
        $project = $this->parser->parse(<<<DBML
Project project_name {
  database_type: 'PostgreSQL'
}
DBML
        )->getProject();

        $this->assertNull($project->getNote());
    }

    function test_parse_project_without_settings()
    {
        $project = $this->parser->parse(<<<DBML
Project project_name {
}
DBML
        )->getProject();

        $this->assertEquals('project_name', $project->getName());
        $this->assertCount(0, $project->getSettings());
    }
}
