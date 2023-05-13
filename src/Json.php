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

namespace Opendi\Lang;

use Exception;

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
    public static function encode() {
        $return = call_user_func_array('json_encode', func_get_args());

        $error = self::getLastError();
        if ($error !== null) {
            throw new Exception("Failed encoding JSON: $error");
        }

        return $return;
    }

    /**
     * Behaves exactly like json_decode, but throws an exception on failure.
     *
     * @see http://php.net/manual/en/function.json-decode.php
     */
    public static function decode() {
        $return = call_user_func_array('json_decode', func_get_args());

        $error = self::getLastError();
        if ($error !== null) {
            throw new Exception("Failed decoding JSON: $error");
        }

        return $return;
    }

    /**
     * Loads and decodes JSON data from a file.
     *
     * @param string $path Path to the JSON file.
     * @param boolean $assoc If true, will return an array instead of an
     *                          object.
     * @param integer $depth User specified recursion depth.
     * @param integer $options Bitmask of JSON decode options.
     *
     * @return mixed        Decoded json data.
     *
     * @throws Exception If decoding JSON data or reading the file fails.
     */
    public static function load($path, $assoc = false, $depth = 512, $options = 0) {
        $json = file_get_contents($path);
        if ($json === false) {
            $error = error_get_last();
            throw new Exception("Failed reading JSON data from file: " . $error['message']);
        }

        return self::decode($json, $assoc, $depth, $options);
    }

    /**
     * Encodes data to JSON and saves it to a file.
     *
     * @param mixed $data Data to encode.
     * @param string $path Path to the target file.
     * @param integer $options Options for json_encode.
     * @param integer $depth The maximum depth.
     *
     * @return integer          Number of bytes that were written to the file.
     *
     * @throws Exception If encoding data to JSON or writing the file fails.
     */
    public static function dump($data, $path, $options = 0, $depth = 512) {
        $json = self::encode($data, $options, $depth);

        $result = file_put_contents($path, $json);
        if ($result === false) {
            $error = error_get_last();
            throw new Exception("Failed writing JSON data to file: " . $error['message']);
        }

        return $result;
    }

    /**
     * Returns the last JSON error as a string, or null if there was no error.
     *
     * @return string
     */
    private static function getLastError() {
        $errorCode = json_last_error();

        if ($errorCode === JSON_ERROR_NONE) {
            return null;
        }

        if (function_exists('json_last_error_msg')) {
            return json_last_error_msg();
        }

        // Unreachable for PHP 5.5+
        // @codeCoverageIgnoreStart
        return "JSON error code: $errorCode";
        // @codeCoverageIgnoreEnd
    }
}
