<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 24/08/15
 * Time: 19:10
 */

namespace AyeAye\Formatter;

/**
 * Interface AyeAyeSerializable
 * @package AyeAye\Formatter
 */
interface Serializable
{

    /**
     * Return an object or array of data to be serialized
     */
    public function ayeAyeSerialize();
}