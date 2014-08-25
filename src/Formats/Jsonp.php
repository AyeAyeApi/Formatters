<?php
/**
 * Formats data as json
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace Gisleburt\Formatter\Formats;


use Gisleburt\Formatter\Format;

class Jsonp extends Format {

    protected $contentType = 'application/javascript';

    protected $callbackName;


    public function __construct($callbackName = null) {
        $this->setCallbackName($callbackName);
    }

    /**
     * Set the name of the javascript function that will be called
     * @param $callbackName
     */
    public function setCallbackName($callbackName) {
        $this->callbackName = $callbackName;
    }

    public function format($data, $name = null) {
        $callbackName = $this->callbackName;
        if(!$callbackName) {
            $callbackName = $name ? $name : 'callback';
        }
        $json = json_encode($data);
        return "$callbackName($json);";
    }

} 