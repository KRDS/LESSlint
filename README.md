LESSlint
========

LESSlint is a linter for LESS files.<br>
It is intended to check the code quality and compliance with standards.

## Requirements

PHP 5.4+

## Usage

```
lesslint rules.json /path/to/less/folder/ /path/to/file.less
    --exclude=file.less,lib.less
    --recursive
```

## Rules

The following rules are included:

  * **IndentWithTabs**: use tabs to indent the code, not spaces;
  * **OneSpaceBeforeBracket**: one space before a bracket: `.stuff {`;
  * **WrongIndent**: check if each line is properly intended regarding to the code depth;
  * **ClosingBracketOnItsOwnLine**: closing bracket must be on its own line;
  * **ValidCssProperty** : check for non-existing CSS properties (supports CSS3 and vendor prefixes);
  * **OnePropertyPerLine**: max one property per line;
  * **ColonSpacing**: no space before a colon; one after;
  * **NotImportant**: do not use `!important`;
  * **OverQualifiedSelector**: do not overqualify the selectors. `div.stuff` → `.stuff`;
  * **DoNotStyleIds**: do not apply a style to IDs (#), use classes;
  * **OpeningBracketInline**: opening bracket should be inline, not on its own line.


Create a rule file:

```json
{
	"IndentWithTabs": true,
	"NotImportant": true,
	"OneSpaceBeforeBracket": true,
	"WrongIndent": true,
	"ClosingBracketOnItsOwnLine": true,
	"ValidCssProperty": true,
	"OnePropertyPerLine": true,
	"ColonSpacing": true,
	"OverQualifiedSelector": true,
	"NoUnitToZero": true,
	"OpeningBracketInline": true
}
```