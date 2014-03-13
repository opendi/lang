<?php
/**
 *
 */

namespace Opendi\Lang\Object;

trait CloneProperties {

    public static function fromJson($json) {
        return self::fromObject(json_decode($json));
    }

    public static function fromArray($array) {
        $keys = array_keys($array);

        $model = new self();
        foreach ($keys as $key) {
            if (property_exists($model, $key)) {
                $model->$key = $array[$key];
            }
        }

        return $model;
    }

    public static function fromObject($object) {
        $members = get_object_vars($object);
        $model = new self();

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