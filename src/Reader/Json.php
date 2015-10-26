<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 09/10/2015
 * Time: 08:36
 */

namespace AyeAye\Formatter\Reader;


use AyeAye\Formatter\Reader;

/**
 * Class Json
 * @package AyeAye\Formatter\Reader
 */
class Json implements Reader
{

    /**
     * Attempt to read a json string
     * @param $string
     * @return object|bool|null
     */
    public function read($string)
    {
        return json_decode($string, true);
    }

}