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
namespace Opendi\Lang\Geo;

class GeoCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCalcuations()
    {
        $calculator = new GeoCalculator(19.045148, -155.627424);

        $this->assertEquals(19045148, $calculator->latInt());
        $this->assertEquals(-155627424, $calculator->longInt());
        $this->assertEquals(0.326313104214826, $calculator->latSinRad());
        $this->assertEquals(0.945261740481272, $calculator->latCosRad());
        $this->assertEquals(-2.71621095519724, $calculator->longRad());
    }
}
