<?php
namespace Opendi\Lang\Object;


trait PropertyAccess {

    function get($name, $default = null) {
        if (property_exists($this, $name)) {
            if (isset($this->$name)) {
                return $this->$name;
            }
        }

        if (isset($default)) {
            return $default;
        }

        return EmptyAccessObject::getInstance();
    }
} 