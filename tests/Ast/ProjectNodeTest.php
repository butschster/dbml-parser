<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\Ast\ProjectNode;

class ProjectNodeTest extends TestCase
{
    function test_parse_project_with_note()
    {
        /** @var ProjectNode $result */
        $result = $this->parser->parse(<<<DBML
Project project_name {
  database_type: 'PostgreSQL'
  Note: 'Description of the project'
}
DBML
        )[0];

        $setting = $result->getSettings()[0];

        $this->assertEquals('project_name', $result->getName());
        $this->assertEquals('Description of the project', $result->getNote());
        $this->assertCount(1, $result->getSettings());

        $this->assertEquals('database_type', $setting->getKey());
        $this->assertEquals('PostgreSQL', $setting->getValue());
        $this->assertEquals(25, $setting->getOffset());
    }

    function test_parse_project_without_note()
    {
        /** @var ProjectNode $result */
        $result = $this->parser->parse(<<<DBML
Project project_name {
  database_type: 'PostgreSQL'
}
DBML
        )[0];

        $this->assertEquals('project_name', $result->getName());
        $this->assertNull($result->getNote());
    }

    function test_parse_project_without_settings()
    {
        /** @var ProjectNode $result */
        $result = $this->parser->parse(<<<DBML
Project project_name {

}
DBML
        )[0];

        $this->assertEquals('project_name', $result->getName());
        $this->assertCount(0, $result->getSettings());
    }
}
