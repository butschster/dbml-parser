<?php
return [
    'initial' => 'Document',
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
            'T_TABLE_SETTING_PK' => '(?<=\\b)(primary\\ske|pk)\\b',
            'T_TABLE_SETTING_UNIQUE' => '(?<=\\b)unique\\b',
            'T_TABLE_SETTING_INCREMENT' => '(?<=\\b)increment\\b',
            'T_TABLE_SETTING_DEFAULT' => '(?<=\\b)default\\b',
            'T_TABLE_SETTING_NULL' => '(?<=\\b)null\\b',
            'T_TABLE_SETTING_NOT_NULL' => '(?<=\\b)not\\snull\\b',
            'T_SETTING_NOTE' => 'note:',
            'T_NOTE' => '(?<=\\b)Note\\b',
            'T_FLOAT' => '[0-9]+\\.[0-9]+',
            'T_INT' => '[0-9]+',
            'T_QUOTED_STRING' => '(\'{3}|["\']{1})([^\'"][\\s\\S]*?)\\1',
            'T_EXPRESSION' => '(`{1})([\\s\\S]+?)\\1',
            'T_WORD' => '[a-zA-Z0-9_]+',
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
        'Boolean' => new \Phplrt\Grammar\Alternation([125, 126]),
        'Document' => new \Phplrt\Grammar\Concatenation(['Schema']),
        'Enum' => new \Phplrt\Grammar\Concatenation([106, 'EnumName', 107, 0, 108, 109, 0]),
        'EnumName' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'EnumValue' => new \Phplrt\Grammar\Concatenation([111, 112]),
        'Expression' => new \Phplrt\Grammar\Lexeme('T_EXPRESSION', true),
        'Float' => new \Phplrt\Grammar\Lexeme('T_FLOAT', true),
        'Int' => new \Phplrt\Grammar\Lexeme('T_INT', true),
        'Note' => new \Phplrt\Grammar\Concatenation([120, 121]),
        'Null' => new \Phplrt\Grammar\Lexeme('T_NULL', true),
        'Project' => new \Phplrt\Grammar\Concatenation([5, 'ProjectName', 6, 0, 7, 8, 0]),
        'ProjectName' => new \Phplrt\Grammar\Concatenation(['String']),
        'ProjectSetting' => new \Phplrt\Grammar\Concatenation(['ProjectSettingKey', 9, 'String', 0]),
        'ProjectSettingKey' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'Ref' => new \Phplrt\Grammar\Concatenation([75, 76]),
        'RefCompositeTableColumn' => new \Phplrt\Grammar\Concatenation([95, 96, 97]),
        'RefLeftColumn' => new \Phplrt\Grammar\Concatenation([91]),
        'RefRightColumn' => new \Phplrt\Grammar\Concatenation([91]),
        'RefType' => new \Phplrt\Grammar\Alternation([88, 89, 90]),
        'Schema' => new \Phplrt\Grammar\Repetition(2, 0, INF),
        'SettingNote' => new \Phplrt\Grammar\Concatenation([123, 'String', 124]),
        'String' => new \Phplrt\Grammar\Alternation([127, 128]),
        'Table' => new \Phplrt\Grammar\Concatenation([13, 'TableName', 14, 15, 0, 16, 17, 18, 19, 0]),
        'TableAlias' => new \Phplrt\Grammar\Concatenation([22, 23]),
        'TableColumn' => new \Phplrt\Grammar\Concatenation(['TableColumnName', 'TableColumnType', 25]),
        'TableColumnName' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'TableColumnRef' => new \Phplrt\Grammar\Concatenation([78, 79, 'RefType', 'RefRightColumn', 80]),
        'TableColumnType' => new \Phplrt\Grammar\Concatenation(['TableColumnTypeName', 26]),
        'TableColumnTypeName' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'TableColumnTypeSize' => new \Phplrt\Grammar\Concatenation([27, 'Int', 28]),
        'TableGroup' => new \Phplrt\Grammar\Concatenation([101, 'TableGroupName', 102, 0, 103, 104, 0]),
        'TableGroupName' => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        'TableIndex' => new \Phplrt\Grammar\Concatenation([53, 54]),
        'TableIndexCompositeField' => new \Phplrt\Grammar\Concatenation([59, 60, 61]),
        'TableIndexSetting' => new \Phplrt\Grammar\Concatenation([66, 68]),
        'TableIndexSettingWithValue' => new \Phplrt\Grammar\Concatenation([70, 71, 'String', 72]),
        'TableIndexSettings' => new \Phplrt\Grammar\Concatenation([63, 64, 65]),
        'TableIndexSingleField' => new \Phplrt\Grammar\Alternation(['String', 'Expression']),
        'TableLongRefColumn' => new \Phplrt\Grammar\Concatenation([81]),
        'TableName' => new \Phplrt\Grammar\Alternation([20, 21]),
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
        12 => new \Phplrt\Grammar\Concatenation([49, 50, 0, 51, 52]),
        13 => new \Phplrt\Grammar\Lexeme('T_TABLE', false),
        14 => new \Phplrt\Grammar\Optional('TableAlias'),
        15 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        16 => new \Phplrt\Grammar\Repetition(10, 0, INF),
        17 => new \Phplrt\Grammar\Optional(11),
        18 => new \Phplrt\Grammar\Optional(12),
        19 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        20 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        21 => new \Phplrt\Grammar\Lexeme('T_INT', true),
        22 => new \Phplrt\Grammar\Lexeme('T_TABLE_ALIAS', false),
        23 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        24 => new \Phplrt\Grammar\Concatenation([32, 33, 34]),
        25 => new \Phplrt\Grammar\Optional(24),
        26 => new \Phplrt\Grammar\Optional('TableColumnTypeSize'),
        27 => new \Phplrt\Grammar\Lexeme('T_LPAREN', false),
        28 => new \Phplrt\Grammar\Lexeme('T_RPAREN', false),
        29 => new \Phplrt\Grammar\Concatenation([43, 45, 46, 47]),
        30 => new \Phplrt\Grammar\Concatenation([35, 37]),
        31 => new \Phplrt\Grammar\Alternation(['SettingNote', 'TableColumnRef', 29, 30]),
        32 => new \Phplrt\Grammar\Lexeme('T_LBRACK', false),
        33 => new \Phplrt\Grammar\Repetition(31, 0, INF),
        34 => new \Phplrt\Grammar\Lexeme('T_RBRACK', false),
        35 => new \Phplrt\Grammar\Alternation([38, 39, 40, 41, 42]),
        36 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        37 => new \Phplrt\Grammar\Optional(36),
        38 => new \Phplrt\Grammar\Lexeme('T_TABLE_SETTING_PK', true),
        39 => new \Phplrt\Grammar\Lexeme('T_TABLE_SETTING_UNIQUE', true),
        40 => new \Phplrt\Grammar\Lexeme('T_TABLE_SETTING_INCREMENT', true),
        41 => new \Phplrt\Grammar\Lexeme('T_TABLE_SETTING_NULL', true),
        42 => new \Phplrt\Grammar\Lexeme('T_TABLE_SETTING_NOT_NULL', true),
        43 => new \Phplrt\Grammar\Lexeme('T_TABLE_SETTING_DEFAULT', true),
        44 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        45 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        46 => new \Phplrt\Grammar\Alternation(['Expression', 'Float', 'Int', 'Boolean', 'Null', 'String']),
        47 => new \Phplrt\Grammar\Optional(44),
        48 => new \Phplrt\Grammar\Concatenation(['TableIndex', 0]),
        49 => new \Phplrt\Grammar\Lexeme('T_TABLE_INDEXES', false),
        50 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        51 => new \Phplrt\Grammar\Repetition(48, 0, INF),
        52 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        53 => new \Phplrt\Grammar\Alternation(['TableIndexCompositeField', 'TableIndexSingleField']),
        54 => new \Phplrt\Grammar\Optional('TableIndexSettings'),
        55 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        56 => new \Phplrt\Grammar\Alternation(['String', 'Expression']),
        57 => new \Phplrt\Grammar\Optional(55),
        58 => new \Phplrt\Grammar\Concatenation([56, 57]),
        59 => new \Phplrt\Grammar\Lexeme('T_LPAREN', false),
        60 => new \Phplrt\Grammar\Repetition(58, 0, INF),
        61 => new \Phplrt\Grammar\Lexeme('T_RPAREN', false),
        62 => new \Phplrt\Grammar\Alternation(['SettingNote', 'TableIndexSettingWithValue', 'TableIndexSetting']),
        63 => new \Phplrt\Grammar\Lexeme('T_LBRACK', false),
        64 => new \Phplrt\Grammar\Repetition(62, 0, INF),
        65 => new \Phplrt\Grammar\Lexeme('T_RBRACK', false),
        66 => new \Phplrt\Grammar\Alternation([38, 39]),
        67 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        68 => new \Phplrt\Grammar\Optional(67),
        69 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        70 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        71 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        72 => new \Phplrt\Grammar\Optional(69),
        73 => new \Phplrt\Grammar\Concatenation([82, 83, 81]),
        74 => new \Phplrt\Grammar\Concatenation([84, 85, 0, 86, 87, 0]),
        75 => new \Phplrt\Grammar\Lexeme('T_TABLE_REF', false),
        76 => new \Phplrt\Grammar\Alternation([73, 74]),
        77 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        78 => new \Phplrt\Grammar\Lexeme('T_TABLE_REF', false),
        79 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        80 => new \Phplrt\Grammar\Optional(77),
        81 => new \Phplrt\Grammar\Concatenation(['RefLeftColumn', 'RefType', 'RefRightColumn']),
        82 => new \Phplrt\Grammar\Optional('TableRefName'),
        83 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        84 => new \Phplrt\Grammar\Optional('TableRefName'),
        85 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        86 => new \Phplrt\Grammar\Repetition('TableLongRefColumn', 0, INF),
        87 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        88 => new \Phplrt\Grammar\Lexeme('T_GT', true),
        89 => new \Phplrt\Grammar\Lexeme('T_LT', true),
        90 => new \Phplrt\Grammar\Lexeme('T_MINUS', true),
        91 => new \Phplrt\Grammar\Concatenation(['TableName', 98, 99]),
        92 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        93 => new \Phplrt\Grammar\Optional(92),
        94 => new \Phplrt\Grammar\Concatenation(['TableColumnName', 93]),
        95 => new \Phplrt\Grammar\Lexeme('T_LPAREN', false),
        96 => new \Phplrt\Grammar\Repetition(94, 0, INF),
        97 => new \Phplrt\Grammar\Lexeme('T_RPAREN', false),
        98 => new \Phplrt\Grammar\Lexeme('T_DOT', false),
        99 => new \Phplrt\Grammar\Alternation(['TableColumnName', 'RefCompositeTableColumn']),
        100 => new \Phplrt\Grammar\Concatenation(['TableName', 0]),
        101 => new \Phplrt\Grammar\Lexeme('T_TABLE_GROUP', false),
        102 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        103 => new \Phplrt\Grammar\Repetition(100, 0, INF),
        104 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        105 => new \Phplrt\Grammar\Concatenation(['EnumValue', 0]),
        106 => new \Phplrt\Grammar\Lexeme('T_ENUM', false),
        107 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        108 => new \Phplrt\Grammar\Repetition(105, 0, INF),
        109 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        110 => new \Phplrt\Grammar\Concatenation([113, 'SettingNote', 114]),
        111 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        112 => new \Phplrt\Grammar\Optional(110),
        113 => new \Phplrt\Grammar\Lexeme('T_LBRACK', false),
        114 => new \Phplrt\Grammar\Lexeme('T_RBRACK', false),
        115 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        116 => new \Phplrt\Grammar\Concatenation([115, 'String']),
        117 => new \Phplrt\Grammar\Lexeme('T_LBRACE', false),
        118 => new \Phplrt\Grammar\Lexeme('T_RBRACE', false),
        119 => new \Phplrt\Grammar\Concatenation([117, 0, 'String', 118, 0]),
        120 => new \Phplrt\Grammar\Lexeme('T_NOTE', false),
        121 => new \Phplrt\Grammar\Alternation([116, 119]),
        122 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        123 => new \Phplrt\Grammar\Lexeme('T_SETTING_NOTE', false),
        124 => new \Phplrt\Grammar\Optional(122),
        125 => new \Phplrt\Grammar\Lexeme('T_BOOL_TRUE', true),
        126 => new \Phplrt\Grammar\Lexeme('T_BOOL_FALSE', true),
        127 => new \Phplrt\Grammar\Lexeme('T_WORD', true),
        128 => new \Phplrt\Grammar\Lexeme('T_QUOTED_STRING', true),
        129 => new \Phplrt\Grammar\Lexeme('T_EOL', false),
        0 => new \Phplrt\Grammar\Repetition(129, 0, INF)
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
            $token->getOffset(), $children[0], $children[1], array_slice($children, 2)
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
        41 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\NullNode(
          $token->getOffset()
      );
        },
        42 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\NotNullNode(
          $token->getOffset()
      );
        },
        40 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\IncrementNode(
          $token->getOffset()
      );
        },
        38 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\PrimaryKeyNode(
          $token->getOffset()
      );
        },
        39 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\UniqueNode(
          $token->getOffset()
      );
        },
        29 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\SettingWithValueNode(
            $token->getOffset(), $children[0]->getValue(), $children[1]
        );
        },
        'TableIndex' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\IndexNode(
            $token->getOffset(), $children[0], array_slice($children, 1)
        );
        },
        'TableIndexSingleField' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Index\FieldsNode(
          $token->getOffset(), [$children]
        );
        },
        'TableIndexCompositeField' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Index\FieldsNode(
           $token->getOffset(), $children
        );
        },
        'TableIndexSettingWithValue' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\SettingWithValueNode(
            $token->getOffset(), $children[0]->getValue(), $children[1]
        );
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
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\NoteNode(
            $token->getOffset(), \end($children)
        );
        },
        'Expression' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Values\ExpressionNode(
           $token->getOffset(), $children->getValue()
       );
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