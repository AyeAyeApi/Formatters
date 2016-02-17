<?php
/**
 * Json.php
 * @author    Daniel Mason <daniel@ayeayeapi.com>
 * @copyright 2015 - 2016 Daniel Mason <daniel@ayeayeapi.com>
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Writer;

use AyeAye\Formatter\Writer;

/**
 * Class Json
 * Write data as a Json formatted string
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
class Json extends Writer
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
