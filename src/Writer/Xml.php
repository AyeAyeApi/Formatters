<?php
/**
 * Writer data as xml
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Writer;

use AyeAye\Formatter\Formatter;

class Xml extends Formatter
{

    /**
     * The content type for xml data
     * @var string
     */
    protected $contentType = 'application/xml';

    /**
     * What to name things when there's any doubt
     * @var string
     */
    protected $defaultNodeName = 'data';

    /**
     * Schema definition for XML
     * @return string
     */
    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8" ?>';
    }

    /**
     * Format part of the data
     * @param mixed $data The data to be serialised into xml
     * @param string|null $nodeName The node currently being worked on
     * @return string
     */
    public function partialFormat($data, $nodeName = null)
    {
        if (!$nodeName) {
            $nodeName = $this->getNodeName($data);
        }
        $data = $this->parseData($data);

        if (is_scalar($data)) {
            return "<$nodeName>" . $this->parseScalarData($data) . "</$nodeName>";
        }
        return "<$nodeName>".$this->parseNonScalarData($data, $nodeName)."</$nodeName>";
    }

    /**
     * Try to guess the node name
     * @param mixed $data Data to try to find the name of
     * @return mixed|string
     */
    protected function getNodeName($data)
    {
        if (is_object($data)) {
            $nodeName = preg_replace('/.*\\\/', '', get_class($data));
            return preg_replace('/\W/', '', $nodeName);
        } elseif (is_array($data)) {
            return 'array';
        }
        return $this->defaultNodeName;
    }

    /**
     * Turn scalar data into something safe for xml
     * @param $data
     * @return string
     */
    protected function parseScalarData($data)
    {
        if (is_bool($data)) {
            return $data ? 'true' : 'false';
        }
        return htmlspecialchars($data);
    }

    /**
     * Recurse through non scalar data, serializing it
     * @param array|object $data
     * @param string|null $fallbackName The name to use for an element in the event it doesn't have one
     * @return string
     */
    protected function parseNonScalarData($data, $fallbackName = null)
    {
        $xml = '';
        if (!$fallbackName) {
            $fallbackName = $this->defaultNodeName;
        }
        foreach ($data as $property => $value) {
            // Clear non-alphanumeric characters
            $property = preg_replace('/\W/', '', $property);

            // If numeric we'll stick a character in front of it, a bit hack but should be valid
            if (is_numeric($property)) {
                $property = $fallbackName;
            }
            $xml .= $this->partialFormat($value, $property);
        }
        return $xml;

    }
}
