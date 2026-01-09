<?php

declare(strict_types=1);

namespace Butschster\Dbml;

use Butschster\Dbml\Exceptions\GrammarFileNotFoundException;

class DbmlParserFactory
{
    /**
     * Create parser from grammar file
     */
    public static function create(): DbmlParser
    {
        $path = __DIR__ . '/grammar.php';
        if (!\file_exists($path)) {
            throw new GrammarFileNotFoundException("Grammar file [{$path}] not found.");
        }

        $data = require $path;

        return new DbmlParser(
            $data,
        );
    }
}
