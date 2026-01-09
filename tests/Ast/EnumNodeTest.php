<?php

declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\Ast\EnumNode;
use Butschster\Dbml\Exceptions\EnumValueNotFoundException;

class EnumNodeTest extends TestCase
{
    private EnumNode $node;

    public function test_gets_offset(): void
    {
        $this->assertEquals(0, $this->node->getOffset());
    }

    public function test_gets_name(): void
    {
        $this->assertEquals('products_status', $this->node->getName());
    }

    public function test_gets_values(): void
    {
        $this->assertCount(3, $this->node->getValues());
        $this->assertEquals(3, $this->node->count());
    }

    public function test_check_value_exist(): void
    {
        $this->assertTrue($this->node->hasValue('out_of_stock'));
        $this->assertTrue($this->node->hasValue('in_stock'));
        $this->assertTrue($this->node->hasValue('running_low'));
        $this->assertFalse($this->node->hasValue('test'));
    }

    public function test_gets_non_exists_value_should_throw_an_exception(): void
    {
        $this->expectException(EnumValueNotFoundException::class);
        $this->expectErrorMessage('Enum value [test] not found.');

        $this->node->getValue('test');
    }

    /**
     * @dataProvider enumValuesDataProvider
     * @param mixed $note
     */
    public function test_gets_value_by_name(string $value, $note): void
    {
        $this->assertEquals($value, $this->node->getValue($value)->getValue());
        $this->assertEquals($note, $this->node->getValue($value)->getNote());
    }

    public function enumValuesDataProvider()
    {
        return [
            ['running_low', 'less than 20'],
            ['out_of_stock', null],
            ['in_stock', null],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = $this->parser->parse(
            <<<DBML
Enum products_status {
  out_of_stock
  in_stock
  running_low [note: 'less than 20'] // add column note
}
DBML,
        )->getEnum('products_status');
    }
}
