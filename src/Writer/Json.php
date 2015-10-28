<?php
/**
 * Json.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Writer;

use AyeAye\Formatter\Formatter;

/**
 * Class Json
 * Write data as a Json formatted string
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
class Json extends Formatter
{

    /**
     * Override content type
     * @var string
     */
    protected $contentType = 'application/json';

    /**
     * Format part of the data
     * @param mixed $data The data to be serialised into json
     * @param string|null $name Not used for json encoding
     * @return string
     */
    public function partialFormat($data, $name = null)
    {
        return json_encode($this->parseData($data));
    }
}
