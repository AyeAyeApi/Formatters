<?php
/**
 * Reader.php
 * @author    Daniel Mason <daniel@ayeayeapi.com>
 * @copyright 2015 - 2016 Daniel Mason <daniel@ayeayeapi.com>
 * @license   MIT
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
