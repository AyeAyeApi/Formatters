<?php
/**
 * Xml.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Reader;

use AyeAye\Formatter\Reader;

/**
 * Class Xml
 * Read an Xml formatted string and turn it into an array.
 * Note: repeated elements which are perfectly valid will overwrite previous elements with this reader
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
class Xml implements Reader
{

    /**
     * Attempt to read an XML document
     * @param string $string
     * @return array|null
     */
    public function read($string)
    {
        try {
            $wasUsingErrors = libxml_use_internal_errors();
            $xmlObject = simplexml_load_string($string);
            libxml_use_internal_errors($wasUsingErrors);
            if ($xmlObject) {
                return $this->recurseToArray($xmlObject);
            }
        } catch (\Exception $e) {
            // Do nothing
        }
        return null;
    }

    /**
     * Recurse through non scalars turning them into arrays, just returns scalars as is.
     * @param $object
     * @return mixed
     */
    protected function recurseToArray($object)
    {
        if (is_scalar($object)) {
            return $object;
        }
        $array = (array)$object;
        foreach ($array as &$value) {
            if (!is_scalar(($value))) {
                $value = $this->recurseToArray($value);
                continue;
            }
        }
        return $array;
    }
}
