<?php
/**
 * Copyright 2019 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

use PHPUnit\Framework\TestCase;
use WildPHP\TextFormatter\TextFormatter;

class TextFormatterTest extends TestCase
{
    public function testBold()
    {
        $string = 'Test string';
        $expectedString = "\x02" . $string . "\x02";

        $actual = TextFormatter::bold($string);

        static::assertSame($expectedString, $actual);
    }

    public function testUnderline()
    {
        $string = 'Test string';
        $expectedString = "\x1F" . $string . "\x1F";

        $actual = TextFormatter::underline($string);

        static::assertSame($expectedString, $actual);
    }

    public function testItalic()
    {
        $string = 'Test string';
        $expectedString = "\x09" . $string . "\x09";

        $actual = TextFormatter::italic($string);

        static::assertSame($expectedString, $actual);
    }

    public function testColor()
    {
        $string = 'Test string';
        $expectedString = "\x0306,04" . $string . "\x03";

        $actual = TextFormatter::color($string, 'purple', 'red');
        $actualNumeric = TextFormatter::color($string, '06', '04');

        static::assertSame($expectedString, $actual);
        static::assertSame($expectedString, $actualNumeric);
    }

	public function testCalculateStringColor()
	{
		$expected = 11;
		$string = 'Test';
		
		self::assertEquals($expected, TextFormatter::calculateStringColor($string));
    }

	public function testConsistentStringColor()
	{
		$expected = "\x0311" . 'Test' . "\x03";
		$string = 'Test';
		
		self::assertEquals($expected, TextFormatter::consistentStringColor($string));
		self::assertEquals('', TextFormatter::consistentStringColor(''));
    }

	public function testStripBold()
	{
		$expectedString = 'Test string';
		$string = "\x02" . $expectedString . "\x02";

		$actual = TextFormatter::stripBold($string);

		static::assertSame($expectedString, $actual);
	}

	public function testStripUnderline()
	{
		$expectedString = 'Test string';
		$string = "\x1F" . $expectedString . "\x1F";

		$actual = TextFormatter::stripUnderline($string);

		static::assertSame($expectedString, $actual);
	}

	public function testStripItalic()
	{
		$expectedString = 'Test string';
		$string = "\x09" . $expectedString . "\x09";

		$actual = TextFormatter::stripItalic($string);

		static::assertSame($expectedString, $actual);
	}

	public function testStripColor()
	{
		$expectedString = 'Test string';
		$string = "\x0306,04" . $expectedString . "\x03";

		$actual = TextFormatter::stripColor($string);

		static::assertSame($expectedString, $actual);
	}
}
