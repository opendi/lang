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

trait PropertyAccess
{
    public function get($name, $default = null) {
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
