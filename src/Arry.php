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

use Exception;
use InvalidArgumentException;


/**
 * Helper class for encoding and decoding JSON.
 */
class Arry
{
    /**
     * Flattens a deep array to a single dimension.
     *
     * @param array  $array      Array to flatten.
     * @param string $separator  Separator used to divide key values.
     * @param string $prefix     Initial key prefix. Empty by default.
     *
     * @throws InvalidArgumentException if a non-array value is given
     */
    public static function flatten(array $array, $separator = '.', $prefix = '')
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $newPrefix = empty($prefix) ? $key : "$prefix.$key";
                $result = array_merge($result, self::flatten($value, $separator, $newPrefix));
            } else {
                $newKey = empty($prefix) ? $key : "$prefix.$key";
                $result[$newKey] = $value;
            }
        }

        return $result;
    }

    /**
     * Reindexes an array. Each array element will get a new key based on the
     * $path parameter. Returns the reindexed array, does not change the input
     * array itself.
     *
     * @param array $array the array to reindex
     *
     * @param string|array $path path of the element within the array to use as
     *                           new key
     *
     * @param boolean $overwriteDuplicates Dictates how to treat duplicate keys
     *                                     in the new array. If set to true,
     *                                     elements with duplicate keys will be
     *                                     overwritten. If set to false
     *                                     (default) duplicate key will raise an
     *                                     exception.
     *
     * @throws Exception If a duplicate key is encountered and
     *                   $overwriteDuplicates is set to false (default).
     * @throws Exception If a key which is not string or integer is encountered
     * @throws Exception If the defined path does not exist in any element of
     *                   the array.
     *
     * @return array The reindexed array
     */
    public static function reindex($array, $path, $overwriteDuplicates = false)
    {
        $path = self::processReindexPath($path);

        $newArray = [];
        foreach ($array as $key => $item) {
            $keys = [];
            foreach ($path as $subpath) {
                $keys[] = self::fetchInnerElement($item, $subpath);
            }

            $subArray = &$newArray;
            $numKeys = count($keys);

            foreach ($keys as $id => $key) {
                if ($id == $numKeys - 1) {
                    // Last key - copy this subArray to newArray
                    if (!$overwriteDuplicates && isset($subArray[$key])) {
                        $strKeys = implode(':', $keys);
                        throw new Exception("Duplicate key [$strKeys] found while reindexing. Set \$overwriteDuplicates argument to true to overwrite duplicate keys.");
                    }
                    $subArray[$key] = $item;
                } else {
                    // Not last key - keep going deeper
                    if (!isset($subArray[$key])) {
                        $subArray[$key] = [];
                    }
                    $subArray = &$subArray[$key];
                }
            }
        }

        return $newArray;
    }

    /** Processes and validates the given index path. */
    private static function processReindexPath($path)
    {
        if (is_string($path) || is_integer($path)) {
            // Single level path - one element only
            $path = array(array($path));
        } elseif (is_array($path) && !empty($path) && !is_array($path[0])) {
            // Single level path - multiple elements
            // Check each path element is either a string or an integer
            foreach ($path as $key) {
                if (!(is_string($key) || is_integer($key))) {
                    throw new InvalidArgumentException('Invalid reindex path.');
                }
            }

            $path = array($path);
        } elseif (is_array($path) && !empty($path) && is_array($path[0])) {
            // Multilevel path
            // Check each path element is an array (a sub-path)
            foreach ($path as $subpath) {
                if (!is_array($subpath) || empty($subpath)) {
                    throw new InvalidArgumentException('Invalid reindex path.');
                }

                // Check each sub-path element is a valid array key (either a string or an integer)
                foreach ($subpath as $key) {
                    if (!(is_string($key) || is_integer($key))) {
                        throw new InvalidArgumentException('Invalid reindex path.');
                    }
                }
            }
        } else {
            throw new InvalidArgumentException('Invalid reindex path.');
        }

        return $path;
    }

    /**
     * Fetches a value from a (multilevel) array.
     *
     * For example, given the following array:
     * <pre>
     *  array(
     *      'foo' => array(
     *          'bar' => 1
     *      )
     *      'baz' => 2
     *  )
     * </pre>
     *
     * Given path array("foo", "bar") the function will return 1.
     * Given path array("baz"), or just "baz", the function will return 2.
     *
     * @throws InvalidArgumentException if $array is not an array
     * @throws InvalidArgumentException if $path if the given path is not found
     * in the array. For example, using the path array('foo', 'baz') in the
     * previous example.
     *
     * @param array $array the array to look in
     * @param mixed $path array key, or an array of keys representing the path
     * to the element to fetch in the array
     * @return the element
     */
    public static function fetchInnerElement($array, $path)
    {
        if (is_object($array)) {
            $array = (array) $array;
        }

        if (!is_array($array)) {
            $type = gettype($array);
            throw new InvalidArgumentException("Expected \$array to be an array. [$type] given.");
        }

        $path = is_array($path) ? $path : array($path);

        foreach ($path as $key) {
            if (!isset($array[$key])) {
                $path = implode(', ', $path);
                throw new InvalidArgumentException("Path [$path] not found in array.");
            }
            $array = $array[$key];
        }

        return $array;
    }
}
