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
namespace Opendi\Lang\Object;

trait CloneProperties
{
    public static function fromJson($json)
    {
        return static::fromObject(json_decode($json));
    }

    public static function fromArray($array)
    {
        $keys = array_keys($array);

        $model = new static();
        foreach ($keys as $key) {
            if (property_exists($model, $key)) {
                $model->$key = $array[$key];
            }
        }

        return $model;
    }

    public static function fromObject($object)
    {
        $members = get_object_vars($object);
        $model = new static();

        foreach ($members as $name => $value) {
            $type = gettype($value);

            if ($type == 'string' || $type == 'integer' || $type == 'double' || $type == 'boolean') {
                if (property_exists($model, $name)) {
                    $model->$name = $value;
                }
            }
        }

        return $model;
    }
}
