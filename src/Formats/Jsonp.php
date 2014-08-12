<?php
/**
 * Formats data as json
 * @author Daniel Mason
 * @copyright Loft Digital, 2014
 */

namespace Gisleburt\Formatter\Formats;


use Gisleburt\Formatter\Format;

class Jsonp extends Format {

    public function sendHeaders() {
        header('Content-Type: application/json');
    }

    public function format($data, $name = null) {
        return json_encode($data);
    }

} 