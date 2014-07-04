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
