<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\DbmlParser;
use Butschster\Dbml\DbmlParserFactory;

class TestCase extends \Butschster\Tests\Parsers\TestCase
{
    protected DbmlParser $parser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->parser = DbmlParserFactory::createFromFile(__DIR__ . static::GRAMMAR_FILE_PATH);
    }
}
