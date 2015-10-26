<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 09/10/2015
 * Time: 08:31
 */

namespace AyeAye\Formatter\Reader;


use AyeAye\Formatter\Reader;

class Xml implements Reader
{

    /**
     * Attempt to read an XML docuent
     * @param string $string
     * @return null|\SimpleXMLElement
     */
    public function read($string)
    {
        try {
            $wasUsingErrors = libxml_use_internal_errors();
            $xmlObject = simplexml_load_string($string);
            libxml_use_internal_errors($wasUsingErrors);
            if ($xmlObject) {
                return $this->recurseToArray($xmlObject);
            }
        } catch (\Exception $e) {
            // Do nothing
        }
        return null;
    }

    /**
     * @param $object
     * @return array
     */
    protected function recurseToArray($object)
    {
        if(is_scalar($object)) {
            return $object;
        }
        $array = (array)$object;
        foreach($array as &$value) {
            if(!is_scalar(($value))) {
//                if($value instanceof \SimpleXMLElement) {
//                    $value = $this->recurseToArray($value);
//                    continue;
//                }
                $value = $this->recurseToArray($value);
                continue;
            }
        }
        return $array;
    }

}