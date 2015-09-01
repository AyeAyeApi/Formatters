<?php
/**
 * Formats data as json
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Formats;

use AyeAye\Formatter\Formatter;

/**
 * Class Json
 * @package AyeAye\Formatter\Formats
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
