<?php
/**
 * Test the Json Formatter
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests\Formats;

use AyeAye\Formatter\Formats\Php;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class PhpFormatterTest
 * @package AyeAye\Formatter\Tests
 * @coversDefaultClass \AyeAye\Formatter\Formats\Php
 */
class PhpFormatterTest extends TestCase
{
    /**
     * @test
     * @covers ::__construct
     * @uses \AyeAye\Formatter\Formats\Php::setCallbackName
     */
    public function testConstruct()
    {
        $php = new Php();
        $this->assertNull(
            $this->getObjectAttribute($php, 'callbackName')
        );

        $php = new Php('callback');
        $this->assertSame(
            'callback',
            $this->getObjectAttribute($php, 'callbackName')
        );
    }

    /**
     * @test
     * @covers ::getContentType
     * @uses \AyeAye\Formatter\Formats\Php::__construct
     * @uses \AyeAye\Formatter\Formats\Php::setCallbackName
     * @uses \AyeAye\Formatter\Formatter::getContentType
     */
    public function testContentType()
    {
        $php = new Php();
        $this->assertSame(
            'text/plain',
            $php->getContentType()
        );

        $php->setCallbackName('callback');
        $this->assertSame(
            'application/php',
            $php->getContentType()
        );
    }

    /**
     * @test
     * @covers ::setCallbackName
     * @uses \AyeAye\Formatter\Formats\Php::__construct
     */
    public function testSetCallbackName()
    {
        $php = new Php();
        $this->assertNull(
            $this->getObjectAttribute($php, 'callbackName')
        );

        $php->setCallbackName('callback');
        $this->assertSame(
            'callback',
            $this->getObjectAttribute($php, 'callbackName')
        );
    }

    /**
     * @test
     * @covers ::getHeader
     * @uses \AyeAye\Formatter\Formats\Php::__construct
     * @uses \AyeAye\Formatter\Formats\Php::setCallbackName
     * @uses \AyeAye\Formatter\Formatter::getHeader
     */
    public function testGetHeader()
    {
        $php = new Php();
        $this->assertSame(
            '',
            $php->getHeader()
        );

        $php->setCallbackName('callback');
        $this->assertSame(
            '<?php ',
            $php->getHeader()
        );
    }

    /**
     * @test
     * @covers ::format
     * @uses \AyeAye\Formatter\Formats\Php::__construct
     * @uses \AyeAye\Formatter\Formats\Php::setCallbackName
     */
    public function testFormat()
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
        $expectedPhp = 'a:2:{s:11:"childObject";a:1:{s:8:"property";s:5:"value";}s:10:"childArray";'
            .'a:2:{i:0;s:8:"element1";i:1;s:8:"element2";}}';

        $php = new Php();
        $this->assertSame(
            $expectedPhp,
            $php->format($complexObject)
        );

        $php = new Php('callback');
        $this->assertSame(
            "callback(unserialize('$expectedPhp'));",
            $php->format($complexObject)
        );

    }
}
