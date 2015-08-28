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
class JsonpTest extends TestCase
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
     * @covers ::getHeader
     * @uses \AyeAye\Formatter\Formats\Jsonp::__construct
     */
    public function testGetHeader()
    {
        $jsonp = new Jsonp();
        $this->assertSame(
            "callback('",
            $jsonp->getHeader()
        );

        $jsonp = new Jsonp('testCallback');
        $this->assertSame(
            "testCallback('",
            $jsonp->getHeader()
        );
    }

    /**
     * @test
     * @covers ::getFooter
     * @uses \AyeAye\Formatter\Formats\Jsonp::__construct
     */
    public function testGetFooter()
    {
        $jsonp = new Jsonp();
        $this->assertSame(
            "');",
            $jsonp->getFooter()
        );
    }

}
