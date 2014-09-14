<?php
/**
 * Test the Json Formatter
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\Formats\Json;

class JsonFormatterTest extends TestCase
{

    public function testContentType()
    {
        $jsonFormatter = new Json();
        $contentType = $jsonFormatter->getContentType();
        $this->assertTrue(
            $contentType === 'application/json',
            'Incorrect content type for Json'
        );
    }

    public function testHeader()
    {
        $jsonFormatter = new Json();
        $this->assertTrue(
            $jsonFormatter->getHeader() === '',
            'Json header was not an empty string'
        );
    }

    public function testFooter()
    {
        $jsonFormatter = new Json();
        $this->assertTrue(
            $jsonFormatter->getFooter() === '',
            'Json footer was not an empty string'
        );
    }

    public function testSimpleObjectJson()
    {
        $blankObject = new \stdClass();
        $jsonFormatter = new Json();
        $this->assertTrue(
            $jsonFormatter->format($blankObject) === '{}',
            'Json did not contain an empty object'
        );
    }

    public function testSimpleArrayJson()
    {
        $blankArray = [];
        $jsonFormatter = new Json();
        $this->assertTrue(
            $jsonFormatter->format($blankArray) === '[]',
            'Json did not contain an empty array'
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
        $jsonFormatter = new Json();
        $json = $jsonFormatter->format($complexObject);
        $this->assertTrue(
            $json === $expectedJson,
            'Json did not contain an complex object'
        );
    }

}
 