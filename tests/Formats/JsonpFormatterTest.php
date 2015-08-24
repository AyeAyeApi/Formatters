<?php
/**
 * Test the Json Formatter
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests\Formats;

use AyeAye\Formatter\Formats\Jsonp;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class JsonpFormatterTest
 * @package AyeAye\Formatter\Tests
 * @coversDefaultClass \AyeAye\Formatter\Formats\Jsonp
 */
class JsonpFormatterTest extends TestCase
{

    /**
     * @test
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $jsonp = new Jsonp();
        $this->assertSame(
            'callback',
            $this->getObjectAttribute($jsonp, 'callbackName')
        );

        $jsonp = new Jsonp('testCallback');
        $this->assertSame(
            'testCallback',
            $this->getObjectAttribute($jsonp, 'callbackName')
        );
    }

    /**
     * @test
     * @covers ::format
     * @covers ::fullFormat
     * @covers ::getHeader
     * @covers ::getFooter
     * @uses \AyeAye\Formatter\Formats\Jsonp::__construct
     */
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
        $this->assertSame(
            "callback($expectedJson);",
            $jsonpFormatter->fullFormat($complexObject)
        );

        $jsonpFormatter = new Jsonp('testCallback');
        $this->assertSame(
            "testCallback($expectedJson);",
            $jsonpFormatter->fullFormat($complexObject)
        );
    }
}
