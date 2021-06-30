<?php
declare(strict_types=1);

namespace Butschster\Tests;

use Butschster\Dbml\Parser\Schema;
use Butschster\Dbml\Tokenizer;
use Butschster\Dbml\Tokenizer\TokenCollection;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected const GRAMMAR_FILE_PATH = '/../../src/grammar.php';
    protected const EBNF_FILE_PATH = '/../../ebnf.pp2';
}
