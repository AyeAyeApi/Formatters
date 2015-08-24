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
     * @param mixed $data
     * @param string|null $name
     * @return string
     */
    public function format($data, $name = null)
    {
        return json_encode($data);
    }
}
