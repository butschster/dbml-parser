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
            'T_PROJECT' => '(?<=\\b)(?i)(Project)(?-i)\\b',
            'T_TABLE' => '(?<=\\b)(?i)(Table)(?-i)\\b',
            'T_TABLE_ALIAS' => '(?<=\\b)(?i)as(?-i)\\b',
            'T_TABLE_INDEXES' => '(?<=\\b)(?i)(Indexes)(?-i)\\b',
            'T_TABLE_REF' => '(?<=\\b)(?i)(Ref)(?-i)\\b',
            'T_TABLE_GROUP' => '(?<=\\b)(?i)(TableGroup)(?-i)\\b',
            'T_ENUM' => '(?<=\\b)(?i)(Enum)\\b',
            'T_TABLE_SETTING_PK' => '(?<=\\b)(?i)(primary\\skey|pk)(?-i)\\b',
            'T_TABLE_SETTING_UNIQUE' => '(?<=\\b)(?i)(unique)(?-i)\\b',
            'T_TABLE_SETTING_INCREMENT' => '(?<=\\b)(?i)increment(?-i)\\b',
            'T_TABLE_SETTING_DEFAULT' => '(?<=\\b)(?i)default(?-i)\\b',
            'T_TABLE_SETTING_NOT_NULL' => '(?<=\\b)(?i)not\\snull(?-i)\\b',
            'T_REF_ACTION_CASCADE' => '(?<=\\b)(?i)cascade(?-i)\\b',
            'T_REF_ACTION_RESTRICT' => '(?<=\\b)(?i)restrict(?-i)\\b',
            'T_REF_ACTION_SET_NULL' => '(?<=\\b)(?i)set\\snull(?-i)\\b',
            'T_REF_ACTION_SET_DEFAULT' => '(?<=\\b)(?i)set\\default(?-i)\\b',
            'T_REF_ACTION_NO_ACTION' => '(?<=\\b)(?i)no\\saction(?-i)\\b',
            'T_REF_ACTION_DELETE' => '(?<=\\b)(?i)delete(?-i)\\b',
            'T_REF_ACTION_UPDATE' => '(?<=\\b)(?i)update(?-i)\\b',
            'T_SETTING_NOTE' => '(?i)note(?-i):',
            'T_NOTE' => '(?<=\\b)(?i)Note(?-i)\\b',
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
            'T_LTGT' => '\\<\\>',
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
        'Boolean' => new \Phplrt\Parser\Grammar\Alternation([155, 156]),
        'Document' => new \Phplrt\Parser\Grammar\Concatenation(['Schema']),
        'Enum' => new \Phplrt\Parser\Grammar\Concatenation([132, 'EnumName', 133, 0, 134, 135, 0]),
        'EnumName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'EnumValue' => new \Phplrt\Parser\Grammar\Alternation([139, 142]),
        'Expression' => new \Phplrt\Parser\Grammar\Lexeme('T_EXPRESSION', true),
        'Float' => new \Phplrt\Parser\Grammar\Lexeme('T_FLOAT', true),
        'Int' => new \Phplrt\Parser\Grammar\Lexeme('T_INT', true),
        'Note' => new \Phplrt\Parser\Grammar\Concatenation([150, 151]),
        'Null' => new \Phplrt\Parser\Grammar\Lexeme('T_NULL', true),
        'Project' => new \Phplrt\Parser\Grammar\Concatenation([5, 'ProjectName', 6, 0, 7, 8, 0]),
        'ProjectName' => new \Phplrt\Parser\Grammar\Concatenation(['String']),
        'ProjectSetting' => new \Phplrt\Parser\Grammar\Concatenation(['ProjectSettingKey', 9, 'String', 0]),
        'ProjectSettingKey' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'Ref' => new \Phplrt\Parser\Grammar\Concatenation([76, 77]),
        'RefLeftTable' => new \Phplrt\Parser\Grammar\Concatenation(['TableName', 116, 117]),
        'RefName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'RefRightTable' => new \Phplrt\Parser\Grammar\Concatenation(['TableName', 118, 119]),
        'Schema' => new \Phplrt\Parser\Grammar\Repetition(2, 0, INF),
        'SettingNote' => new \Phplrt\Parser\Grammar\Concatenation([153, 'String', 154]),
        'String' => new \Phplrt\Parser\Grammar\Alternation([157, 158]),
        'Table' => new \Phplrt\Parser\Grammar\Concatenation([14, 'TableName', 15, 16, 0, 17, 18, 19, 20, 0]),
        'TableAlias' => new \Phplrt\Parser\Grammar\Concatenation([23, 24]),
        'TableColumn' => new \Phplrt\Parser\Grammar\Concatenation(['TableColumnName', 'TableColumnType', 26]),
        'TableColumnName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'TableColumnRef' => new \Phplrt\Parser\Grammar\Concatenation([80, 81, 78, 82]),
        'TableColumnType' => new \Phplrt\Parser\Grammar\Concatenation(['TableColumnTypeName', 27]),
        'TableColumnTypeName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'TableColumnTypeSize' => new \Phplrt\Parser\Grammar\Concatenation([28, 'Int', 29]),
        'TableGroup' => new \Phplrt\Parser\Grammar\Concatenation([127, 'TableGroupName', 128, 0, 129, 130, 0]),
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
        74 => new \Phplrt\Parser\Grammar\Concatenation([85, 86, 84]),
        75 => new \Phplrt\Parser\Grammar\Concatenation([87, 88, 0, 89, 90, 0]),
        76 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_REF', false),
        77 => new \Phplrt\Parser\Grammar\Alternation([74, 75]),
        78 => new \Phplrt\Parser\Grammar\Concatenation([83, 'RefRightTable']),
        79 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        80 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_REF', false),
        81 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        82 => new \Phplrt\Parser\Grammar\Optional(79),
        83 => new \Phplrt\Parser\Grammar\Alternation([160, 93, 94, 95]),
        84 => new \Phplrt\Parser\Grammar\Concatenation(['RefLeftTable', 83, 'RefRightTable', 92]),
        85 => new \Phplrt\Parser\Grammar\Optional('RefName'),
        86 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        87 => new \Phplrt\Parser\Grammar\Optional('RefName'),
        88 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        89 => new \Phplrt\Parser\Grammar\Repetition(84, 0, INF),
        90 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        91 => new \Phplrt\Parser\Grammar\Concatenation([99, 100, 101]),
        92 => new \Phplrt\Parser\Grammar\Optional(91),
        93 => new \Phplrt\Parser\Grammar\Lexeme('T_GT', true),
        94 => new \Phplrt\Parser\Grammar\Lexeme('T_LT', true),
        95 => new \Phplrt\Parser\Grammar\Lexeme('T_MINUS', true),
        160 =>new \Phplrt\Parser\Grammar\Lexeme('T_LTGT', true),
        96 => new \Phplrt\Parser\Grammar\Concatenation([103, 104, 102]),
        97 => new \Phplrt\Parser\Grammar\Concatenation([105, 106, 102]),
        98 => new \Phplrt\Parser\Grammar\Alternation([96, 97]),
        99 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        100 => new \Phplrt\Parser\Grammar\Repetition(98, 0, INF),
        101 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        102 => new \Phplrt\Parser\Grammar\Concatenation([113, 114]),
        103 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_UPDATE', true),
        104 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        105 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_DELETE', true),
        106 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        107 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_CASCADE', true),
        108 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_RESTRICT', true),
        109 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_SET_NULL', true),
        110 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_SET_DEFAULT', true),
        111 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_NO_ACTION', true),
        112 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        113 => new \Phplrt\Parser\Grammar\Alternation([107, 108, 109, 110, 111]),
        114 => new \Phplrt\Parser\Grammar\Optional(112),
        115 => new \Phplrt\Parser\Grammar\Concatenation([123, 124, 125]),
        116 => new \Phplrt\Parser\Grammar\Lexeme('T_DOT', false),
        117 => new \Phplrt\Parser\Grammar\Alternation(['TableColumnName', 115]),
        118 => new \Phplrt\Parser\Grammar\Lexeme('T_DOT', false),
        119 => new \Phplrt\Parser\Grammar\Alternation(['TableColumnName', 115]),
        120 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        121 => new \Phplrt\Parser\Grammar\Optional(120),
        122 => new \Phplrt\Parser\Grammar\Concatenation(['TableColumnName', 121]),
        123 => new \Phplrt\Parser\Grammar\Lexeme('T_LPAREN', false),
        124 => new \Phplrt\Parser\Grammar\Repetition(122, 0, INF),
        125 => new \Phplrt\Parser\Grammar\Lexeme('T_RPAREN', false),
        126 => new \Phplrt\Parser\Grammar\Concatenation(['TableName', 0]),
        127 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_GROUP', false),
        128 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        129 => new \Phplrt\Parser\Grammar\Repetition(126, 0, INF),
        130 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        131 => new \Phplrt\Parser\Grammar\Concatenation(['EnumValue', 0]),
        132 => new \Phplrt\Parser\Grammar\Lexeme('T_ENUM', false),
        133 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        134 => new \Phplrt\Parser\Grammar\Repetition(131, 0, INF),
        135 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        136 => new \Phplrt\Parser\Grammar\Concatenation([143, 'SettingNote', 144]),
        137 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        138 => new \Phplrt\Parser\Grammar\Optional(136),
        139 => new \Phplrt\Parser\Grammar\Concatenation([137, 138]),
        140 => new \Phplrt\Parser\Grammar\Lexeme('T_QUOTED_STRING', true),
        141 => new \Phplrt\Parser\Grammar\Optional(136),
        142 => new \Phplrt\Parser\Grammar\Concatenation([140, 141]),
        143 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        144 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        145 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        146 => new \Phplrt\Parser\Grammar\Concatenation([145, 'String']),
        147 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        148 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        149 => new \Phplrt\Parser\Grammar\Concatenation([147, 0, 'String', 148, 0]),
        150 => new \Phplrt\Parser\Grammar\Lexeme('T_NOTE', false),
        151 => new \Phplrt\Parser\Grammar\Alternation([146, 149]),
        152 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        153 => new \Phplrt\Parser\Grammar\Lexeme('T_SETTING_NOTE', false),
        154 => new \Phplrt\Parser\Grammar\Optional(152),
        155 => new \Phplrt\Parser\Grammar\Lexeme('T_BOOL_TRUE', true),
        156 => new \Phplrt\Parser\Grammar\Lexeme('T_BOOL_FALSE', true),
        157 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        158 => new \Phplrt\Parser\Grammar\Lexeme('T_QUOTED_STRING', true),
        159 => new \Phplrt\Parser\Grammar\Lexeme('T_EOL', false),
        0 => new \Phplrt\Parser\Grammar\Repetition(159, 0, INF)
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
        84 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\ColumnsNode(
                $token->getOffset(), $children
            );
        },
        96 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Action\OnUpdateNode(
                $token->getOffset(), $children[1]->getValue()
            );
        },
        97 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Action\OnDeleteNode(
                $token->getOffset(), $children[1]->getValue()
            );
        },
        93 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Type\ManyToOneNode(
                $token->getOffset()
            );
        },
        95 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Type\OneToOneNode(
                $token->getOffset()
            );
        },
        94 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Type\OneToManyNode(
                $token->getOffset()
            );
        },
        160 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new \Butschster\Dbml\Ast\Ref\Type\ManyToManyNode(
                $token->getOffset(), $token->getBytes()
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
