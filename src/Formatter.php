<?php
/**
 * Format data before sending it to client
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter;

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
     * Format the entire file/output
     * @param mixed $data
     * @param string|null $name
     * @return string
     */
    public function fullFormat($data, $name = null)
    {
        return $this->getHeader()
        . $this->format($data, $name)
        . $this->getFooter();
    }

    /**
     * Format part of the data
     * @param mixed $data
     * @param string|null $name
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
