<?php
declare(strict_types=1);

namespace Butschster\Tests\Parsers;

use Phplrt\Compiler\Compiler;
use Phplrt\Source\File;

class TestCase extends \Butschster\Tests\TestCase
{
    protected Compiler $compiler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->compiler = new Compiler();
        $this->compiler->load(File::fromPathname(__DIR__ . static::EBNF_FILE_PATH));

        file_put_contents(
            __DIR__ . static::GRAMMAR_FILE_PATH,
            (string)$this->compiler->build()
        );
    }

    public function assertAst(string $dbml, string $ast)
    {
        $this->assertEquals(
            $ast,
            (string)$this->compiler->parse($dbml)
        );
    }
}
