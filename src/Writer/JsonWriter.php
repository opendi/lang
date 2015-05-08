<?php

namespace Opendi\Lang\Writer;

use Opendi\Lang\Json;

use Iterator;
use SplFileInfo;
use SplFileObject;

/**
 * Writes JSON content to files with rollover support.
 */
class JsonWriter
{
    /** Force JSON object output. */
    const FLAG_AS_OBJECT = 0x1;

    /** Force JSON array output. */
    const FLAG_AS_ARRAY = 0x2;

    /** Nicely indent JSON output. */
    const FLAG_PRETTY_PRINT = 0x4;

    /**
     * Writes data to a JSON file.
     *
     * If a $threshold is given, files will be enumerated with ordinal numbers,
     * for example if $path = "/path/to/file.json" is given, the data will be
     * written in files:
     *
     * - /path/to/file.00001.json
     * - /path/to/file.00002.json
     * - /path/to/file.00003.json
     * - etc.
     *
     * By default, the writer will output a JSON array if given $data has
     * integer keys, and a JSON object for string keys. This can be forced
     * by setting one of FLAG_AS_ARRAY or FLAG_AS_OBJECT in $flags.
     *
     * @param  string   $path      Path to the file to write.
     * @param  Iterator $data      An iterator or generator yielding the data.
     * @param  numeric  $threshold Max. file size in bytes (null for no limit).
     * @param  integer  $flags     Additional options, see FLAG_* constants.
     */
    public function write($path, Iterator $data, $threshold = null, $flags = 0)
    {
        $asObject = $this->isAsObject($data, $flags);
        $pretty = $flags & self::FLAG_PRETTY_PRINT;
        $jsonFlags = $pretty ? JSON_PRETTY_PRINT : 0;

        // When a threshold is given, enumerate files
        $ord = isset($threshold) ? 1 : null;

        $file = $this->open($path, $asObject, $pretty, $ord);

        while($data->valid()) {
            if ($pretty) {
                $file->fwrite("\t");
            }

            if ($asObject) {
                $file->fwrite('"' . $data->key() . '": ');
            }

            $file->fwrite(Json::encode($data->current(), $jsonFlags));

            // Move to next item to see if next exists
            $data->next();
            $hasNext = $data->valid();

            // Check whether a rollover is necessary
            $shouldRollover = $this->shouldRollover($file, $threshold);

            // Write a comma separator if it's not the last item for this file
            if (!$shouldRollover && $hasNext) {
                $file->fwrite(",");
            }

            if ($pretty) {
                $file->fwrite("\n");
            }

            if ($shouldRollover && $hasNext) {
                $ord += 1;
                $file = $this->rollover($file, $asObject, $path, $pretty, $ord);
            }
        }

        $this->close($file, $asObject, $pretty);
    }

    protected function isAsObject(Iterator $data, $flags)
    {
        if ($flags & self::FLAG_AS_OBJECT  && $flags & self::FLAG_AS_ARRAY) {
            throw new \Exception("It's not allowed to set both FLAG_AS_OBJECT and FLAG_AS_ARRAY.");
        }

        if ($flags & self::FLAG_AS_OBJECT) {
            return true;
        }

        if ($flags & self::FLAG_AS_ARRAY) {
            return false;
        }

        // If no preference is given, treat data with non-integer keys as
        // an object and data with integer keys as an array.
        return !is_int($data->key());
    }

    protected function shouldRollover($file, $threshold)
    {
        if (isset($threshold)) {
            clearstatcache();
            return $file->getSize() > $threshold;
        }

        return false;
    }

    protected function open($path, $asObject, $pretty, $ord = null)
    {
        if (isset($ord)) {
            $parts = pathinfo($path);
            $ord = str_pad($ord, 5, '0', STR_PAD_LEFT);
            $path = "{$parts['dirname']}/{$parts['filename']}.$ord.{$parts['extension']}";
        }

        $info = new SplFileInfo($path);
        $file = $info->openFile('w');
        $file->fwrite($asObject ? '{' : '[');

        if ($pretty) {
            $file->fwrite("\n");
        }

        return $file;
    }

    protected function close(SplFileObject $file, $asObject, $pretty)
    {
        if ($pretty) {
            $file->fwrite("\n");
        }

        $file->fwrite($asObject ? '}' : ']');
    }

    protected function rollover(SplFileObject $file, $asObject, $path, $pretty, $ord)
    {
        $this->close($file, $asObject, $pretty);

        return $this->open($path, $asObject, $pretty, $ord);
    }
}
