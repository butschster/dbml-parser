<?php
declare(strict_types=1);

namespace Butschster\Dbml;

use Butschster\Dbml\Ast\SchemaNode;
use Butschster\Dbml\Exceptions\GrammarFileNotFoundException;
use Phplrt\Contracts\Lexer\LexerInterface;
use Phplrt\Lexer\Lexer;
use Phplrt\Parser\Parser;
use Phplrt\Parser\BuilderInterface;
use Phplrt\Parser\ContextInterface;
use Phplrt\Contracts\Parser\ParserInterface;

class DbmlParser
{
    private ParserInterface $parser;

    public function __construct(array $grammar)
    {
        $lexer = $this->createLexer($grammar);
        $builder = $this->createBuilder($grammar['reducers']);

        $this->parser = $this->createParser($lexer, $grammar, $builder);
    }

    /**
     * Parse DBML schema
     * @param string $dbml
     * @param array $options
     * @return SchemaNode|null
     * @throws \Phplrt\Contracts\Exception\RuntimeExceptionInterface
     */
    public function parse(string $dbml, array $options = []): ?SchemaNode
    {
        return $this->parser->parse($dbml, $options)[0] ?? null;
    }

    /**
     * Create Lexer from compiled data.
     */
    private function createLexer(array $data): LexerInterface
    {
        return new Lexer(
            $data['tokens']['default'],
            $data['skip']
        );
    }

    /**
     * Create AST builder from compiled data.
     */
    private function createBuilder(array $reducers)
    {
        return new class($reducers) implements BuilderInterface {
            public function __construct(private array $reducers)
            {
            }

            public function build(ContextInterface $context, $result)
            {
                $state = $context->getState();

                return isset($this->reducers[$state])
                    ? $this->reducers[$state]($context, $result)
                    : $result;
            }
        };
    }

    /**
     * Create Parser from compiled data.
     */
    private function createParser(LexerInterface $lexer, mixed $data, BuilderInterface $builder): ParserInterface
    {
        return new Parser($lexer, $data['grammar'], [
            // Recognition will start from the specified rule.
            Parser::CONFIG_INITIAL_RULE => $data['initial'],

            // Rules for the abstract syntax tree builder.
            // In this case, we use the data found in the compiled grammar.
            Parser::CONFIG_AST_BUILDER => $builder,
        ]);
    }

    /**
     * @param string $grammarFilePatch
     */
    private function ensureGrammarFileExists(string $grammarFilePatch): void
    {
        if (!file_exists($grammarFilePatch)) {
            throw new GrammarFileNotFoundException(
                "File {$grammarFilePatch} not found"
            );
        }
    }
}
