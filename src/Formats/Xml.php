<?php
/**
 * Formats data as xml
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace Gisleburt\Formatter\Formats;


use Gisleburt\Formatter\Formatter;

class Xml extends Formatter {

    protected $contentType = 'application/xml';

    protected $numericArrayPrefix = '_';

    protected $defaultNodeName = 'data';

    public function getHeader() {
        return '<?xml version="1.0" encoding="UTF-8" ?>';
    }

    public function format($data, $nodeName = null) {

        if(!$nodeName) {
            if(is_object($data)) {
                $nodeName = preg_replace('/.*\\\/', '', get_class($data));
                $nodeName = preg_replace('/\W/', '', $nodeName);
            }
            elseif(is_array($data)) {
                $nodeName = 'array';
            }
            else {
                $nodeName = $this->defaultNodeName;
            }
        }

        $xml = "<$nodeName>";

        if(is_scalar($data)) {
            if(is_bool($data)) {
                $xml = $data ? 'true' : 'false';
            }
            else{
                $xml .= htmlspecialchars($data);
            }
        }
        else {
            if($data instanceof \JsonSerializable) {
                $xml .= $this->format($data->jsonSerialize());
            }
            else {
                foreach($data as $property => $value) {
                    // Clear non-alphanumeric characters
                    $property = preg_replace('/\W/', '', $property);

                    // If numeric we'll stick a character in front of it, a bit hack but should be valid
                    if(is_numeric($property)) {
                        $property = $this->numericArrayPrefix.$property;
                    }
                    $xml .= $this->format($value, $property);
                }
            }
        }

        $xml .= "</$nodeName>";

        return $xml;
    }

} 