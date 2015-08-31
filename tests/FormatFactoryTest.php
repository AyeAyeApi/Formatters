<?php
/**
 * Test the Formatter Factory
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\FormatFactory;
use AyeAye\Formatter\Formats\Json;

/**
 * Class FormatFactoryTest
 * @package AyeAye\Formatter\Tests
 * @coversDefaultClass \AyeAye\Formatter\FormatFactory
 */
class FormatFactoryTest extends TestCase
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
        $formatFactory = new FormatFactory($formats);
        $this->assertSame(
            $formats,
            $this->getObjectAttribute($formatFactory, 'formats')
        );
    }

    /**
     * @test
     * @covers ::getFormatterFor
     * @uses \AyeAye\Formatter\FormatFactory
     */
    public function testGetFormatterFor()
    {
        $factory = new FormatFactory([
            'json' => new Json(),
        ]);
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Formats\Json',
            $factory->getFormatterFor('json')
        );

        $factory = new FormatFactory([
            'json' => '\AyeAye\Formatter\Formats\Json',
        ]);
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Formats\Json',
            $factory->getFormatterFor('json')
        );
    }

    /**
     * @test
     * @covers ::getFormatterFor
     * @uses \AyeAye\Formatter\FormatFactory
     * @expectedException        \Exception
     * @expectedExceptionMessage Formatter not found
     */
    public function testInvalidExtensionException()
    {
        $factory = new FormatFactory([]);
        $factory->getFormatterFor('json');
    }

    /**
     * @test
     * @covers ::getSpecificFormatterFor
     * @uses \AyeAye\Formatter\FormatFactory
     */
    public function testGetSpecificFormatterFor()
    {
        $factory = new FormatFactory([
            'json' => new Json(),
        ]);
        $getSpecificFormatterFor = $this->getObjectMethod($factory, 'getSpecificFormatterFor');
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Formats\Json',
            $getSpecificFormatterFor('json')
        );

        $factory = new FormatFactory([
            'json' => '\AyeAye\Formatter\Formats\Json',
        ]);
        $getSpecificFormatterFor = $this->getObjectMethod($factory, 'getSpecificFormatterFor');
        $this->assertInstanceOf(
            '\AyeAye\Formatter\Formats\Json',
            $getSpecificFormatterFor('json')
        );
    }

    /**
     * @test
     * @covers ::getSpecificFormatterFor
     * @uses \AyeAye\Formatter\FormatFactory
     * @expectedException        \Exception
     * @expectedExceptionMessage Formatter for 'json' not a Formatter object or class
     */
    public function testGetSpecificFormatterForNonFormatClassException()
    {
        $factory = new FormatFactory([
            'json' => new \stdClass(),
        ]);
        $factory->getFormatterFor('json');
    }

    /**
     * @test
     * @covers ::getSpecificFormatterFor
     * @uses \AyeAye\Formatter\FormatFactory
     * @expectedException        \Exception
     * @expectedExceptionMessage Formatter for 'json' not a Formatter object or class
     */
    public function testGetSpecificFormatterForInvalidClassException()
    {
        $factory = new FormatFactory([
            'json' => 'this-is-an-invalid-class-name',
        ]);
        $factory->getFormatterFor('json');
    }
}
