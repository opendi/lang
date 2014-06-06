<?php
/**
 *
 */

namespace Opendi\Lang\Geo;

class GeoCalculator
{
    private $longitude;
    private $latitude;

    public function __construct($latitude, $longitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    public function latInt()
    {
        return intval(round(($this->latitude * 1e6 ), 0));
    }

    public function latSinRad()
    {
        return sin(deg2rad($this->latitude));
    }

    public function latCosRad()
    {
        return cos(deg2rad($this->latitude));
    }

    public function longInt()
    {
        return intval(round(($this->longitude * 1e6), 0));
    }

    public function longRad()
    {
        return  deg2rad($this->longitude);
    }
}
