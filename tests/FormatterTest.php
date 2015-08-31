<?php
/**
 * Test the Formatter Factory
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\Formatter;
use AyeAye\Formatter\Tests\TestClasses\AyeAyeSerializableClass;
use AyeAye\Formatter\Tests\TestClasses\JsonSerializableClass;

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

    /**
     * @test
     * @covers ::parseData
     */
    public function testParseData()
    {
        $formatter = $this->getFormatter();
        $parseData = $this->getObjectMethod($formatter, 'parseData');

        // Scalar
        $data = 'test';
        $this->assertSame(
            $data,
            $parseData($data)
        );

        // Array
        $array = [
            'testString' => 'string',
            'testBool' => true,
        ];
        $this->assertSame(
            [
                'testString' => 'string',
                'testBool' => true,
            ],
            $parseData($array)
        );

        // stdClass
        $stdClass = (object)[
            'testString' => 'string',
            'testBool' => true,
        ];
        $this->assertSame(
            [
                'testString' => 'string',
                'testBool' => true,
            ],
            $parseData($stdClass)
        );

        // AyeAye Serializable
        $ayeAyeSerializable = new AyeAyeSerializableClass();
        $this->assertSame(
            [
                'testString' => 'string',
                'testBool' => true,
            ],
            $parseData($ayeAyeSerializable)
        );

        // JsonSerializable
        $jsonSerializable = new JsonSerializableClass();
        $this->assertSame(
            [
                'testString' => 'string',
                'testBool' => true,
            ],
            $parseData($jsonSerializable)
        );
    }
}
