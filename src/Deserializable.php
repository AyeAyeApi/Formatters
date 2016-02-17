<?php
/**
 * Deserializable.php
 * @author    Daniel Mason <daniel@ayeayeapi.com>
 * @copyright 2015 - 2016 Daniel Mason <daniel@ayeayeapi.com>
 * @license   MIT
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
     * @param mixed $data
     * @return static
     */
    public function ayeAyeDeserialize($data);
}
