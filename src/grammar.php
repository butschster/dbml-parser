<?php
return [
    'initial' => 'Run',
    'tokens' => [
        'default' => [
            'T_WHITESPACE' => '\\s+',
            'T_COMMENT' => '//[^\\n]*\\n',
            'T_BOOL_TRUE' => '(?<=\\b)true\\b',
            'T_BOOL_FALSE' => '(?<=\\b)false\\b',
            'T_NULL' => '(?<=\\b)null\\b',
            'T_PROJECT' => '(?<=\\b)Project\\b',
            'T_TABLE' => '(?<=\\b)Table\\b',
            'T_TABLE_ALIAS' => '(?<=\\b)as\\b',
            'T_TABLE_INDEXES' => '(?<=\\b)(Indexes|indexes)\\b',
            'T_TABLE_REF' => '(Ref|ref)',
            'T_TABLE_GROUP' => '(?<=\\b)TableGroup\\b',
            'T_ENUM' => '(?<=\\b)(Enum|enum)\\b',
            'T_TABLE_SETTING' => '(primary\\skey|pk|null|not\\snull|unique|default|increment)',
            'T_SETTING_NOTE' => 'note:',
            'T_NOTE' => '(?<=\\b)Note\\b',
            'T_FLOAT' => '[0-9]+\\.[0-9]+',
            'T_INT' => '[0-9]+',
            'T_QUOTED_STRING' => '(\'{3}|["\']{1})([^\'"][\\s\\S]*?)\\1',
            'T_EXPRESSION' => '(`{1})([\\s\\S]+?)\\1',
            'T_WORD' => '[a-zA-Z_]+',
            'T_EOL' => '\\\\n',
            'T_LPAREN' => '\\(',
            'T_RPAREN' => '\\)',
            'T_LBRACE' => '{',
            'T_RBRACE' => '}',
            'T_LBRACK' => '\\[',
            'T_RBRACK' => '\\]',
            'T_GT' => '\\>',
            'T_LT' => '\\<',
            'T_COMMA' => ',',
            'T_COLON' => ':',
            'T_MINUS' => '\\-',
            'T_DOT' => '\\.',
        ],
    ],
    'skip' => [
        'T_WHITESPACE',
        'T_COMMENT',
    ],
    'transitions' => [
        
    ],
    'grammar' => [
        'Boolean' => new \Phplrt\Grammar\Alternation([120, 121]),
        'Enum' => new \Phplrt\Grammar\Concatenation([101, 'EnumName', 102, 0, 103, 104, 0]),
        'EnumName' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'EnumValue' => new \Phplrt\Grammar\Concatenation([106, 107]),
        'Expression' => new \Phplrt\Grammar\Lexeme('T_EXPRESSION', true),
        'Float' => new \Phplrt\Grammar\Lexeme('T_FLOAT', true),
        'Int' => new \Phplrt\Grammar\Lexeme('T_INT', true),
        'Note' => new \Phplrt\Grammar\Concatenation([115, 116]),
        'Null' => new \Phplrt\Grammar\Lexeme('T_NULL', true),
        'Project' => new \Phplrt\Grammar\Concatenation([5, 'ProjectName', 6, 0, 7, 8, 0]),
        'ProjectName' => new \Phplrt\Grammar\Concatenation(['String']),
        'ProjectSetting' => new \Phplrt\Grammar\Concatenation(['ProjectSettingKey', 9, 'String', 0]),
        'ProjectSettingKey' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'Ref' => new \Phplrt\Grammar\Concatenation([69, 70]),
        'RefCompositeTableColumn' => new \Phplrt\Grammar\Concatenation([89, 90, 91]),
        'RefLeftColumn' => new \Phplrt\Grammar\Concatenation([85]),
        'RefRightColumn' => new \Phplrt\Grammar\Concatenation([85]),
        'RefType' => new \Phplrt\Grammar\Alternation([82, 83, 84]),
        'Run' => new \Phplrt\Grammar\Concatenation(['Schema']),
        'Schema' => new \Phplrt\Grammar\Repetition(2, 0, INF),
        'SettingNote' => new \Phplrt\Grammar\Concatenation([118, 'String', 119]),
        'String' => new \Phplrt\Grammar\Alternation([122, 123]),
        'Table' => new \Phplrt\Grammar\Concatenation([13, 'TableName', 14, 15, 0, 16, 17, 18, 19, 0]),
        'TableAlias' => new \Phplrt\Grammar\Concatenation([20, 21]),
        'TableColumn' => new \Phplrt\Grammar\Concatenation(['TableColumnName', 'TableColumnType', 22]),
        'TableColumnName' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'TableColumnRef' => new \Phplrt\Grammar\Concatenation([72, 73, 'RefType', 'RefRightColumn', 74]),
        'TableColumnSettings' => new \Phplrt\Grammar\Concatenation([29, 30, 31]),
        'TableColumnType' => new \Phplrt\Grammar\Concatenation(['TableColumnTypeName', 23]),
        'TableColumnTypeName' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'TableColumnTypeSize' => new \Phplrt\Grammar\Concatenation([24, 'Int', 25]),
        'TableGroup' => new \Phplrt\Grammar\Concatenation([95, 96, 97, 0, 98, 99, 0]),
        'TableIndex' => new \Phplrt\Grammar\Concatenation([45, 46]),
        'TableIndexCompositeField' => new \Phplrt\Grammar\Concatenation([53, 54, 55]),
        'TableIndexSetting' => new \Phplrt\Grammar\Concatenation([61, 62]),
        'TableIndexSettingWithValue' => new \Phplrt\Grammar\Concatenation([64, 65, 'String', 66]),
        'TableIndexSettings' => new \Phplrt\Grammar\Concatenation([57, 58, 59]),
        'TableIndexSingleField' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'TableLongRefColumn' => new \Phplrt\Grammar\Concatenation([75]),
        'TableName' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'TableRefName' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        1 => new \Phplrt\Grammar\Concatenation(['Ref', 0]),
        2 => new \Phplrt\Grammar\Alternation(['Project', 'Table', 'TableGroup', 'Enum', 1]),
        3 => new \Phplrt\Grammar\Concatenation(['Note', 0]),
        4 => new \Phplrt\Grammar\Alternation([3, 'ProjectSetting']),
        5 => new \Phplrt\Grammar\Lexeme('T_PROJECT', false),
        6 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        7 => new \Phplrt\Grammar\Repetition(4, 0, INF),
        8 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        9 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        10 => new \Phplrt\Grammar\Concatenation(['TableColumn', 0]),
        11 => new \Phplrt\Grammar\Concatenation(['Note', 0]),
        12 => new \Phplrt\Grammar\Concatenation([41, 42, 0, 43, 44]),
        13 => new \Phplrt\Grammar\Lexeme('T_TABLE', false),
        14 => new \Phplrt\Grammar\Optional('TableAlias'),
        15 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        16 => new \Phplrt\Grammar\Repetition(10, 0, INF),
        17 => new \Phplrt\Grammar\Optional(11),
        18 => new \Phplrt\Grammar\Optional(12),
        19 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        20 => new \Phplrt\Grammar\Lexeme('T_TABLE_ALIAS', false),
        21 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        22 => new \Phplrt\Grammar\Optional('TableColumnSettings'),
        23 => new \Phplrt\Grammar\Optional('TableColumnTypeSize'),
        24 => new \Phplrt\Grammar\Lexeme('T_LPAREN', false),
        25 => new \Phplrt\Grammar\Lexeme('T_RPAREN', false),
        26 => new \Phplrt\Grammar\Concatenation([36, 37, 38, 39]),
        27 => new \Phplrt\Grammar\Concatenation([33, 34]),
        28 => new \Phplrt\Grammar\Alternation(['SettingNote', 'TableColumnRef', 26, 27]),
        29 => new \Phplrt\Grammar\Lexeme('T_LBRACK', false),
        30 => new \Phplrt\Grammar\Repetition(28, 0, INF),
        31 => new \Phplrt\Grammar\Lexeme('T_RBRACK', false),
        32 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        33 => new \Phplrt\Grammar\Lexeme('T_TABLE_SETTING', true),
        34 => new \Phplrt\Grammar\Optional(32),
        35 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        36 => new \Phplrt\Grammar\Lexeme('T_TABLE_SETTING', true),
        37 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        38 => new \Phplrt\Grammar\Alternation(['Expression', 'Float', 'Int', 'Boolean', 'Null', 'String']),
        39 => new \Phplrt\Grammar\Optional(35),
        40 => new \Phplrt\Grammar\Concatenation(['TableIndex', 0]),
        41 => new \Phplrt\Grammar\Lexeme('T_TABLE_INDEXES', false),
        42 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        43 => new \Phplrt\Grammar\Repetition(40, 0, INF),
        44 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        45 => new \Phplrt\Grammar\Alternation(['TableIndexCompositeField', 'TableIndexSingleField']),
        46 => new \Phplrt\Grammar\Optional('TableIndexSettings'),
        47 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        48 => new \Phplrt\Grammar\Lexeme('T_EXPRESSION', true),
        49 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        50 => new \Phplrt\Grammar\Alternation([47, 48]),
        51 => new \Phplrt\Grammar\Optional(49),
        52 => new \Phplrt\Grammar\Concatenation([50, 51]),
        53 => new \Phplrt\Grammar\Lexeme('T_LPAREN', false),
        54 => new \Phplrt\Grammar\Repetition(52, 0, INF),
        55 => new \Phplrt\Grammar\Lexeme('T_RPAREN', false),
        56 => new \Phplrt\Grammar\Alternation(['SettingNote', 'TableIndexSettingWithValue', 'TableIndexSetting']),
        57 => new \Phplrt\Grammar\Lexeme('T_LBRACK', false),
        58 => new \Phplrt\Grammar\Repetition(56, 0, INF),
        59 => new \Phplrt\Grammar\Lexeme('T_RBRACK', false),
        60 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        61 => new \Phplrt\Grammar\Lexeme('T_TABLE_SETTING', true),
        62 => new \Phplrt\Grammar\Optional(60),
        63 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        64 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        65 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        66 => new \Phplrt\Grammar\Optional(63),
        67 => new \Phplrt\Grammar\Concatenation([76, 77, 75]),
        68 => new \Phplrt\Grammar\Concatenation([78, 79, 0, 80, 81, 0]),
        69 => new \Phplrt\Grammar\Lexeme('T_TABLE_REF', false),
        70 => new \Phplrt\Grammar\Alternation([67, 68]),
        71 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        72 => new \Phplrt\Grammar\Lexeme('T_TABLE_REF', false),
        73 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        74 => new \Phplrt\Grammar\Optional(71),
        75 => new \Phplrt\Grammar\Concatenation(['RefLeftColumn', 'RefType', 'RefRightColumn']),
        76 => new \Phplrt\Grammar\Optional('TableRefName'),
        77 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        78 => new \Phplrt\Grammar\Optional('TableRefName'),
        79 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        80 => new \Phplrt\Grammar\Repetition('TableLongRefColumn', 0, INF),
        81 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        82 => new \Phplrt\Grammar\Lexeme('T_GT', true),
        83 => new \Phplrt\Grammar\Lexeme('T_LT', true),
        84 => new \Phplrt\Grammar\Lexeme('T_MINUS', true),
        85 => new \Phplrt\Grammar\Concatenation(['TableName', 92, 93]),
        86 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        87 => new \Phplrt\Grammar\Optional(86),
        88 => new \Phplrt\Grammar\Concatenation(['TableColumnName', 87]),
        89 => new \Phplrt\Grammar\Lexeme('T_LPAREN', false),
        90 => new \Phplrt\Grammar\Repetition(88, 0, INF),
        91 => new \Phplrt\Grammar\Lexeme('T_RPAREN', false),
        92 => new \Phplrt\Grammar\Lexeme('T_DOT', false),
        93 => new \Phplrt\Grammar\Alternation(['TableColumnName', 'RefCompositeTableColumn']),
        94 => new \Phplrt\Grammar\Concatenation(['TableName', 0]),
        95 => new \Phplrt\Grammar\Lexeme('T_TABLE_GROUP', false),
        96 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        97 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        98 => new \Phplrt\Grammar\Repetition(94, 0, INF),
        99 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        100 => new \Phplrt\Grammar\Concatenation(['EnumValue', 0]),
        101 => new \Phplrt\Grammar\Lexeme('T_ENUM', false),
        102 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        103 => new \Phplrt\Grammar\Repetition(100, 0, INF),
        104 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        105 => new \Phplrt\Grammar\Concatenation([108, 'SettingNote', 109]),
        106 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        107 => new \Phplrt\Grammar\Optional(105),
        108 => new \Phplrt\Grammar\Lexeme('T_LBRACK', false),
        109 => new \Phplrt\Grammar\Lexeme('T_RBRACK', false),
        110 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        111 => new \Phplrt\Grammar\Concatenation([110, 'String']),
        112 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        113 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        114 => new \Phplrt\Grammar\Concatenation([112, 0, 'String', 113, 0]),
        115 => new \Phplrt\Grammar\Lexeme('T_NOTE', false),
        116 => new \Phplrt\Grammar\Alternation([111, 114]),
        117 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        118 => new \Phplrt\Grammar\Lexeme('T_SETTING_NOTE', false),
        119 => new \Phplrt\Grammar\Optional(117),
        120 => new \Phplrt\Grammar\Lexeme('T_BOOL_TRUE', true),
        121 => new \Phplrt\Grammar\Lexeme('T_BOOL_FALSE', true),
        122 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        123 => new \Phplrt\Grammar\Lexeme('T_QUOTED_STRING', true),
        124 => new \Phplrt\Grammar\Lexeme('T_EOL', false),
        0 => new \Phplrt\Grammar\Repetition(124, 0, INF)
    ],
    'reducers' => [
        'Schema' => function (\Phplrt\Parser\Context $ctx, $children) {
            return new \Butschster\Dbml\Ast\SchemaNode($children);
        },
        'Project' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\ProjectNode(
            $token->getOffset(), $children
        );
        },
        'ProjectName' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Project\NameNode(
            $token->getOffset(), \end($children)
        );
        },
        'ProjectSetting' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Project\SettingNode(
            $token->getOffset(), \current($children), \end($children)
        );
        },
        'ProjectSettingKey' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Project\SettingKeyNode(
            $token->getOffset(), $children->getValue()
        );
        },
        'Table' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\TableNode(
            $token->getOffset(), $children[0]->getValue(), $children
        );
        },
        'TableName' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\NameNode(
            $token->getOffset(), $children->getValue()
        );
        },
        'TableAlias' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\AliasNode(
           $token->getOffset(), $children[0]->getValue()
       );
        },
        'TableColumn' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\ColumnNode(
            $token->getOffset(), $children[0], $children[1], $children[2] ?? null
        );
        },
        'TableColumnName' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\NameNode(
            $token->getOffset(), $children->getValue()
        );
        },
        'TableColumnType' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\TypeNode(
            $token->getOffset(), $children[0], $children[1] ?? null
        );
        },
        'TableColumnTypeName' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\NameNode(
            $token->getOffset(), $children->getValue()
        );
        },
        'TableColumnSettings' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\SettingsNode(
            $token->getOffset(), $children
        );
        },
        27 => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Table\Column\SettingNode($state, $children, $offset);
        },
        'TableIndex' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Table\IndexNode($state, $children, $offset);
        },
        'TableIndexSingleField' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Table\Index\SingleFieldNode($state, $children, $offset);
        },
        'TableIndexCompositeField' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Table\Index\CompositeFieldNode($state, $children, $offset);
        },
        'TableIndexSettings' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Table\Index\SettingsNode($state, $children, $offset);
        },
        'TableIndexSetting' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Table\Index\SettingNode($state, $children, $offset);
        },
        'TableIndexSettingWithValue' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Table\Index\SettingWithValueNode($state, $children, $offset);
        },
        'Ref' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\RefNode($state, $children, $offset);
        },
        'TableColumnRef' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Table\Column\RefNode($state, $children, $offset);
        },
        'RefType' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Ref\TypeNode($state, $children, $offset);
        },
        'RefLeftColumn' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Ref\ColumnNode($state, $children, $offset);
        },
        'RefRightColumn' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Ref\ColumnNode($state, $children, $offset);
        },
        'TableGroup' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\TableGroupNode($state, $children, $offset);
        },
        'Enum' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\EnumNode($state, $children, $offset);
        },
        'EnumName' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Enum\NameNode($state, $children, $offset);
        },
        'EnumValue' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Enum\ValueNode($state, $children, $offset);
        },
        'Note' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\NoteNode(
            $token->getOffset(), \end($children)
        );
        },
        'SettingNote' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\NoteSettingNode($state, $children, $offset);
        },
        'Expression' => function (\Phplrt\Parser\Context $ctx, $children) {
            $state = $ctx->getState();
            $token = $ctx->getToken();
            $offset = $token->getOffset();
            return new \Butschster\Dbml\Ast\Values\ExpressionNode($state, $children, $offset);
        },
        'Boolean' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Values\BooleanNode(
            $token->getOffset(),
            $children->getName() === 'T_BOOL_TRUE'
        );
        },
        'Null' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Values\NullNode($token->getOffset());
        },
        'Float' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Values\FloatNode(
            $token->getOffset(), $children->getValue()
        );
        },
        'Int' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Values\IntNode(
           $token->getOffset(), $children->getValue()
       );
        },
        'String' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Values\StringNode(
            $token->getOffset(),
            $children
        );
        }
    ]
];