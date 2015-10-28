<?php
/**
 * QueryString.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Reader;

use AyeAye\Formatter\Reader;

/**
 * Class QueryString
 * Read a query string and turn it into an array.
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
class QueryString implements Reader
{

    /**
     * Read a json string
     * @param $string
     * @return array|null
     */
    public function read($string)
    {
        $array = null;
        parse_str($string, $array);
        return $array;
    }

}