<?php
/**
 * Test the Json Formatter
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace Gisleburt\Formatter\Tests;

use Gisleburt\Formatter\Formats\Jsonp;

class JsonpFormatterTest extends TestCase
{

    public function testContentType()
    {
        $jsonpFormatter = new Jsonp();
        $contentType = $jsonpFormatter->getContentType();
        $this->assertTrue(
            $contentType === 'application/javascript',
            'Incorrect content type for Jsonp'
        );
    }

    public function testHeader()
    {
        $jsonpFormatter = new Jsonp();
        $this->assertTrue(
            $jsonpFormatter->getHeader() === '',
            'Jsonp header was not an empty string'
        );
    }

    public function testFooter()
    {
        $jsonpFormatter = new Jsonp();
        $this->assertTrue(
            $jsonpFormatter->getFooter() === '',
            'Jsonp footer was not an empty string'
        );
    }

    public function testSimpleObjectJsonp()
    {
        $blankObject = new \stdClass();
        $jsonpFormatter = new Jsonp();
        $this->assertTrue(
            $jsonpFormatter->format($blankObject) === 'callback({});',
            'Jsonp did not contain an empty object with default callback name'
        );
        $jsonpFormatter->setCallbackName('testCallback');
        $this->assertTrue(
            $jsonpFormatter->format($blankObject) === 'testCallback({});',
            'Jsonp did not contain an empty object with test callback name'
        );
    }

    public function testSimpleArrayJsonp()
    {
        $blankArray = [];
        $jsonpFormatter = new Jsonp();
        $this->assertTrue(
            $jsonpFormatter->format($blankArray) === 'callback([]);',
            'Jsonp did not contain an empty array with default callback name'
        );
        $jsonpFormatter->setCallbackName('testCallback');
        $this->assertTrue(
            $jsonpFormatter->format($blankArray) === 'testCallback([]);',
            'Jsonp did not contain an empty array with test callback name'
        );
    }

    public function testComplexObject()
    {
        $complexObject = (object)[
            'childObject' => (object)[
                    'property' => 'value'
                ],
            'childArray' => [
                'element1',
                'element2'
            ]
        ];
        $expectedJson = '{"childObject":{"property":"value"},"childArray":["element1","element2"]}';

        $jsonpFormatter = new Jsonp();
        $json = $jsonpFormatter->format($complexObject);
        $this->assertTrue(
            $json === "callback($expectedJson);",
            'Jsonp did not contain an complex object with default callback name'
        );

        $jsonpFormatter->setCallbackName('testCallback');
        $json = $jsonpFormatter->format($complexObject);
        $this->assertTrue(
            $json === "testCallback($expectedJson);",
            'Jsonp did not contain an complex object with test callback name'
        );
    }

}
 