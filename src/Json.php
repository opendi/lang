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
namespace Opendi\Lang;

/**
 * Helper class for encoding and decoding JSON.
 */
class Json
{
    /**
     * Behaves exactly like json_encode, but throws an exception on failure.
     *
     * @see http://php.net/manual/en/function.json-encode.php
     */
    public static function encode()
    {
        $return = call_user_func_array('json_encode', func_get_args());

        $error = self::getLastError();
        if ($error !== null) {
            throw new \Exception("Failed encoding JSON: $error");
        }

        return $return;
    }

    /**
     * Behaves exactly like json_decode, but throws an exception on failure.
     *
     * @see http://php.net/manual/en/function.json-decode.php
     */
    public static function decode()
    {
        $return = call_user_func_array('json_decode', func_get_args());

        $error = self::getLastError();
        if ($error !== null) {
            throw new \Exception("Failed decoding JSON: $error");
        }

        return $return;
    }

    /**
     * Returns the last JSON error as a string, or null if there was no error.
     *
     * @return string
     */
    private static function getLastError()
    {
        $errorCode = json_last_error();

        if ($errorCode === JSON_ERROR_NONE) {
            return null;
        }

        if (function_exists('json_last_error_msg')) {
            return json_last_error_msg();
        }

        return "JSON error code: $errorCode";
    }
}
