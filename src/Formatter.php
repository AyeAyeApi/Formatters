<?php
/**
 * Format data before sending it to client
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace Gisleburt\Formatter;


abstract class Formatter
{

    protected $contentType = 'text/plain';

    /**
     * Send document headers
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Format the data
     * @param $data
     * @param $name string|null
     * @return string
     */
    abstract public function format($data, $name = null);

    /**
     * Get anything that must come before any data
     * @return string
     */
    public function getHeader()
    {
        return '';
    }

    /**
     * Get anything that must come after data
     * @return string
     */
    public function getFooter()
    {
        return '';
    }

} 