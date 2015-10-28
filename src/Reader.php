<?php
/**
 * Reader.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter;

/**
 * Interface Reader
 * Read a formatted string and turn it back into data
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
interface Reader
{

    /**
     * @param $string
     * @return array
     */
    public function read($string);

}