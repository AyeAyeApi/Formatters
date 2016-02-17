<?php
/**
 * Jsonp.php
 * @author    Daniel Mason <daniel@ayeayeapi.com>
 * @copyright 2015 - 2016 Daniel Mason <daniel@ayeayeapi.com>
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Writer;

use AyeAye\Formatter\Writer;

/**
 * Class Jsonp
 * Write data as a Json formatted string inside a javascript callback
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
class Jsonp extends Json
{

    /**
     * Override content type
     * @var string
     */
    protected $contentType = 'application/javascript';

    /**
     * The name of the callback
     * @var string
     */
    protected $callbackName = 'callback';

    /**
     * Give the name of the callback to be used for jsonp
     * @param string|null $callbackName
     */
    public function __construct($callbackName = null)
    {
        if ($callbackName) {
            // TODO: Test name
            $this->callbackName = $callbackName;
        }
    }

    /**
     * Returns callback name plus the first part of the wrapper around the data
     * @return string
     */
    public function getHeader()
    {
        return "{$this->callbackName}('";
    }

    /**
     * Returns the end of the wrapper around the data
     * @return string
     */
    public function getFooter()
    {
        return "');";
    }
}
