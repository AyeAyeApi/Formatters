<?php
/**
 * WriterTest.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\Writer;
use AyeAye\Formatter\Tests\TestClasses\AyeAyeSerializableClass;
use AyeAye\Formatter\Tests\TestClasses\JsonSerializableClass;

/**
 * Class WriterTest
 * Tests for the writer abstract class
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 * @coversDefaultClass \AyeAye\Formatter\Writer
 */
class WriterTest extends TestCase
{
    /**
     * @return Writer|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function getWriter()
    {
        $writer = $this->getMockForAbstractClass('\AyeAye\Formatter\Writer');
        $writer->expects($this->any())
            ->method('format')
            ->will($this->returnValue(''));
        return $writer;
    }

    /**
     * @test
     * @covers ::getContentType
     */
    public function testGetContentType()
    {
        $writer = $this->getWriter();
        $this->assertSame(
            'text/plain',
            $writer->getContentType()
        );
    }

    /**
     * @test
     * @covers ::getHeader
     */
    public function testGetHeader()
    {
        $writer = $this->getWriter();
        $this->assertSame(
            '',
            $writer->getHeader()
        );
    }

    /**
     * @test
     * @covers ::getFooter
     */
    public function testGetFooter()
    {
        $writer = $this->getWriter();
        $this->assertSame(
            '',
            $writer->getFooter()
        );
    }

    /**
     * @test
     * @covers ::format
     * @uses \AyeAye\Formatter\Writer
     */
    public function testFullFormat()
    {
        $writer = $this->getWriter();
        $this->assertSame(
            '',
            $writer->format('data')
        );
    }

    /**
     * @test
     * @covers ::parseData
     */
    public function testParseData()
    {
        $writer = $this->getWriter();
        $parseData = $this->getObjectMethod($writer, 'parseData');

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
