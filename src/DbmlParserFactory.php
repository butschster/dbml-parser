<?php
declare(strict_types=1);

namespace Butschster\Dbml;

use Butschster\Dbml\Exceptions\GrammarFileNotFoundException;

class DbmlParserFactory
{
    /**
     * Create parser from given grammar file
     * @param string $path grammar.php file path
     * @return DbmlParser
     */
    public static function createFromFile(string $path): DbmlParser
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
