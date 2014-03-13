<?php
namespace Opendi\Lang\Geo;

class GeoCalculatorTest extends \PHPUnit_Framework_TestCase {

    public function testCalcuations() {
        $calculator = new GeoCalculator(19.045148, -155.627424);

        $this->assertEquals(19045148, $calculator->latInt());
        $this->assertEquals(-155627424, $calculator->longInt());
        $this->assertEquals(0.326313104214826, $calculator->latSinRad());
        $this->assertEquals(0.945261740481272, $calculator->latCosRad());
        $this->assertEquals(-2.71621095519724, $calculator->longRad());
    }
}
 