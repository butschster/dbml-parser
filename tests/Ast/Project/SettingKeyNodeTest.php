<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast\Project;

use Butschster\Dbml\Ast\Project\SettingKeyNode;
use Butschster\Tests\Ast\TestCase;

class SettingKeyNodeTest extends TestCase
{
    private SettingKeyNode $node;

    public function test_gets_offset(): void
    {
        $this->assertEquals(123, $this->node->getOffset());
    }

    public function test_gets_value(): void
    {
        $this->assertEquals('hello world', $this->node->getValue());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = new SettingKeyNode(
            123,
            'hello world',
        );
    }
}
