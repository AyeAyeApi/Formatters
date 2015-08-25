<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 24/08/15
 * Time: 19:10
 */

namespace AyeAye\Formatter;

/**
 * Interface AyeAyeUnserializable
 * @package AyeAye\Formatter
 */
interface AyeAyeUnserializable
{

    /**
     * Take data and apply it to a fresh object
     * @return static
     */
    public static function ayeAyeUnserialize($data);
}