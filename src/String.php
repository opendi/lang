<?php
namespace Opendi\Lang;

class String
{
    /**
     * @param string $needle
     * @param array  $wordPool
     */
    public static function mostSimilar($needle, $wordPool)
    {
        $distancePool = [];

        $needle = strtolower($needle);

        foreach ($wordPool as $word) {
            $distance = levenshtein($needle, strtolower($word));

            if (!isset($distancePool[$distance])) {
                $distancePool[$distance] = [];
            }

            $distancePool[$distance][] = $word;
        }

        $min = min(array_keys($distancePool));

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

        // Replace non-alphanumeric characters by "-"
        $string = preg_replace('/[^\\p{L}\\d]+/u', '-', $string);

        // Trim
        $string = trim($string, '-');

        // Transliterate
        $string = iconv('utf-8', 'ASCII//TRANSLIT', $string);

        // Lowercase
        $string = strtolower($string);

        // Remove unwanted characters
        $string = preg_replace('/[^-\w]+/', '', $string);

        return $string;
    }
}
