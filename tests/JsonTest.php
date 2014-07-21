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

use Opendi\Lang\Json;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    public function testDecode()
    {
        $data = '{ "foo": 1, "bar": { "baz": "xxx" } }';

        $actual = Json::decode($data);
        $expected = json_decode($data);

        // Verify that decoding was succesful
        $this->assertTrue(json_last_error() === JSON_ERROR_NONE);

        $this->assertEquals($expected, $actual);
    }

    public function testDecodeWithOptions()
    {
        $data = '{ "foo": 1, "bar": { "baz": "xxx" } }';

        $actual = Json::decode($data, true);
        $expected = json_decode($data, true);

        // Verify that decoding was succesful
        $this->assertTrue(json_last_error() === JSON_ERROR_NONE);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Failed decoding JSON
     */
    public function testDecodeError()
    {
        // Invalid JSON
        Json::decode('xxx');
    }

    public function testEncode()
    {
        $data = [
            'foo' => 1,
            'bar' => [
                'baz' => 'xxx'
            ]
        ];

        $actual = Json::encode($data);
        $expected = json_encode($data);

        // Verify that encoding was succesful
        $this->assertTrue(json_last_error() === JSON_ERROR_NONE);

        $this->assertEquals($expected, $actual);
    }

    public function testEncodeWithOptions()
    {
        $data = [
            'foo' => 1,
            'bar' => [
                'baz' => 'xxx'
            ]
        ];

        $actual = Json::encode($data, true, JSON_PRETTY_PRINT);
        $expected = json_encode($data, true, JSON_PRETTY_PRINT);

        // Verify that encoding was succesful
        $this->assertTrue(json_last_error() === JSON_ERROR_NONE);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Failed encoding JSON
     */
    public function testEncodeError()
    {
        // Unencodable stuff
        Json::encode(INF);
    }
}
