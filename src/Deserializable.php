<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 24/08/15
 * Time: 19:10
 */

namespace AyeAye\Formatter;

/**
 * Interface AyeAyeDeserializable
 * @package AyeAye\Formatter
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
