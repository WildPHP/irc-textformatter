<?php

/**
 * Copyright 2019 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\TextFormatter;

class TextFormatter
{
    // It is required that the numbers are represented as strings (for leading zeroes).
    /**
     * @var array<string, string>
     */
    protected static $colorMap = [
        'white' => '00',
        'black' => '01',
        'blue' => '02',
        'green' => '03',
        'red' => '04',
        'brown' => '05',
        'purple' => '06',
        'orange' => '07',
        'yellow' => '08',
        'lime' => '09',
        'teal' => '10',
        'aqua' => '11',
        'royal' => '12',
        'fuchsia' => '13',
        'grey' => '14',
        'silver' => '15',
    ];

    /**
     * @var array<string, string>
     */
    protected static $asciiMap = [
        'bold' => "\x02",
        'underline' => "\x1F",
        'italic' => "\x09",
        'strikethrough' => "\x13",
        'reverse' => "\x16",
        'color' => "\x03"
    ];

    public static function bold(string $text): string
    {
        return self::$asciiMap['bold'] . $text . self::$asciiMap['bold'];
    }

    public static function italic(string $text): string
    {
        return self::$asciiMap['italic'] . $text . self::$asciiMap['italic'];
    }

    public static function underline(string $text): string
    {
        return self::$asciiMap['underline'] . $text . self::$asciiMap['underline'];
    }

    public static function wrapInColorDelimiters(string $text): string
    {
        return self::$asciiMap['color'] . $text . self::$asciiMap['color'];
    }

    /**
     * @param  string  $text
     * @param  int|string  $foreground
     * @param  int|string  $background
     *
     * @return string
     */
    public static function color(string $text, $foreground, $background = ''): string
    {
        if (!is_numeric($foreground)) {
            $foreground = self::findColorByString($foreground);
        }

        if (!is_numeric($background)) {
            $background = self::findColorByString($background);
        }

        return self::wrapInColorDelimiters($foreground . (!empty($background) ? ',' . $background : '') . $text);
    }

    public static function findColorByString(string $color): string
    {
        $color = strtolower($color);
        return self::$colorMap[$color] ?? '';
    }

    public static function calculateStringColor(string $stringToColor): int
    {
        $num = 0;
        foreach (str_split($stringToColor) as $char) {
            $num += ord($char);
        }
        // The -1 is here to account for index 0
        return abs($num) % (count(self::$colorMap) - 1);
    }

    public static function consistentStringColor(string $stringToColor, string $background = ''): string
    {
        // Don't even bother.
        if (empty($stringToColor)) {
            return '';
        }

        $color = self::calculateStringColor($stringToColor);
        return self::color($stringToColor, $color, $background);
    }

    public static function stripBold(string $text): string
    {
        return str_replace(self::$asciiMap['bold'], '', $text);
    }

    public static function stripItalic(string $text): string
    {
        return str_replace(self::$asciiMap['italic'], '', $text);
    }

    public static function stripUnderline(string $text): string
    {
        return str_replace(self::$asciiMap['underline'], '', $text);
    }

    public static function stripColor(string $text): string
    {
        $regex = '/' . preg_quote(self::$asciiMap['color'], '/') . '(\d{1,2},\d{1,2})?/';
        return preg_replace($regex, '', $text) ?? $text;
    }
}
