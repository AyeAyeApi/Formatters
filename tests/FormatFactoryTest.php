<?php
/**
 * Test the Formatter Factory
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace Gisleburt\Formatter\Tests;


use Gisleburt\Formatter\FormatFactory;
use Gisleburt\Formatter\Formats\Json;

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
        $this->assertTrue($factory->getFormatFor('json') instanceof Json, 'Formatter for json not returned correctly');
    }

    /**
     * Test that the factory can return objects based on class names as strings
     */
    public function testFactoryStrings()
    {
        $factory = new FormatFactory([
            'json' => '\Gisleburt\Formatter\Formats\Json',
        ]);
        $this->assertTrue($factory->getFormatFor('json') instanceof Json, 'Formatter for json not returned correctly');
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Format for 'json' not a Format object or class
     */
    public function testNonFormatClassException()
    {
        $factory = new FormatFactory([
            'json' => new \stdClass(),
        ]);
        $factory->getFormatFor('json');
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Format for 'json' not a valid class or object
     */
    public function testInvalidClassException()
    {
        $factory = new FormatFactory([
            'json' => 'this-is-an-invalid-class-name',
        ]);
        $factory->getFormatFor('json');
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Format for 'json' not found
     */
    public function testInvalidExtensionException()
    {
        $factory = new FormatFactory([]);
        $factory->getFormatFor('json');
    }

}
 