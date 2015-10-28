<?php
/**
 * Formatter.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter;

/**
 * Abstract Class Formatter
 * The basics of turning data into a formatted string
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
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
    public function format($data, $name = null)
    {
        return $this->getHeader()
        . $this->partialFormat($data, $name)
        . $this->getFooter();
    }

    /**
     * Format part of the data
     * @param mixed $data
     * @param string|null $name
     * @return string
     */
    abstract public function partialFormat($data, $name = null);

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

    /**
     * Recursively turn data into arrays for output.
     * This method is used to make sure only desired data is output from objects.
     * AyeAye\Formatters\Serializable takes precedence over JsonSerializable, everything else is cast straight to array
     * @param Serializable|\JsonSerializable|mixed $data
     * @return array
     */
    protected function parseData($data)
    {
        if (is_scalar($data)) {
            return $data;
        }

        if ($data instanceof Serializable) {
            $data = $data->ayeAyeSerialize();
        } elseif ($data instanceof \JsonSerializable) {
            $data = $data->jsonSerialize();
        } elseif (!is_array($data)) {
            $data = (array)$data;
        }

        foreach ($data as $key => $value) {
            $data[$key] = $this->parseData($value);
        }

        return $data;
    }
}
