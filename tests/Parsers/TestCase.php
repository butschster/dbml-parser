<?php

declare(strict_types=1);

namespace Butschster\Tests\Parsers;

use Phplrt\Compiler\Compiler;
use Phplrt\Source\File;

class TestCase extends \Butschster\Tests\TestCase
{
    protected Compiler $compiler;

    public function assertAst(string $dbml, string $ast): void
    {
        $ast = \array_map(static function (string $line) {
            if (empty($line)) {
                return $line;
            }
            return \str_repeat(' ', 4) . $line;
        }, \explode("\n", $ast));

        $ast = \implode("\n", $ast);

        $this->assertEquals(
            <<<AST
<Document offset="0">
$ast
</Document>
AST,
            (string) $this->compiler->parse($dbml),
        );
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->compiler = new Compiler();
        $this->compiler->load(File::fromPathname(__DIR__ . static::EBNF_FILE_PATH));

        \file_put_contents(
            __DIR__ . static::GRAMMAR_FILE_PATH,
            (string) $this->compiler->build(),
        );
    }
}
