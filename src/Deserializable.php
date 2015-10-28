<?php
/**
 * Deserializable.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter;

/**
 * Interface Deserializable
 * Provide functionality for a class to be instantiated and populated by an array
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
interface Deserializable
{

    /**
     * Take data and apply it to a fresh object
     * @param array $data
     * @return static
     */
    public static function ayeAyeDeserialize(array $data);
}
