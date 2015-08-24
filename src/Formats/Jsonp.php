<?php
/**
 * Formats data as json
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Formats;

use AyeAye\Formatter\Formatter;

class Jsonp extends Formatter
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
        if($callbackName) {
            // TODO: Test name
            $this->callbackName = $callbackName;
        }
    }

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

    /**
     * Get anything that must come before any data
     * @return string
     */
    public function getHeader()
    {
        return "{$this->callbackName}(";
    }

    /**
     * Get anything that must come after data
     * @return string
     */
    public function getFooter()
    {
        return ");";
    }
}
