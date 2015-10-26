<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 09/10/2015
 * Time: 08:40
 */

namespace AyeAye\Formatter\Reader;


use AyeAye\Formatter\Reader;

/**
 * Class QueryString
 * @package AyeAye\Formatter\Reader
 */
class QueryString implements Reader
{

    /**
     * @param $string
     * @return null|array
     */
    public function read($string)
    {
        $array = null;
        parse_str($string, $array);
        return $array;
    }

}