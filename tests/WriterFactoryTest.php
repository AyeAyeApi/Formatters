<?php
/**
 * WriterFactoryTest.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\WriterFactory;
use AyeAye\Formatter\Writer\Json;

/**
 * Class WriterFactoryTest
 * Test the format factory
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
     * @covers ::getFormatterFor
     * @uses \AyeAye\Formatter\WriterFactory
     */
    public function testGetFormatterFor()
    {
        $factory = new WriterFactory([
            'json' => new Json(),
        ]);
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Writer\Json',
            $factory->getFormatterFor('json')
        );

        $factory = new WriterFactory([
            'json' => '\AyeAye\Formatter\Writer\Json',
        ]);
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Writer\Json',
            $factory->getFormatterFor('json')
        );
    }

    /**
     * @test
     * @covers ::getFormatterFor
     * @uses \AyeAye\Formatter\WriterFactory
     * @expectedException        \Exception
     * @expectedExceptionMessage Formatter not found
     */
    public function testInvalidExtensionException()
    {
        $factory = new WriterFactory([]);
        $factory->getFormatterFor('json');
    }

    /**
     * @test
     * @covers ::getSpecificFormatterFor
     * @uses \AyeAye\Formatter\WriterFactory
     */
    public function testGetSpecificFormatterFor()
    {
        $factory = new WriterFactory([
            'json' => new Json(),
        ]);
        $getSpecificFormatterFor = $this->getObjectMethod($factory, 'getSpecificFormatterFor');
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Writer\Json',
            $getSpecificFormatterFor('json')
        );

        $factory = new WriterFactory([
            'json' => '\AyeAye\Formatter\Writer\Json',
        ]);
        $getSpecificFormatterFor = $this->getObjectMethod($factory, 'getSpecificFormatterFor');
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Writer\Json',
            $getSpecificFormatterFor('json')
        );
    }

    /**
     * @test
     * @covers ::getSpecificFormatterFor
     * @uses \AyeAye\Formatter\WriterFactory
     * @expectedException        \Exception
     * @expectedExceptionMessage Formatter for 'json' not a Formatter object or class
     */
    public function testGetSpecificFormatterForNonFormatClassException()
    {
        $factory = new WriterFactory([
            'json' => new \stdClass(),
        ]);
        $factory->getFormatterFor('json');
    }

    /**
     * @test
     * @covers ::getSpecificFormatterFor
     * @uses \AyeAye\Formatter\WriterFactory
     * @expectedException        \Exception
     * @expectedExceptionMessage Formatter for 'json' not a Formatter object or class
     */
    public function testGetSpecificFormatterForInvalidClassException()
    {
        $factory = new WriterFactory([
            'json' => 'this-is-an-invalid-class-name',
        ]);
        $factory->getFormatterFor('json');
    }
}
