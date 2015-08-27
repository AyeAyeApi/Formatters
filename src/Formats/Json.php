<?php
/**
 * Formats data as json
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Formats;

use AyeAye\Formatter\Formatter;

class Json extends Formatter
{

    protected $contentType = 'application/json';

    public function format($data, $name = null)
    {
        return json_encode($this->parseData($data));
    }
}
