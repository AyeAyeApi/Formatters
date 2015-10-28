<?php
/**
 * Serializable.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter;

/**
 * Interface Serializable
 * Describe what data should be used when serializing.
 * This method should be called before passing to a writer
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
interface Serializable
{

    /**
     * Return an array of data to be serialized
     * @returns array
     */
    public function ayeAyeSerialize();
}
