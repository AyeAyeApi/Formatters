<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 09/10/2015
 * Time: 08:29
 */

namespace AyeAye\Formatter;

/**
 * Class Reader
 * @package AyeAye\Formatter
 */
interface Reader
{

    /**
     * @param $string
     * @return array
     */
    public function read($string);

}