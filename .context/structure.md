# PHP Project Structure
###  
```
└── src/
    └── Ast/
        ├── Enum/
        │   ├── ValueNode.php
        ├── EnumNode.php
        ├── NoteNode.php
        ├── Project/
        │   ├── NameNode.php
        │   ├── SettingKeyNode.php
        │   ├── SettingNode.php
        ├── ProjectNode.php
        ├── Ref/
        │   ├── Action/
        │   │   ├── ActionNode.php
        │   │   ├── OnDeleteNode.php
        │   │   ├── OnUpdateNode.php
        │   ├── ColumnsNode.php
        │   ├── GroupNode.php
        │   ├── LeftTableNode.php
        │   ├── NameNode.php
        │   ├── RightTableNode.php
        │   ├── SettingNode.php
        │   ├── TableNode.php
        │   ├── Type/
        │   │   ├── ManyToOneNode.php
        │   │   ├── OneToManyNode.php
        │   │   ├── OneToOneNode.php
        │   ├── TypeNode.php
        ├── RefNode.php
        ├── SchemaNode.php
        ├── Table/
        │   ├── AliasNode.php
        │   ├── Column/
        │   │   ├── NameNode.php
        │   │   ├── Setting/
        │   │   │   ├── IncrementNode.php
        │   │   │   ├── NotNullNode.php
        │   │   │   ├── NullNode.php
        │   │   │   ├── PrimaryKeyNode.php
        │   │   │   ├── UniqueNode.php
        │   │   ├── SettingNode.php
        │   │   ├── SettingWithValueNode.php
        │   │   ├── SizeNode.php
        │   │   ├── TypeNode.php
        │   ├── ColumnNode.php
        │   ├── Index/
        │   │   ├── FieldsNode.php
        │   ├── IndexNode.php
        │   ├── NameNode.php
        ├── TableGroupNode.php
        ├── TableNode.php
        ├── Values/
        │   └── AbstractValue.php
        │   └── BooleanNode.php
        │   └── ExpressionNode.php
        │   └── FloatNode.php
        │   └── IntNode.php
        │   └── NullNode.php
        │   └── StringNode.php
    └── DbmlParser.php
    └── DbmlParserFactory.php
    └── Exceptions/
        ├── ColumnNotFoundException.php
        ├── EnumNotFoundException.php
        ├── EnumValueNotFoundException.php
        ├── GrammarFileNotFoundException.php
        ├── ProjectSettingNotFoundException.php
        ├── RefActionNotFoundException.php
        ├── TableGroupNotFoundException.php
        ├── TableNotFoundException.php
    └── grammar.php

```