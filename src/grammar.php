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
            'T_PROJECT' => '(?<=\\b)Project|project\\b',
            'T_TABLE' => '(?<=\\b)Table|table\\b',
            'T_TABLE_ALIAS' => '(?<=\\b)as\\b',
            'T_TABLE_INDEXES' => '(?<=\\b)(Indexes|indexes)\\b',
            'T_TABLE_REF' => '(Ref:|ref:)',
            'T_TABLE_GROUP' => '(?<=\\b)TableGroup\\b',
            'T_ENUM' => '(?<=\\b)(Enum|enum)\\b',
            'T_TABLE_SETTING_PK' => '(?<=\\b)(primary\\skey|pk)\\b',
            'T_TABLE_SETTING_UNIQUE' => '(?<=\\b)unique\\b',
            'T_TABLE_SETTING_INCREMENT' => '(?<=\\b)increment\\b',
            'T_TABLE_SETTING_DEFAULT' => '(?<=\\b)default\\b',
            'T_TABLE_SETTING_NOT_NULL' => '(?<=\\b)not\\snull\\b',
            'T_REF_ACTION_CASCADE' => '(?<=\\b)cascade\\b',
            'T_REF_ACTION_RESTRICT' => '(?<=\\b)restrict\\b',
            'T_REF_ACTION_SET_NULL' => '(?<=\\b)set\\snull\\b',
            'T_REF_ACTION_SET_DEFAULT' => '(?<=\\b)set\\default\\b',
            'T_REF_ACTION_NO_ACTION' => '(?<=\\b)no\\saction\\b',
            'T_REF_ACTION_DELETE' => '(?<=\\b)delete\\b',
            'T_REF_ACTION_UPDATE' => '(?<=\\b)update\\b',
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
        'Boolean' => new \Phplrt\Parser\Grammar\Alternation([152, 153]),
        'Document' => new \Phplrt\Parser\Grammar\Concatenation(['Schema']),
        'Enum' => new \Phplrt\Parser\Grammar\Concatenation([131, 'EnumName', 132, 0, 133, 134, 0]),
        'EnumName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'EnumValue' => new \Phplrt\Parser\Grammar\Alternation([135, 139]),
        'Expression' => new \Phplrt\Parser\Grammar\Lexeme('T_EXPRESSION', true),
        'Float' => new \Phplrt\Parser\Grammar\Lexeme('T_FLOAT', true),
        'Int' => new \Phplrt\Parser\Grammar\Lexeme('T_INT', true),
        'Note' => new \Phplrt\Parser\Grammar\Concatenation([147, 148]),
        'Null' => new \Phplrt\Parser\Grammar\Lexeme('T_NULL', true),
        'Project' => new \Phplrt\Parser\Grammar\Concatenation([5, 'ProjectName', 6, 0, 7, 8, 0]),
        'ProjectName' => new \Phplrt\Parser\Grammar\Concatenation(['String']),
        'ProjectSetting' => new \Phplrt\Parser\Grammar\Concatenation(['ProjectSettingKey', 9, 'String', 0]),
        'ProjectSettingKey' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'Ref' => new \Phplrt\Parser\Grammar\Concatenation([76, 77]),
        'RefLeftTable' => new \Phplrt\Parser\Grammar\Concatenation(['TableName', 115, 116]),
        'RefName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'RefRightTable' => new \Phplrt\Parser\Grammar\Concatenation(['TableName', 117, 118]),
        'Schema' => new \Phplrt\Parser\Grammar\Repetition(2, 0, INF),
        'SettingNote' => new \Phplrt\Parser\Grammar\Concatenation([150, 'String', 151]),
        'String' => new \Phplrt\Parser\Grammar\Alternation([154, 155]),
        'Table' => new \Phplrt\Parser\Grammar\Concatenation([14, 'TableName', 15, 16, 0, 17, 18, 19, 20, 0]),
        'TableAlias' => new \Phplrt\Parser\Grammar\Concatenation([23, 24]),
        'TableColumn' => new \Phplrt\Parser\Grammar\Concatenation(['TableColumnName', 'TableColumnType', 26]),
        'TableColumnName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'TableColumnRef' => new \Phplrt\Parser\Grammar\Concatenation([80, 78, 81]),
        'TableColumnType' => new \Phplrt\Parser\Grammar\Concatenation(['TableColumnTypeName', 27]),
        'TableColumnTypeName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'TableColumnTypeSize' => new \Phplrt\Parser\Grammar\Concatenation([28, 'Int', 29]),
        'TableGroup' => new \Phplrt\Parser\Grammar\Concatenation([126, 'TableGroupName', 127, 0, 128, 129, 0]),
        'TableGroupName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'TableIndex' => new \Phplrt\Parser\Grammar\Concatenation([54, 55]),
        'TableIndexCompositeField' => new \Phplrt\Parser\Grammar\Concatenation([60, 61, 62]),
        'TableIndexSetting' => new \Phplrt\Parser\Grammar\Concatenation([67, 69]),
        'TableIndexSettingWithValue' => new \Phplrt\Parser\Grammar\Concatenation([71, 72, 'String', 73]),
        'TableIndexSettings' => new \Phplrt\Parser\Grammar\Concatenation([64, 65, 66]),
        'TableIndexSingleField' => new \Phplrt\Parser\Grammar\Alternation(['String', 'Expression']),
        'TableName' => new \Phplrt\Parser\Grammar\Alternation([21, 22]),
        1 => new \Phplrt\Parser\Grammar\Concatenation(['Ref', 0]),
        2 => new \Phplrt\Parser\Grammar\Alternation(['Project', 'Table', 'TableGroup', 'Enum', 1]),
        3 => new \Phplrt\Parser\Grammar\Concatenation(['Note', 0]),
        4 => new \Phplrt\Parser\Grammar\Alternation([3, 'ProjectSetting']),
        5 => new \Phplrt\Parser\Grammar\Lexeme('T_PROJECT', false),
        6 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        7 => new \Phplrt\Parser\Grammar\Repetition(4, 0, INF),
        8 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        9 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        10 => new \Phplrt\Parser\Grammar\Concatenation(['TableColumn', 0]),
        11 => new \Phplrt\Parser\Grammar\Concatenation(['SettingNote', 0]),
        12 => new \Phplrt\Parser\Grammar\Alternation(['Note', 11]),
        13 => new \Phplrt\Parser\Grammar\Concatenation([50, 51, 0, 52, 53]),
        14 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE', false),
        15 => new \Phplrt\Parser\Grammar\Optional('TableAlias'),
        16 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        17 => new \Phplrt\Parser\Grammar\Repetition(10, 0, INF),
        18 => new \Phplrt\Parser\Grammar\Optional(12),
        19 => new \Phplrt\Parser\Grammar\Optional(13),
        20 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        21 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        22 => new \Phplrt\Parser\Grammar\Lexeme('T_INT', true),
        23 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_ALIAS', false),
        24 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        25 => new \Phplrt\Parser\Grammar\Concatenation([33, 34, 35]),
        26 => new \Phplrt\Parser\Grammar\Optional(25),
        27 => new \Phplrt\Parser\Grammar\Optional('TableColumnTypeSize'),
        28 => new \Phplrt\Parser\Grammar\Lexeme('T_LPAREN', false),
        29 => new \Phplrt\Parser\Grammar\Lexeme('T_RPAREN', false),
        30 => new \Phplrt\Parser\Grammar\Concatenation([44, 46, 47, 48]),
        31 => new \Phplrt\Parser\Grammar\Concatenation([36, 38]),
        32 => new \Phplrt\Parser\Grammar\Alternation(['SettingNote', 'TableColumnRef', 30, 31]),
        33 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        34 => new \Phplrt\Parser\Grammar\Repetition(32, 0, INF),
        35 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        36 => new \Phplrt\Parser\Grammar\Alternation([39, 40, 41, 42, 43]),
        37 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        38 => new \Phplrt\Parser\Grammar\Optional(37),
        39 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_PK', true),
        40 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_UNIQUE', true),
        41 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_INCREMENT', true),
        42 => new \Phplrt\Parser\Grammar\Lexeme('T_NULL', true),
        43 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_NOT_NULL', true),
        44 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_DEFAULT', true),
        45 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        46 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        47 => new \Phplrt\Parser\Grammar\Alternation(['Expression', 'Float', 'Int', 'Boolean', 'Null', 'String']),
        48 => new \Phplrt\Parser\Grammar\Optional(45),
        49 => new \Phplrt\Parser\Grammar\Concatenation(['TableIndex', 0]),
        50 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_INDEXES', false),
        51 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        52 => new \Phplrt\Parser\Grammar\Repetition(49, 0, INF),
        53 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        54 => new \Phplrt\Parser\Grammar\Alternation(['TableIndexCompositeField', 'TableIndexSingleField']),
        55 => new \Phplrt\Parser\Grammar\Optional('TableIndexSettings'),
        56 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        57 => new \Phplrt\Parser\Grammar\Alternation(['String', 'Expression']),
        58 => new \Phplrt\Parser\Grammar\Optional(56),
        59 => new \Phplrt\Parser\Grammar\Concatenation([57, 58]),
        60 => new \Phplrt\Parser\Grammar\Lexeme('T_LPAREN', false),
        61 => new \Phplrt\Parser\Grammar\Repetition(59, 0, INF),
        62 => new \Phplrt\Parser\Grammar\Lexeme('T_RPAREN', false),
        63 => new \Phplrt\Parser\Grammar\Alternation(['SettingNote', 'TableIndexSettingWithValue', 'TableIndexSetting']),
        64 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        65 => new \Phplrt\Parser\Grammar\Repetition(63, 0, INF),
        66 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        67 => new \Phplrt\Parser\Grammar\Alternation([39, 40]),
        68 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        69 => new \Phplrt\Parser\Grammar\Optional(68),
        70 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        71 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        72 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        73 => new \Phplrt\Parser\Grammar\Optional(70),
        74 => new \Phplrt\Parser\Grammar\Concatenation([84, 85, 83]),
        75 => new \Phplrt\Parser\Grammar\Concatenation([86, 87, 0, 88, 89, 0]),
        76 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_REF', false),
        77 => new \Phplrt\Parser\Grammar\Alternation([74, 75]),
        78 => new \Phplrt\Parser\Grammar\Concatenation([82, 'RefRightTable']),
        79 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        80 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_REF', false),
        81 => new \Phplrt\Parser\Grammar\Optional(79),
        82 => new \Phplrt\Parser\Grammar\Alternation([92, 93, 94]),
        83 => new \Phplrt\Parser\Grammar\Concatenation(['RefLeftTable', 82, 'RefRightTable', 91]),
        84 => new \Phplrt\Parser\Grammar\Optional('RefName'),
        85 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        86 => new \Phplrt\Parser\Grammar\Optional('RefName'),
        87 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        88 => new \Phplrt\Parser\Grammar\Repetition(83, 0, INF),
        89 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        90 => new \Phplrt\Parser\Grammar\Concatenation([98, 99, 100]),
        91 => new \Phplrt\Parser\Grammar\Optional(90),
        92 => new \Phplrt\Parser\Grammar\Lexeme('T_GT', true),
        93 => new \Phplrt\Parser\Grammar\Lexeme('T_LT', true),
        94 => new \Phplrt\Parser\Grammar\Lexeme('T_MINUS', true),
        95 => new \Phplrt\Parser\Grammar\Concatenation([102, 103, 101]),
        96 => new \Phplrt\Parser\Grammar\Concatenation([104, 105, 101]),
        97 => new \Phplrt\Parser\Grammar\Alternation([95, 96]),
        98 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        99 => new \Phplrt\Parser\Grammar\Repetition(97, 0, INF),
        100 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        101 => new \Phplrt\Parser\Grammar\Concatenation([112, 113]),
        102 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_UPDATE', true),
        103 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        104 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_DELETE', true),
        105 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        106 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_CASCADE', true),
        107 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_RESTRICT', true),
        108 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_SET_NULL', true),
        109 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_SET_DEFAULT', true),
        110 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_NO_ACTION', true),
        111 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        112 => new \Phplrt\Parser\Grammar\Alternation([106, 107, 108, 109, 110]),
        113 => new \Phplrt\Parser\Grammar\Optional(111),
        114 => new \Phplrt\Parser\Grammar\Concatenation([122, 123, 124]),
        115 => new \Phplrt\Parser\Grammar\Lexeme('T_DOT', false),
        116 => new \Phplrt\Parser\Grammar\Alternation(['TableColumnName', 114]),
        117 => new \Phplrt\Parser\Grammar\Lexeme('T_DOT', false),
        118 => new \Phplrt\Parser\Grammar\Alternation(['TableColumnName', 114]),
        119 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        120 => new \Phplrt\Parser\Grammar\Optional(119),
        121 => new \Phplrt\Parser\Grammar\Concatenation(['TableColumnName', 120]),
        122 => new \Phplrt\Parser\Grammar\Lexeme('T_LPAREN', false),
        123 => new \Phplrt\Parser\Grammar\Repetition(121, 0, INF),
        124 => new \Phplrt\Parser\Grammar\Lexeme('T_RPAREN', false),
        125 => new \Phplrt\Parser\Grammar\Concatenation(['TableName', 0]),
        126 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_GROUP', false),
        127 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        128 => new \Phplrt\Parser\Grammar\Repetition(125, 0, INF),
        129 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        130 => new \Phplrt\Parser\Grammar\Concatenation(['EnumValue', 0]),
        131 => new \Phplrt\Parser\Grammar\Lexeme('T_ENUM', false),
        132 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        133 => new \Phplrt\Parser\Grammar\Repetition(130, 0, INF),
        134 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        135 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        136 => new \Phplrt\Parser\Grammar\Concatenation([140, 'SettingNote', 141]),
        137 => new \Phplrt\Parser\Grammar\Lexeme('T_QUOTED_STRING', true),
        138 => new \Phplrt\Parser\Grammar\Optional(136),
        139 => new \Phplrt\Parser\Grammar\Concatenation([137, 138]),
        140 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        141 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        142 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        143 => new \Phplrt\Parser\Grammar\Concatenation([142, 'String']),
        144 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        145 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        146 => new \Phplrt\Parser\Grammar\Concatenation([144, 0, 'String', 145, 0]),
        147 => new \Phplrt\Parser\Grammar\Lexeme('T_NOTE', false),
        148 => new \Phplrt\Parser\Grammar\Alternation([143, 146]),
        149 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        150 => new \Phplrt\Parser\Grammar\Lexeme('T_SETTING_NOTE', false),
        151 => new \Phplrt\Parser\Grammar\Optional(149),
        152 => new \Phplrt\Parser\Grammar\Lexeme('T_BOOL_TRUE', true),
        153 => new \Phplrt\Parser\Grammar\Lexeme('T_BOOL_FALSE', true),
        154 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        155 => new \Phplrt\Parser\Grammar\Lexeme('T_QUOTED_STRING', true),
        156 => new \Phplrt\Parser\Grammar\Lexeme('T_EOL', false),
        0 => new \Phplrt\Parser\Grammar\Repetition(156, 0, INF)
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
            return new \Butschster\Dbml\Ast\Table\Column\NameNode(
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
        42 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\NullNode(
                $token->getOffset()
            );
        },
        43 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\NotNullNode(
                $token->getOffset()
            );
        },
        41 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\IncrementNode(
                $token->getOffset()
            );
        },
        39 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\PrimaryKeyNode(
                $token->getOffset()
            );
        },
        40 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Table\Column\Setting\UniqueNode(
                $token->getOffset()
            );
        },
        30 => function (\Phplrt\Parser\Context $ctx, $children) {
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
        'TableColumnRef' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\RefNode(
                $token->getOffset(), $children
            );
        },
        78 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\ColumnsNode(
                $token->getOffset(), $children
            );
        },
        'RefName' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\NameNode(
                $token->getOffset(), $children->getValue()
            );
        },
        74 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\RefNode(
                $token->getOffset(), $children
            );
        },
        75 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\GroupNode(
                $token->getOffset(), $children
            );
        },
        83 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\ColumnsNode(
                $token->getOffset(), $children
            );
        },
        95 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Action\OnUpdateNode(
                $token->getOffset(), $children[1]->getValue()
            );
        },
        96 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Action\OnDeleteNode(
                $token->getOffset(), $children[1]->getValue()
            );
        },
        92 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Type\ManyToOneNode(
                $token->getOffset()
            );
        },
        94 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Type\OneToOneNode(
                $token->getOffset()
            );
        },
        93 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Type\OneToManyNode(
                $token->getOffset()
            );
        },
        'RefLeftTable' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\LeftTableNode(
                $token->getOffset(), $children[0], array_slice($children, 1)
            );
        },
        'RefRightTable' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\RightTableNode(
                $token->getOffset(), $children[0], array_slice($children, 1)
            );
        },
        'TableGroup' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\TableGroupNode(
                $token->getOffset(), $children[0]->getValue(), array_slice($children, 1)
            );
        },
        'Enum' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\EnumNode(
                $token->getOffset(), $children[0]->getValue(), array_slice($children, 1)
            );
        },
        'EnumValue' => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            if ($token->getName() == "T_WORD") {
                return new \Butschster\Dbml\Ast\Enum\ValueNode(
                    $token->getOffset(), $children[0]->getValue(), $children[1] ?? null
                );
            }

            //is T_QUOTED_STRING
            return new \Butschster\Dbml\Ast\Enum\ValueNode(
                $token->getOffset(), $children[0][1]->getValue(), $children[1] ?? null
            );
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
