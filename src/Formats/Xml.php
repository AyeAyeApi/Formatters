<?php
/**
 * Formats data as xml
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Formats;


use AyeAye\Formatter\Formatter;

class Xml extends Formatter
{

    protected $contentType = 'application/xml';

    protected $numericArrayPrefix = '_';

    protected $defaultNodeName = 'data';

    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8" ?>';
    }

    public function format($data, $nodeName = null)
    {

        if (!$nodeName) {
            $nodeName = $this->getNodeName($data);
        }

        $xml = "<$nodeName>";

        if (is_scalar($data)) {
            $xml .= $this->parseScalarData($data);
        } else {
            $xml .= $this->parseNonScalarData($data);
        }

        $xml .= "</$nodeName>";

        return $xml;
    }

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

    protected function parseScalarData($data)
    {
        if (is_bool($data)) {
            return $data ? 'true' : 'false';
        }
        return htmlspecialchars($data);
    }

    protected function parseNonScalarData($data)
    {
        if ($data instanceof \JsonSerializable) {
            return $this->format($data->jsonSerialize());
        }

        $xml = '';
        foreach ($data as $property => $value) {
            // Clear non-alphanumeric characters
            $property = preg_replace('/\W/', '', $property);

            // If numeric we'll stick a character in front of it, a bit hack but should be valid
            if (is_numeric($property)) {
                $property = $this->numericArrayPrefix . $property;
            }
            $xml .= $this->format($value, $property);
        }
        return $xml;

    }

}