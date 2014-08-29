<?php
/**
 * Formats data as json
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace Gisleburt\Formatter\Formats;


use Gisleburt\Formatter\Formatter;

class Php extends Formatter {

    protected $callbackContentType = 'application/php';

    protected $callbackName;

    public function __construct($callbackName = null) {
        $this->setCallbackName($callbackName);
    }

    public function getContentType() {
        if($this->callbackName) {
            return $this->callbackContentType;
        }
        return parent::getContentType();
    }

    /**
     * Set the name of the javascript function that will be called
     * @param $callbackName
     */
    public function setCallbackName($callbackName) {
        $this->callbackName = $callbackName;
    }

    public function getHeader() {
        if($this->callbackName) {
            return '<?php ';
        }
        return parent::getHeader();
    }

    public function format($data, $name = null) {
        $serialisedData = serialize($data);
        if($this->callbackName) {
            $serialisedData = $this->callbackName."(unserialize('$serialisedData'));";
        }
        return $serialisedData;
    }

} 