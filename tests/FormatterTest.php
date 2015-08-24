<?php
/**
 * Test the Formatter Factory
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\Formatter;

/**
 * Class FormatterTest
 * @package AyeAye\Formatter\Tests
 * @coversDefaultClass \AyeAye\Formatter\Formatter
 */
class FormatterTest extends TestCase
{
    /**
     * @return Formatter|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function getFormatter()
    {
        $formatter = $this->getMockForAbstractClass('\AyeAye\Formatter\Formatter');
        $formatter->expects($this->any())
            ->method('format')
            ->will($this->returnValue(''));
        return $formatter;
    }

    /**
     * @test
     * @covers ::getContentType
     */
    public function testGetContentType()
    {
        $formatter = $this->getFormatter();
        $this->assertSame(
            'text/plain',
            $formatter->getContentType()
        );
    }

    /**
     * @test
     * @covers ::getHeader
     */
    public function testGetHeader()
    {
        $formatter = $this->getFormatter();
        $this->assertSame(
            '',
            $formatter->getHeader()
        );
    }

    /**
     * @test
     * @covers ::getFooter
     */
    public function testGetFooter()
    {
        $formatter = $this->getFormatter();
        $this->assertSame(
            '',
            $formatter->getFooter()
        );
    }

    /**
     * @test
     * @covers ::fullFormat
     * @uses \AyeAye\Formatter\Formatter
     */
    public function testFullFormat()
    {
        $formatter = $this->getFormatter();
        $this->assertSame(
            '',
            $formatter->fullFormat('data')
        );
    }
}
