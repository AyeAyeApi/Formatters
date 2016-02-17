<?php
/**
 * WriterFactoryTest.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\WriterFactory;
use AyeAye\Formatter\Writer\Json;

/**
 * Class WriterFactoryTest
 * Test the writer factory
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 * @coversDefaultClass \AyeAye\Formatter\WriterFactory
 */
class WriterFactoryTest extends TestCase
{

    /**
     * @test
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $formats = [
            'test' => new Json()
        ];
        $writerFactory = new WriterFactory($formats);
        $this->assertSame(
            $formats,
            $this->getObjectAttribute($writerFactory, 'formats')
        );
    }

    /**
     * @test
     * @covers ::getWriterFor
     * @uses \AyeAye\Formatter\WriterFactory
     */
    public function testGetWriterFor()
    {
        $factory = new WriterFactory([
            'json' => new Json(),
        ]);
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Writer\Json',
            $factory->getWriterFor('json')
        );

        $factory = new WriterFactory([
            'json' => '\AyeAye\Formatter\Writer\Json',
        ]);
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Writer\Json',
            $factory->getWriterFor('json')
        );
    }

    /**
     * @test
     * @covers ::getWriterFor
     * @uses \AyeAye\Formatter\WriterFactory
     * @expectedException        \Exception
     * @expectedExceptionMessage Writer not found
     */
    public function testInvalidExtensionException()
    {
        $factory = new WriterFactory([]);
        $factory->getWriterFor('json');
    }

    /**
     * @test
     * @covers ::getSpecificWriterFor
     * @uses \AyeAye\Formatter\WriterFactory
     */
    public function testGetSpecificWriterFor()
    {
        $factory = new WriterFactory([
            'json' => new Json(),
        ]);
        $getSpecificWriterFor = $this->getObjectMethod($factory, 'getSpecificWriterFor');
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Writer\Json',
            $getSpecificWriterFor('json')
        );

        $factory = new WriterFactory([
            'json' => '\AyeAye\Formatter\Writer\Json',
        ]);
        $getSpecificWriterFor = $this->getObjectMethod($factory, 'getSpecificWriterFor');
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Writer\Json',
            $getSpecificWriterFor('json')
        );
    }

    /**
     * @test
     * @covers ::getSpecificWriterFor
     * @uses \AyeAye\Formatter\WriterFactory
     * @expectedException        \Exception
     * @expectedExceptionMessage Writer for 'json' not a Writer object or class
     */
    public function testGetSpecificWriterForNonFormatClassException()
    {
        $factory = new WriterFactory([
            'json' => new \stdClass(),
        ]);
        $factory->getWriterFor('json');
    }

    /**
     * @test
     * @covers ::getSpecificWriterFor
     * @uses \AyeAye\Formatter\WriterFactory
     * @expectedException        \Exception
     * @expectedExceptionMessage Writer for 'json' not a Writer object or class
     */
    public function testGetSpecificWriterForInvalidClassException()
    {
        $factory = new WriterFactory([
            'json' => 'this-is-an-invalid-class-name',
        ]);
        $factory->getWriterFor('json');
    }
}
