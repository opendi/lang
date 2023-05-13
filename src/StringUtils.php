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

class StringUtils
{
    /**
     * Finds a string in a pool of strings which is most similar to the given
     * needle.
     *
     * @param string $needle
     * @param array  $wordPool
     */
    public static function mostSimilar($needle, $wordPool)
    {
        $distancePool = [];

        $needle = mb_strtolower($needle);

        foreach ($wordPool as $word) {
            $distance = similar_text($needle, mb_strtolower($word));

            if (!isset($distancePool[$distance])) {
                $distancePool[$distance] = [];
            }

            $distancePool[$distance][] = $word;
        }

        $min = max(array_keys($distancePool));

        // if distance is the same, we just pick the first we can get
        return $distancePool[$min][0];
    }

    public static function plainPhone($area, $extension)
    {
        if ($area == null) {
            $area = "";
        }
        if ($extension == null) {
            $extension = "";
        }

        $phoneNumber = trim($area).trim($extension);

        if ($phoneNumber == "") {
            return null;
        }

        $phoneNumber = str_replace('-', '', $phoneNumber);

        return str_replace(' ', '', $phoneNumber);
    }

    /**
     * Takes a ten digits string and breaks it into NPA (3 digits),
     * NXX (3 digits) and the actual phone number (4 digits).
     *
     * Format: 234-234-2345
     *
     * Returns an array with the keys npa, nxx and num.
     *
     * @param $digits
     */
    public static function normalizePhone($digits)
    {
        $chunks = str_split($digits, 3);

        $result['npa']   = $chunks[0];
        $result['nxx']   = $chunks[1];
        $result['num']   = $chunks[2].$chunks[3];
        $result['seven'] = $chunks[1].'-'.$chunks[2].$chunks[3];
        $result['plainseven'] = $chunks[1].$chunks[2].$chunks[3];
        $result['full']  = $chunks[0].'-'.$result['seven'];

        return $result;
    }

    public static function startsWith($haystack, $needle)
    {
        return !strncmp($haystack, $needle, strlen($needle));
    }

    public static function endsWith($haystack, $needle)
    {
        return substr($haystack, -strlen($needle)) == $needle;
    }

    public static function contains($haystack, $needle)
    {
        if (strpos($haystack, $needle) !== false) {
            return true;
        }

        return false;
    }

    public static function shorten($string, $max = 255)
    {
        $string = trim($string);

        return (mb_strlen($string) > $max) ? mb_strimwidth($string, 0, $max - 3, '...') : $string;
    }

    /**
     * Transliterates an UTF8 string to printable ASCII characters.
     *
     * @param  string  $string    The string to transliterate.
     * @param  string  $substChar The character to use for characters which
     *                            cannot be transliterated.
     * @param  boolean $trim      Whether to trim any subst characters from
     *                            beginning and end of string.
     * @param  boolean $removeDuplicates Whether to remove duplicate subst chars
     *                                   with only one.
     *
     * @return string  The transliterated string.
     */
    public static function translit($string, $substChar = '?', $trim = true, $removeDuplicates = true)
    {
        // Cast scalars to strings, if non-scalar is given throw an exception
        if (!is_string($string)) {
            if (is_scalar($string)) {
                $string = (string) $string;
            } else {
                $type = gettype($string);
                throw new \InvalidArgumentException(__METHOD__ . "() expects parameter 1 to be string, $type given");
            }
        }

        // Replace language-specific characters
        $string = strtr($string, CharacterMap::get());

        // Replace any leftover non-ASCII characters by the replacement char.
        $string = preg_replace("/[^\\w]/", $substChar, $string);

        if ($trim) {
            $string = trim($string, $substChar);
        }

        if ($removeDuplicates) {
            $string = preg_replace("/\\{$substChar}+/", $substChar, $string);
        }

        return $string;
    }

    /**
     * Returns a slugified version of the string.
     *
     * Converts the given string into a string consisting only of lowecase
     * ASCII characters and dashes (-). Used for constructing URLs.
     *
     * @param  string $string String to convert.
     *
     * @return string         Slugified string.
     *
     * @throws InvalidArgumentException If given argument is not a string or is
     *         empty.
     */
    public static function slugify($string)
    {
        if (!is_string($string)) {
            $type = gettype($string);
            throw new \InvalidArgumentException("Given argument is a $type, expected string.");
        }

        if (empty($string)) {
            throw new \InvalidArgumentException("Cannot slugify an empty string.");
        }

        // Replace some language-specific characters which are not handled by
        // iconv transliteration satisfactorily.
        $string = strtr($string, CharacterMap::get());

        // Replace non-alphanumeric characters by "-"
        $string = preg_replace('/[^\\p{L}\\d]+/u', '-', $string);

        // Trim
        $string = trim($string, '-');

        // Transliterate
        $string = iconv('utf-8', 'ASCII', $string);

        // Lowercase
        $string = strtolower($string);

        // Remove unwanted characters
        $string = preg_replace('/[^-\w]+/', '', $string);

        return $string;
    }

    /**
     * Removes line breaks and recurring whitespace from a string.
     *
     * @param  string $string
     * @return string
     */
    public static function oneLiner($string)
    {
        return preg_replace('/\\s+/', ' ', $string);
    }

    /**
     * Replaces all 4-byte unicode characters (characters outside the Basic
     * Multilingual Plane) with the replacement character (0xFFFD).
     *
     * @see https://en.wikipedia.org/wiki/Plane_(Unicode)
     * @see http://unicode.org/reports/tr36/#Deletion_of_Noncharacters
     * @see http://www.fileformat.info/info/unicode/char/fffd/index.htm
     *
     * @param  string $string      Input string.
     * @param  string $replacement Replacement character.
     *
     * @return string Input string with replaced 4-byte characters.
     */
    public static function replaceNonBmp($string, $replacement = "\xEF\xBF\xBD")
    {
        $replaced = preg_replace('/[\\x{10000}-\\x{10FFFF}]/u', $replacement, $string);

        $error = preg_last_error();
        if ($error !== PREG_NO_ERROR) {
            throw new \Exception("Failed replacing non-BMP characters from string. Error code: $error");
        }

        return $replaced;
    }
}
