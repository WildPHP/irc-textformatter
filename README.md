# irc-textformatter
[![Build Status](https://scrutinizer-ci.com/g/WildPHP/irc-textformatter/badges/build.png)](https://scrutinizer-ci.com/g/WildPHP/irc-textformatter/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/WildPHP/irc-textformatter/badges/quality-score.png)](https://scrutinizer-ci.com/g/WildPHP/irc-textformatter/?branch=master)
[![Scrutinizer Code Coverage](https://scrutinizer-ci.com/g/WildPHP/irc-textformatter/badges/coverage.png)](https://scrutinizer-ci.com/g/WildPHP/irc-textformatter/code-structure/master/code-coverage)
[![Latest Stable Version](https://poser.pugx.org/wildphp/irc-textformatter/v/stable)](https://packagist.org/packages/wildphp/irc-textformatter)
[![Latest Unstable Version](https://poser.pugx.org/wildphp/irc-textformatter/v/unstable)](https://packagist.org/packages/wildphp/irc-textformatter)
[![Total Downloads](https://poser.pugx.org/wildphp/irc-textformatter/downloads)](https://packagist.org/packages/wildphp/irc-textformatter)

Tiny library to format text according to the IRC standard.

## Installation
To install this package, you need [Composer](https://getcomposer.org/).

    $ composer require wildphp/irc-textformatter ^0.1
    
## Usage
The formatter works as a utility class. It exposes the following methods:

- `bold(string $text)`
- `italic(string $text)`
- `underline(string $text)`
- `color(string $text, string $foreground, string $background = '')` (see below what colors are supported)

Along with the above basic methods, some more advanced methods are provided:
- `findColorByString(string $color)` - returns a numeric string with the color code based on human readable input ('white' will return '00', see the color table below)
- `calculateStringColor(string $stringToColor)` - returns a numeric string with color code based on string contents
- `consistentStringColor(string $stringToColor)` - same as above, but pre-applies the color to the string

It also allows you to strip various formatting elements from text:
- `stripBold(string $text)`
- `stripItalic(string $text)`
- `stripUnderline(string $text)`
- `stripColor(string $text)`

## Color table
| Human-readable | IRC color code |
|----------------|----------------|
|`white`         |`00`            |
|`black`         |`01`            |
|`blue`          |`02`            |
|`green`         |`03`            |
|`red`           |`04`            |
|`brown`         |`05`            |
|`purple`        |`06`            |
|`orange`        |`07`            |
|`yellow`        |`08`            |
|`lime`          |`09`            |
|`teal`          |`10`            |
|`aqua`          |`11`            |
|`royal`         |`12`            |
|`fuchsia`       |`13`            |
|`grey`          |`14`            |
|`silver`        |`15`            |

## Contributors
You can see the full list of contributors [in the GitHub repository](https://github.com/WildPHP/irc-messages/graphs/contributors).
