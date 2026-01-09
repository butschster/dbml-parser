<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\Ast\ProjectNode;
use Butschster\Dbml\Exceptions\ProjectSettingNotFoundException;

class ProjectNodeTest extends TestCase
{
    private ?ProjectNode $node;

    public function test_gets_name(): void
    {
        $this->assertEquals('project_test', $this->node->getName());
    }

    public function test_gets_node(): void
    {
        $this->assertEquals('Description of the project', $this->node->getNote());
    }

    public function test_gets_settings(): void
    {
        $this->assertCount(1, $this->node->getSettings());
    }

    public function test_non_exists_setting_should_throw_an_exception(): void
    {
        $this->expectException(ProjectSettingNotFoundException::class);
        $this->expectExceptionMessage('Project setting [test] not found.');

        $this->node->getSetting('test');
    }

    public function test_gets_setting_database_type(): void
    {
        $setting = $this->node->getSetting('database_type');

        $this->assertEquals('database_type', $setting->getKey());
        $this->assertEquals('PostgreSQL', $setting->getValue());
        $this->assertEquals(25, $setting->getOffset());
    }

    public function test_parse_project_without_note(): void
    {
        $project = $this->parser->parse(
            <<<DBML
Project project_name {
  database_type: 'PostgreSQL'
}
DBML,
        )->getProject();

        $this->assertNull($project->getNote());
    }

    public function test_parse_project_without_settings(): void
    {
        $project = $this->parser->parse(
            <<<DBML
Project project_name {
}
DBML,
        )->getProject();

        $this->assertEquals('project_name', $project->getName());
        $this->assertCount(0, $project->getSettings());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = $this->parser->parse(
            <<<DBML
Project project_test {
  database_type: 'PostgreSQL'
  Note: 'Description of the project'
}
DBML,
        )->getProject();
    }
}
