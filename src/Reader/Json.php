<?php
/**
 * Json.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Reader;

use AyeAye\Formatter\Reader;

/**
 * Class Json
 * Read a Json formatted string and turn it into an array.
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
class Json implements Reader
{

    /**
     * Attempt to read a json string
     * @param $string
     * @return array|null
     */
    public function read($string)
    {
        return json_decode($string, true);
    }
}
