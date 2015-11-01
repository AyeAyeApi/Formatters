<?php
/**
 * JsonpTest.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see       https://github.com/AyeAyeApi/Formatters
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests\Writer;

use AyeAye\Formatter\Writer\Jsonp;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class JsonpTest
 * Test the Jsonp Writer
 * @package AyeAye\Formatter
 * @see https://github.com/AyeAyeApi/Formatters
 * @coversDefaultClass \AyeAye\Formatter\Writer\Jsonp
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
     * @uses \AyeAye\Formatter\Writer\Jsonp::__construct
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
     * @uses \AyeAye\Formatter\Writer\Jsonp::__construct
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
