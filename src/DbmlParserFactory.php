<?php
declare(strict_types=1);

namespace Butschster\Dbml;

use Butschster\Dbml\Exceptions\GrammarFileNotFoundException;
use Phplrt\Contracts\Parser\ParserInterface;

class DbmlParserFactory
{
    /**
     * Create parser from given grammar file
     * @param string $path grammar.php file path
     * @return ParserInterface
     */
    public static function createFromFile(string $path): ParserInterface
    {
        if (!file_exists($path)) {
            throw new GrammarFileNotFoundException(
                "File {$path} not found"
            );
        }

        $data = require $path;

        return new DbmlParser(
            $data
        );
    }
}
