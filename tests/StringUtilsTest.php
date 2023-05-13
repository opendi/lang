<?php
/*
 *  Copyright 2023 Opendi AG
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing,
 *  software distributed under the License is distributed
 *  on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
 *  either express or implied. See the License for the specific
 *  language governing permissions and limitations under the License.
 */
namespace Opendi\Lang\Tests;

use Exception;
use InvalidArgumentException;
use Opendi\Lang\StringUtils;
use PHPUnit\Framework\TestCase;

class StringUtilsTest extends TestCase
{
    public function testMostSimilar()
    {
        $pool = [
            'New York',
            'New Hampshire',
            'San Francisco',
            'New Yaer',
            'England1',
            'Boston',
            'Baltimore'
        ];

        $this->assertEquals('New York', StringUtils::mostSimilar('New Yark', $pool));
        $this->assertEquals('New Hampshire', StringUtils::mostSimilar('Hampshire', $pool));
        $this->assertEquals('New Yaer', StringUtils::mostSimilar('Yaer', $pool));
        $this->assertEquals('New Yaer', StringUtils::mostSimilar('yaer', $pool));
        $this->assertEquals('England1', StringUtils::mostSimilar('Eng', $pool));
        $this->assertEquals('Baltimore', StringUtils::mostSimilar('bostimore', $pool));
    }

    public function testStartsWith()
    {
        $this->assertTrue(StringUtils::startsWith('12356566', '123'));
        $this->assertFalse(StringUtils::startsWith('1212356566', '123'));
        $this->assertFalse(StringUtils::startsWith('# 212356566', '123'));
        $this->assertFalse(StringUtils::startsWith(' 12356566', '123'));
    }

    public function testEndsWith()
    {
        $this->assertTrue(StringUtils::endsWith('12356566123', '123'));
        $this->assertFalse(StringUtils::endsWith('121235656623', '123'));
        $this->assertFalse(StringUtils::endsWith('# 21235656612', '123'));
        $this->assertFalse(StringUtils::endsWith(' 1235656613', '123'));
    }

    public function testContains()
    {
        $this->assertTrue(StringUtils::contains('12356566', '123'));
        $this->assertTrue(StringUtils::contains('11a12356566', '123'));
        $this->assertTrue(StringUtils::contains('aaa123', '123'));
        $this->assertTrue(StringUtils::contains('- $12356566', '123'));
        $this->assertFalse(StringUtils::contains('121256566', '123'));
        $this->assertFalse(StringUtils::contains('# 212456566', '123'));
        $this->assertFalse(StringUtils::contains(' 1255351652663', '123'));
    }

    public function testNormalizePhone()
    {
        $phone = StringUtils::normalizePhone('1234567890');

        $this->assertEquals('123', $phone['npa']);
        $this->assertEquals('456', $phone['nxx']);
        $this->assertEquals('7890', $phone['num']);
        $this->assertEquals('456-7890', $phone['seven']);
        $this->assertEquals('4567890', $phone['plainseven']);
        $this->assertEquals('123-456-7890', $phone['full']);
    }

    public function testPlainPhone()
    {
        $this->assertEquals('1234537890', StringUtils::plainPhone('123', '453-7890'));
        $this->assertEquals('1234537890', StringUtils::plainPhone('123 ', ' 4537890'));
        $this->assertEquals('1234537890', StringUtils::plainPhone('123', '453 7890'));
        $this->assertEquals('1234537890', StringUtils::plainPhone('123', '453-7890 '));
        $this->assertEquals('1234537890', StringUtils::plainPhone(' 123', ' 453-7890'));
    }

    public function testSlugify()
    {
        $this->assertSame('aeoeue-aeoeue-umlauts', StringUtils::slugify('äöü ÄÖÜ Umlauts'));
        $this->assertSame('multiple-weird-characters', StringUtils::slugify('  Multiple-/-\\-- Weird -{}- Characters !"#$%&/(()=??*'));
        $this->assertSame('some-croatian-scczsccz', StringUtils::slugify('Some Croatian: ščćžŠČĆŽ'));
        $this->assertSame('numbers-1234567890', StringUtils::slugify('Numbers: 1234567890'));
    }

    public function testSlugifyNotString()
    {
        $this->expectExceptionMessage("Given argument is a array, expected string.");
        $this->expectException(InvalidArgumentException::class);
        StringUtils::slugify([]);
    }

    public function testSlugifyEmptyString()
    {
        $this->expectExceptionMessage("Cannot slugify an empty string.");
        $this->expectException(InvalidArgumentException::class);
        StringUtils::slugify('');
    }

    public function testTranslit()
    {
        $this->assertSame('aeoeue?AeOeUe?Umlauts', StringUtils::translit('äöü ÄÖÜ Umlauts'));
        $this->assertSame('aeoeue AeOeUe Umlauts', StringUtils::translit('äöü ÄÖÜ Umlauts', ' '));
        $this->assertSame('aeoeueAeOeUeUmlauts', StringUtils::translit('äöü ÄÖÜ Umlauts', ''));

        $string = '  Multiple-/-\\-- Weird -{}- Characters !"#$%&/(()=??*';

        $this->assertSame('Multiple?Weird?Characters', StringUtils::translit($string, '?'));
        $this->assertSame('Multiple?Weird?Characters', StringUtils::translit($string, '?', true, true));
        $this->assertSame('Multiple???????Weird??????Characters', StringUtils::translit($string, '?', true, false));
        $this->assertSame('?Multiple?Weird?Characters?', StringUtils::translit($string, '?', false, true));
        $this->assertSame('??Multiple???????Weird??????Characters???????????????', StringUtils::translit($string, '?', false, false));

        $this->assertSame('Some?Croatian?sccdzSCCDZ', StringUtils::translit('Some Croatian: ščćđžŠČĆĐŽ'));
        $this->assertSame('Numbers?1234567890', StringUtils::translit('Numbers: 1234567890'));

        // Should work on scalars too
        $this->assertSame('1234567890', StringUtils::translit(1234567890)); // integer
        $this->assertSame('12345?6789', StringUtils::translit(12345.67890)); // float
        $this->assertSame('1', StringUtils::translit(true)); // boolean
    }

    public function testTranslitException()
    {
        $this->expectExceptionMessage("StringUtils::translit() expects parameter 1 to be string, array given");
        $this->expectException(InvalidArgumentException::class);
        StringUtils::translit([]);
    }

    public function testReplaceNonBmp()
    {
        $text = "Here is a smiley face: \xF0\x9F\x98\x8A";
        $expected = "Here is a smiley face: \xEF\xBF\xBD";
        $actual = StringUtils::replaceNonBmp($text);
        $this->assertSame($expected, $actual);
    }

    public function testReplaceNonBmpError()
    {
        $this->expectExceptionMessage("Failed replacing non-BMP characters from string. Error code: 4");
        $this->expectException(Exception::class);
        $text = "Here is an invalid unicode sequence: \xF0\x28\x8C\xBC";
        StringUtils::replaceNonBmp($text);
    }
}
