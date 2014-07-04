<?php
/*
 *  Copyright 2014 Opendi Software AG
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

use Opendi\Lang\String;

class StringTest extends \PHPUnit_Framework_TestCase
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

        $this->assertEquals('New York', String::mostSimilar('New Yark', $pool));
        $this->assertEquals('New Hampshire', String::mostSimilar('Hampshire', $pool));
        $this->assertEquals('New Yaer', String::mostSimilar('Yaer', $pool));
        $this->assertEquals('New Yaer', String::mostSimilar('yaer', $pool));
        $this->assertEquals('England1', String::mostSimilar('Eng', $pool));
        $this->assertEquals('Baltimore', String::mostSimilar('bostimore', $pool));
    }

    public function testStartsWith()
    {
        $this->assertTrue(String::startsWith('12356566', '123'));
        $this->assertFalse(String::startsWith('1212356566', '123'));
        $this->assertFalse(String::startsWith('# 212356566', '123'));
        $this->assertFalse(String::startsWith(' 12356566', '123'));
    }

    public function testEndsWith()
    {
        $this->assertTrue(String::endsWith('12356566123', '123'));
        $this->assertFalse(String::endsWith('121235656623', '123'));
        $this->assertFalse(String::endsWith('# 21235656612', '123'));
        $this->assertFalse(String::endsWith(' 1235656613', '123'));
    }

    public function testContains()
    {
        $this->assertTrue(String::contains('12356566', '123'));
        $this->assertTrue(String::contains('11a12356566', '123'));
        $this->assertTrue(String::contains('aaa123', '123'));
        $this->assertTrue(String::contains('- $12356566', '123'));
        $this->assertFalse(String::contains('121256566', '123'));
        $this->assertFalse(String::contains('# 212456566', '123'));
        $this->assertFalse(String::contains(' 1255351652663', '123'));
    }

    public function testNormalizePhone()
    {
        $phone = String::normalizePhone('1234567890');

        $this->assertEquals('123', $phone['npa']);
        $this->assertEquals('456', $phone['nxx']);
        $this->assertEquals('7890', $phone['num']);
        $this->assertEquals('456-7890', $phone['seven']);
        $this->assertEquals('4567890', $phone['plainseven']);
        $this->assertEquals('123-456-7890', $phone['full']);
    }

    public function testPlainPhone()
    {
        $this->assertEquals('1234537890', String::plainPhone('123', '453-7890'));
        $this->assertEquals('1234537890', String::plainPhone('123 ', ' 4537890'));
        $this->assertEquals('1234537890', String::plainPhone('123', '453 7890'));
        $this->assertEquals('1234537890', String::plainPhone('123', '453-7890 '));
        $this->assertEquals('1234537890', String::plainPhone(' 123', ' 453-7890'));
    }

    public function testSlugify()
    {
        $this->assertSame('aeoeue-aeoeue-umlauts', String::slugify('äöü ÄÖÜ Umlauts'));
        $this->assertSame('multiple-weird-characters', String::slugify('  Multiple-/-\\-- Weird -{}- Characters !"#$%&/(()=??*'));
        $this->assertSame('some-croatian-scczsccz', String::slugify('Some Croatian: ščćžŠČĆŽ'));
        $this->assertSame('numbers-1234567890', String::slugify('Numbers: 1234567890'));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Given argument is a array, expected string.
     */
    public function testSlugifyNotString()
    {
        String::slugify([]);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Cannot slugify an empty string.
     */
    public function testSlugifyEmptyString()
    {
        String::slugify('');
    }
}
