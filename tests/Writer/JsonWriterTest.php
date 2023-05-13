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

namespace Opendi\Lang\Tests\Writer;

use Opendi\Lang\Writer\JsonWriter;
use PHPUnit\Framework\TestCase;

class JsonWriterTest extends TestCase
{
    private $testData = [
        'foo' => ['bar1' => 'baz1'],
        'bar' => ['bar2' => 'baz2'],
        'baz' => ['bar3' => 'baz3'],
    ];

    public function testSimple() {
        $path = $this->getTestPath();

        $iterator = new \ArrayIterator($this->testData);

        $writer = new JsonWriter();
        $writer->write($path, $iterator);


        $actual = json_decode(file_get_contents($path), true);
        $this->assertSame($this->testData, $actual);

        unlink($path);
    }

    public function testPretty() {
        $path = $this->getTestPath();

        $iterator = new \ArrayIterator($this->testData);

        $writer = new JsonWriter();
        $writer->write($path, $iterator, null, JsonWriter::FLAG_PRETTY_PRINT);

        $actual = json_decode(file_get_contents($path), true);
        $this->assertSame($this->testData, $actual);

        unlink($path);
    }

    public function testRollover() {
        $path = $this->getTestPath();

        $iterator = new \ArrayIterator($this->testData);

        $writer = new JsonWriter();
        $writer->write($path, $iterator, 1, JsonWriter::FLAG_PRETTY_PRINT);

        $actual1 = json_decode(file_get_contents("$path.00001"), true);
        $actual2 = json_decode(file_get_contents("$path.00002"), true);
        $actual3 = json_decode(file_get_contents("$path.00003"), true);

        $expected1 = ['foo' => ['bar1' => 'baz1']];
        $expected2 = ['bar' => ['bar2' => 'baz2']];
        $expected3 = ['baz' => ['bar3' => 'baz3']];

        $this->assertSame($expected1, $actual1);
        $this->assertSame($expected2, $actual2);
        $this->assertSame($expected3, $actual3);

        unlink("$path.00001");
        unlink("$path.00002");
        unlink("$path.00003");
    }

    private function getTestPath() {
        return sys_get_temp_dir() . '/' . uniqid('lang');
    }
}
