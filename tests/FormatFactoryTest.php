<?php
/**
 * Test the Formatter Factory
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\FormatFactory;
use AyeAye\Formatter\Formats\Json;

class FormatFactoryTest extends TestCase
{

    /**
     * Test that the factory can return objects previously given to it
     */
    public function testFactoryObjects()
    {
        $factory = new FormatFactory([
            'json' => new Json(),
        ]);
        $this->assertTrue($factory->getFormatterFor('json') instanceof Json, 'Formatter for json not returned correctly');
    }

    /**
     * Test that the factory can return objects based on class names as strings
     */
    public function testFactoryStrings()
    {
        $factory = new FormatFactory([
            'json' => '\AyeAye\Formatter\Formats\Json',
        ]);
        $this->assertTrue($factory->getFormatterFor('json') instanceof Json, 'Formatter for json not returned correctly');
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Formatter for 'json' not a Formatter object or class
     */
    public function testNonFormatClassException()
    {
        $factory = new FormatFactory([
            'json' => new \stdClass(),
        ]);
        $factory->getFormatterFor('json');
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Formatter for 'json' not a Formatter object or class
     */
    public function testInvalidClassException()
    {
        $factory = new FormatFactory([
            'json' => 'this-is-an-invalid-class-name',
        ]);
        $factory->getFormatterFor('json');
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Formatter not found
     */
    public function testInvalidExtensionException()
    {
        $factory = new FormatFactory([]);
        $factory->getFormatterFor('json');
    }
}
