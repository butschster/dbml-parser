<?php
declare(strict_types=1);

namespace Butschster\Tests\Ast;

use Butschster\Dbml\DbmlParserFactory;
use Phplrt\Contracts\Parser\ParserInterface;

class TestCase extends \Butschster\Tests\Parsers\TestCase
{
    protected ParserInterface $parser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->parser = DbmlParserFactory::createFromFile(__DIR__ . static::GRAMMAR_FILE_PATH);
    }
}
