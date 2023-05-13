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

namespace Opendi\Lang\Object;

use Closure;
use InvalidArgumentException;

trait CloneProperties
{
    public static function fromJson($json) {
        return static::fromObject(json_decode($json));
    }

    /**
     * Returns a new object with properties set from
     * matching array keys
     *
     * @param $array
     * @return static
     * @throws InvalidArgumentException
     */
    public static function fromArray($array) {
        if (!is_array($array)) {
            throw new InvalidArgumentException("Expected array, got " . gettype($array));
        }

        $model = new static();

        foreach ($array as $key => $value) {
            if (property_exists($model, $key)) {
                $model->$key = $value;
            }
        }

        return $model;
    }

    /**
     * This method guarantees to first set scalar values and public properties,
     * then to set complex objects using set-methods.
     *
     * set-methods may need additional information which is only set
     * when using the right order.
     *
     * @param $object
     * @param Closure $before
     * @return static
     * @throws InvalidArgumentException
     */
    public static function fromObject($object, $before = null) {
        if (!is_object($object)) {
            throw new InvalidArgumentException("Expected object, got " . gettype($object));
        }

        $model = new static();

        /**
         * In some cases the model needs to be manipulated before
         * any properties are set. Example: Yext ECL models.
         */
        if (is_callable($before)) {
            $before($model);
        }

        $backlog = [];
        $members = get_object_vars($object);
        foreach ($members as $key => $value) {
            // TODO: determine if is_scalar is required here
            if (is_scalar($value) && property_exists($model, $key)) {
                $model->$key = $value;
            } else {
                // First set all properties, then set methods
                $backlog[$key] = $value;
            }
        }

        foreach ($backlog as $key => $value) {
            /**
             * Some objects don't provide public access to properties.
             * If we can't find the property, we try to find a setter method instead.
             *
             * Methods need to follow the usual setValue schema.
             *
             * @var $key string name of the property
             * @var $value string the value to set
             */
            $setter = 'set' . ucfirst($key);
            if (method_exists($model, $setter)) {
                $model->{$setter}($value);
            }
        }

        return $model;
    }
}
