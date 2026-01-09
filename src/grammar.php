<?php

declare(strict_types=1);

/**
 * @var array{
 *     initial: array-key,
 *     tokens: array{
 *         default: array<non-empty-string, non-empty-string>,
 *         ...
 *     },
 *     skip: list<non-empty-string>,
 *     grammar: array<array-key, \Phplrt\Parser\Grammar\RuleInterface>,
 *     reducers: array<array-key, callable(\Phplrt\Parser\Context, mixed):mixed>,
 *     transitions?: array<array-key, mixed>
 * }
 */
return [
    'initial' => 'Document',
    'tokens' => [
        'default' => [
            'T_WHITESPACE' => '\\s+',
            'T_COMMENT' => '//[^\\n]*\\n',
            'T_BOOL_TRUE' => '(?<=\\b)true\\b',
            'T_BOOL_FALSE' => '(?<=\\b)false\\b',
            'T_NULL' => '(?<=\\b)null\\b',
            'T_PROJECT' => '(?<=\\b)(Project|project)\\b',
            'T_TABLE' => '(?<=\\b)(Table|table)\\b',
            'T_TABLE_ALIAS' => '(?<=\\b)as\\b',
            'T_TABLE_INDEXES' => '(?<=\\b)(Indexes|indexes)\\b',
            'T_TABLE_REF' => '(?<=\\b)(Ref|ref)\\b',
            'T_TABLE_GROUP' => '(?<=\\b)(TableGroup|tablegroup)\\b',
            'T_ENUM' => '(?<=\\b)(Enum|enum)\\b',
            'T_TABLE_SETTING_PK' => '(?<=\\b)(primary\\skey|pk)\\b',
            'T_TABLE_SETTING_UNIQUE' => '(?<=\\b)unique\\b',
            'T_TABLE_SETTING_INCREMENT' => '(?<=\\b)increment\\b',
            'T_TABLE_SETTING_DEFAULT' => '(?<=\\b)default\\b',
            'T_TABLE_COLUMN_SIZE' => '\\([0-9\\,]+\\)',
            'T_TABLE_SETTING_NOT_NULL' => '(?<=\\b)not\\snull\\b',
            'T_REF_ACTION_CASCADE' => '(?<=\\b)cascade\\b',
            'T_REF_ACTION_RESTRICT' => '(?<=\\b)restrict\\b',
            'T_REF_ACTION_SET_NULL' => '(?<=\\b)set\\snull\\b',
            'T_REF_ACTION_SET_DEFAULT' => '(?<=\\b)set\\default\\b',
            'T_REF_ACTION_NO_ACTION' => '(?<=\\b)no\\saction\\b',
            'T_REF_ACTION_DESTROY' => '(?<=\\b)destroy\\b',
            'T_REF_ACTION_DELETE' => '(?<=\\b)delete\\b',
            'T_REF_ACTION_UPDATE' => '(?<=\\b)update\\b',
            'T_SETTING_NOTE' => 'note:',
            'T_NOTE' => '(?<=\\b)Note\\b',
            'T_FLOAT' => '[0-9]+\\.[0-9]+',
            'T_INT' => '^[0-9]+$',
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
    'transitions' => [],
    'grammar' => [
        0 => new \Phplrt\Parser\Grammar\Repetition(162, 0, INF),
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
        13 => new \Phplrt\Parser\Grammar\Concatenation([51, 52, 0, 53, 54]),
        14 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE', false),
        15 => new \Phplrt\Parser\Grammar\Optional('TableAlias'),
        16 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        17 => new \Phplrt\Parser\Grammar\Repetition(10, 0, INF),
        18 => new \Phplrt\Parser\Grammar\Optional(12),
        19 => new \Phplrt\Parser\Grammar\Optional(13),
        20 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        21 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        22 => new \Phplrt\Parser\Grammar\Lexeme('T_QUOTED_STRING', true),
        23 => new \Phplrt\Parser\Grammar\Lexeme('T_INT', true),
        24 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_ALIAS', false),
        25 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        26 => new \Phplrt\Parser\Grammar\Concatenation([34, 35, 36]),
        27 => new \Phplrt\Parser\Grammar\Optional(26),
        28 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        29 => new \Phplrt\Parser\Grammar\Lexeme('T_QUOTED_STRING', true),
        30 => new \Phplrt\Parser\Grammar\Optional('TableColumnTypeSize'),
        31 => new \Phplrt\Parser\Grammar\Concatenation([45, 47, 48, 49]),
        32 => new \Phplrt\Parser\Grammar\Concatenation([37, 39]),
        33 => new \Phplrt\Parser\Grammar\Alternation(['SettingNote', 'TableColumnRef', 31, 32]),
        34 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        35 => new \Phplrt\Parser\Grammar\Repetition(33, 0, INF),
        36 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        37 => new \Phplrt\Parser\Grammar\Alternation([40, 41, 42, 43, 44]),
        38 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        39 => new \Phplrt\Parser\Grammar\Optional(38),
        40 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_PK', true),
        41 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_UNIQUE', true),
        42 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_INCREMENT', true),
        43 => new \Phplrt\Parser\Grammar\Lexeme('T_NULL', true),
        44 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_NOT_NULL', true),
        45 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_SETTING_DEFAULT', true),
        46 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        47 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        48 => new \Phplrt\Parser\Grammar\Alternation(['Expression', 'Float', 'Int', 'Boolean', 'Null', 'String']),
        49 => new \Phplrt\Parser\Grammar\Optional(46),
        50 => new \Phplrt\Parser\Grammar\Concatenation(['TableIndex', 0]),
        51 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_INDEXES', false),
        52 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        53 => new \Phplrt\Parser\Grammar\Repetition(50, 0, INF),
        54 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        55 => new \Phplrt\Parser\Grammar\Alternation(['TableIndexCompositeField', 'TableIndexSingleField']),
        56 => new \Phplrt\Parser\Grammar\Optional('TableIndexSettings'),
        57 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        58 => new \Phplrt\Parser\Grammar\Alternation(['String', 'Expression']),
        59 => new \Phplrt\Parser\Grammar\Optional(57),
        60 => new \Phplrt\Parser\Grammar\Concatenation([58, 59]),
        61 => new \Phplrt\Parser\Grammar\Lexeme('T_LPAREN', false),
        62 => new \Phplrt\Parser\Grammar\Repetition(60, 0, INF),
        63 => new \Phplrt\Parser\Grammar\Lexeme('T_RPAREN', false),
        64 => new \Phplrt\Parser\Grammar\Alternation(['SettingNote', 'TableIndexSettingWithValue', 'TableIndexSetting']),
        65 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        66 => new \Phplrt\Parser\Grammar\Repetition(64, 0, INF),
        67 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        68 => new \Phplrt\Parser\Grammar\Alternation([40, 41]),
        69 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        70 => new \Phplrt\Parser\Grammar\Optional(69),
        71 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        72 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        73 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        74 => new \Phplrt\Parser\Grammar\Optional(71),
        75 => new \Phplrt\Parser\Grammar\Concatenation([86, 87, 85]),
        76 => new \Phplrt\Parser\Grammar\Concatenation([88, 89, 0, 90, 91, 0]),
        77 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_REF', false),
        78 => new \Phplrt\Parser\Grammar\Alternation([75, 76]),
        79 => new \Phplrt\Parser\Grammar\Concatenation([84, 'RefRightTable']),
        80 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        81 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_REF', false),
        82 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        83 => new \Phplrt\Parser\Grammar\Optional(80),
        84 => new \Phplrt\Parser\Grammar\Alternation([94, 95, 96]),
        85 => new \Phplrt\Parser\Grammar\Concatenation(['RefLeftTable', 84, 'RefRightTable', 93]),
        86 => new \Phplrt\Parser\Grammar\Optional('RefName'),
        87 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        88 => new \Phplrt\Parser\Grammar\Optional('RefName'),
        89 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        90 => new \Phplrt\Parser\Grammar\Repetition(85, 0, INF),
        91 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        92 => new \Phplrt\Parser\Grammar\Concatenation([100, 101, 102]),
        93 => new \Phplrt\Parser\Grammar\Optional(92),
        94 => new \Phplrt\Parser\Grammar\Lexeme('T_GT', true),
        95 => new \Phplrt\Parser\Grammar\Lexeme('T_LT', true),
        96 => new \Phplrt\Parser\Grammar\Lexeme('T_MINUS', true),
        97 => new \Phplrt\Parser\Grammar\Concatenation([104, 105, 103]),
        98 => new \Phplrt\Parser\Grammar\Concatenation([108, 109, 103]),
        99 => new \Phplrt\Parser\Grammar\Alternation([97, 98]),
        100 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        101 => new \Phplrt\Parser\Grammar\Repetition(99, 0, INF),
        102 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        103 => new \Phplrt\Parser\Grammar\Concatenation([116, 117]),
        104 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_UPDATE', true),
        105 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        106 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_DELETE', true),
        107 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_DESTROY', true),
        108 => new \Phplrt\Parser\Grammar\Alternation([106, 107]),
        109 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        110 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_CASCADE', true),
        111 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_RESTRICT', true),
        112 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_SET_NULL', true),
        113 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_SET_DEFAULT', true),
        114 => new \Phplrt\Parser\Grammar\Lexeme('T_REF_ACTION_NO_ACTION', true),
        115 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        116 => new \Phplrt\Parser\Grammar\Alternation([110, 111, 112, 113, 114]),
        117 => new \Phplrt\Parser\Grammar\Optional(115),
        118 => new \Phplrt\Parser\Grammar\Concatenation([126, 127, 128]),
        119 => new \Phplrt\Parser\Grammar\Lexeme('T_DOT', false),
        120 => new \Phplrt\Parser\Grammar\Alternation(['TableColumnName', 118]),
        121 => new \Phplrt\Parser\Grammar\Lexeme('T_DOT', false),
        122 => new \Phplrt\Parser\Grammar\Alternation(['TableColumnName', 118]),
        123 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        124 => new \Phplrt\Parser\Grammar\Optional(123),
        125 => new \Phplrt\Parser\Grammar\Concatenation(['TableColumnName', 124]),
        126 => new \Phplrt\Parser\Grammar\Lexeme('T_LPAREN', false),
        127 => new \Phplrt\Parser\Grammar\Repetition(125, 0, INF),
        128 => new \Phplrt\Parser\Grammar\Lexeme('T_RPAREN', false),
        129 => new \Phplrt\Parser\Grammar\Concatenation(['TableName', 0]),
        130 => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_GROUP', false),
        131 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        132 => new \Phplrt\Parser\Grammar\Repetition(129, 0, INF),
        133 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        134 => new \Phplrt\Parser\Grammar\Concatenation(['EnumValue', 0]),
        135 => new \Phplrt\Parser\Grammar\Lexeme('T_ENUM', false),
        136 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        137 => new \Phplrt\Parser\Grammar\Repetition(134, 0, INF),
        138 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        139 => new \Phplrt\Parser\Grammar\Concatenation([146, 'SettingNote', 147]),
        140 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        141 => new \Phplrt\Parser\Grammar\Optional(139),
        142 => new \Phplrt\Parser\Grammar\Concatenation([140, 141]),
        143 => new \Phplrt\Parser\Grammar\Lexeme('T_QUOTED_STRING', true),
        144 => new \Phplrt\Parser\Grammar\Optional(139),
        145 => new \Phplrt\Parser\Grammar\Concatenation([143, 144]),
        146 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACK', false),
        147 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACK', false),
        148 => new \Phplrt\Parser\Grammar\Lexeme('T_COLON', false),
        149 => new \Phplrt\Parser\Grammar\Concatenation([148, 'String']),
        150 => new \Phplrt\Parser\Grammar\Lexeme('T_LBRACE', false),
        151 => new \Phplrt\Parser\Grammar\Lexeme('T_RBRACE', false),
        152 => new \Phplrt\Parser\Grammar\Concatenation([150, 0, 'String', 151, 0]),
        153 => new \Phplrt\Parser\Grammar\Lexeme('T_NOTE', false),
        154 => new \Phplrt\Parser\Grammar\Alternation([149, 152]),
        155 => new \Phplrt\Parser\Grammar\Lexeme('T_COMMA', false),
        156 => new \Phplrt\Parser\Grammar\Lexeme('T_SETTING_NOTE', false),
        157 => new \Phplrt\Parser\Grammar\Optional(155),
        158 => new \Phplrt\Parser\Grammar\Lexeme('T_BOOL_TRUE', true),
        159 => new \Phplrt\Parser\Grammar\Lexeme('T_BOOL_FALSE', true),
        160 => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        161 => new \Phplrt\Parser\Grammar\Lexeme('T_QUOTED_STRING', true),
        162 => new \Phplrt\Parser\Grammar\Lexeme('T_EOL', false),
        'Boolean' => new \Phplrt\Parser\Grammar\Alternation([158, 159]),
        'Document' => new \Phplrt\Parser\Grammar\Concatenation(['Schema']),
        'Enum' => new \Phplrt\Parser\Grammar\Concatenation([135, 'EnumName', 136, 0, 137, 138, 0]),
        'EnumName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'EnumValue' => new \Phplrt\Parser\Grammar\Alternation([142, 145]),
        'Expression' => new \Phplrt\Parser\Grammar\Lexeme('T_EXPRESSION', true),
        'Float' => new \Phplrt\Parser\Grammar\Lexeme('T_FLOAT', true),
        'Int' => new \Phplrt\Parser\Grammar\Lexeme('T_INT', true),
        'Note' => new \Phplrt\Parser\Grammar\Concatenation([153, 154]),
        'Null' => new \Phplrt\Parser\Grammar\Lexeme('T_NULL', true),
        'Project' => new \Phplrt\Parser\Grammar\Concatenation([5, 'ProjectName', 6, 0, 7, 8, 0]),
        'ProjectName' => new \Phplrt\Parser\Grammar\Concatenation(['String']),
        'ProjectSetting' => new \Phplrt\Parser\Grammar\Concatenation(['ProjectSettingKey', 9, 'String', 0]),
        'ProjectSettingKey' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'Ref' => new \Phplrt\Parser\Grammar\Concatenation([77, 78]),
        'RefLeftTable' => new \Phplrt\Parser\Grammar\Concatenation(['TableName', 119, 120]),
        'RefName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'RefRightTable' => new \Phplrt\Parser\Grammar\Concatenation(['TableName', 121, 122]),
        'Schema' => new \Phplrt\Parser\Grammar\Repetition(2, 0, INF),
        'SettingNote' => new \Phplrt\Parser\Grammar\Concatenation([156, 'String', 157]),
        'String' => new \Phplrt\Parser\Grammar\Alternation([160, 161]),
        'Table' => new \Phplrt\Parser\Grammar\Concatenation([14, 'TableName', 15, 16, 0, 17, 18, 19, 20, 0]),
        'TableAlias' => new \Phplrt\Parser\Grammar\Concatenation([24, 25]),
        'TableColumn' => new \Phplrt\Parser\Grammar\Concatenation(['TableColumnName', 'TableColumnType', 27]),
        'TableColumnName' => new \Phplrt\Parser\Grammar\Alternation([28, 29]),
        'TableColumnRef' => new \Phplrt\Parser\Grammar\Concatenation([81, 82, 79, 83]),
        'TableColumnType' => new \Phplrt\Parser\Grammar\Concatenation(['TableColumnTypeName', 30]),
        'TableColumnTypeName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'TableColumnTypeSize' => new \Phplrt\Parser\Grammar\Lexeme('T_TABLE_COLUMN_SIZE', true),
        'TableGroup' => new \Phplrt\Parser\Grammar\Concatenation([130, 'TableGroupName', 131, 0, 132, 133, 0]),
        'TableGroupName' => new \Phplrt\Parser\Grammar\Lexeme('T_WORD', true),
        'TableIndex' => new \Phplrt\Parser\Grammar\Concatenation([55, 56]),
        'TableIndexCompositeField' => new \Phplrt\Parser\Grammar\Concatenation([61, 62, 63]),
        'TableIndexSetting' => new \Phplrt\Parser\Grammar\Concatenation([68, 70]),
        'TableIndexSettingWithValue' => new \Phplrt\Parser\Grammar\Concatenation([72, 73, 'String', 74]),
        'TableIndexSettings' => new \Phplrt\Parser\Grammar\Concatenation([65, 66, 67]),
        'TableIndexSingleField' => new \Phplrt\Parser\Grammar\Alternation(['String', 'Expression']),
        'TableName' => new \Phplrt\Parser\Grammar\Alternation([21, 22, 23]),
    ],
    'reducers' => [
        31 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\SettingWithValueNode(
                $token->getOffset(), $children[0]->getValue(), $children[1]
            );
        },
        40 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\Setting\PrimaryKeyNode(
              $token->getOffset()
          );
        },
        41 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\Setting\UniqueNode(
              $token->getOffset()
          );
        },
        42 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\Setting\IncrementNode(
              $token->getOffset()
          );
        },
        43 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\Setting\NullNode(
              $token->getOffset()
          );
        },
        44 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\Setting\NotNullNode(
              $token->getOffset()
          );
        },
        75 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\RefNode(
                $token->getOffset(), $children
            );
        },
        76 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\GroupNode(
               $token->getOffset(), $children
           );
        },
        79 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\ColumnsNode(
                $token->getOffset(), $children
            );
        },
        85 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\ColumnsNode(
                $token->getOffset(), $children
            );
        },
        94 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\Type\ManyToOneNode(
               $token->getOffset()
            );
        },
        95 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\Type\OneToManyNode(
               $token->getOffset()
           );
        },
        96 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\Type\OneToOneNode(
               $token->getOffset()
           );
        },
        97 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\Action\OnUpdateNode(
               $token->getOffset(), $children[1]->getValue()
           );
        },
        98 => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\Action\OnDeleteNode(
               $token->getOffset(), $children[1]->getValue()
           );
        },
        'Boolean' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Values\BooleanNode(
                $token->getOffset(),
                $children->getName() === 'T_BOOL_TRUE'
            );
        },
        'Enum' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\EnumNode(
                $token->getOffset(), $children[0]->getValue(), array_slice($children, 1)
            );
        },
        'EnumValue' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

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
        'Expression' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Values\ExpressionNode(
               $token->getOffset(), $children->getValue()
           );
        },
        'Float' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Values\FloatNode(
                $token->getOffset(), $children->getValue()
            );
        },
        'Int' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Values\IntNode(
               $token->getOffset(), $children->getValue()
           );
        },
        'Note' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\NoteNode(
                $token->getOffset(), \end($children)
            );
        },
        'Null' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Values\NullNode($token->getOffset());
        },
        'Project' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\ProjectNode(
                $token->getOffset(), $children
            );
        },
        'ProjectName' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Project\NameNode(
                $token->getOffset(), \end($children)
            );
        },
        'ProjectSetting' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Project\SettingNode(
                $token->getOffset(), \current($children), \end($children)
            );
        },
        'ProjectSettingKey' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Project\SettingKeyNode(
                $token->getOffset(), $children->getValue()
            );
        },
        'RefLeftTable' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\LeftTableNode(
                $token->getOffset(), $children[0], array_slice($children, 1)
            );
        },
        'RefName' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\NameNode(
                $token->getOffset(), $children->getValue()
            );
        },
        'RefRightTable' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Ref\RightTableNode(
               $token->getOffset(), $children[0], array_slice($children, 1)
           );
        },
        'Schema' => static function (\Phplrt\Parser\Context $ctx, $children) {
            return new \Butschster\Dbml\Ast\SchemaNode($children);
        },
        'SettingNote' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\NoteNode(
                $token->getOffset(), \end($children)
            );
        },
        'String' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Values\StringNode(
                $token->getOffset(),
                $children
            );
        },
        'Table' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\TableNode(
                $token->getOffset(), $children[0]->getValue(), $children
            );
        },
        'TableAlias' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\AliasNode(
               $token->getOffset(), $children[0]->getValue()
           );
        },
        'TableColumn' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\ColumnNode(
                $token->getOffset(), $children[0], $children[1], array_slice($children, 2)
            );
        },
        'TableColumnName' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\NameNode(
                $token->getOffset(), \trim($children->getValue(), '"\'')
            );
        },
        'TableColumnRef' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\RefNode(
                $token->getOffset(), $children
            );
        },
        'TableColumnType' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\TypeNode(
                $token->getOffset(), $children[0], $children[1] ?? null
            );
        },
        'TableColumnTypeName' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\NameNode(
                $token->getOffset(), $children->getValue()
            );
        },
        'TableColumnTypeSize' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\SizeNode(
                $token->getOffset(), $children->getValue()
            );
        },
        'TableGroup' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\TableGroupNode(
                $token->getOffset(), $children[0]->getValue(), array_slice($children, 1)
            );
        },
        'TableIndex' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\IndexNode(
                $token->getOffset(), $children[0], array_slice($children, 1)
            );
        },
        'TableIndexCompositeField' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Index\FieldsNode(
               $token->getOffset(), $children
            );
        },
        'TableIndexSettingWithValue' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Column\SettingWithValueNode(
                $token->getOffset(), $children[0]->getValue(), $children[1]
            );
        },
        'TableIndexSingleField' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\Index\FieldsNode(
              $token->getOffset(), [$children]
            );
        },
        'TableName' => static function (\Phplrt\Parser\Context $ctx, $children) {
            // The "$token" variable is an auto-generated
            $token = $ctx->lastProcessedToken;

            return new \Butschster\Dbml\Ast\Table\NameNode(
                $token->getOffset(), \trim($children->getValue(), '"\'')
            );
        },
    ],
];