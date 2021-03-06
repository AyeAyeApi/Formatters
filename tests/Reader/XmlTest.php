<?php
/**
 * XmlTest.php
 * @author    Daniel Mason <daniel@ayeayeapi.com>
 * @copyright 2015 - 2016 Daniel Mason <daniel@ayeayeapi.com>
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests\Reader;

use AyeAye\Formatter\Reader\Xml as XmlReader;
use AyeAye\Formatter\Writer\Xml as XmlWriter;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class XmlTest
 * Test the Xml Reader
 * @package AyeAye\Formatter
 * @see https://github.com/AyeAyeApi/Formatters
 * @coversDefaultClass \AyeAye\Formatter\Reader\Xml
 */
class XmlTest extends TestCase
{

    /**
     * @test
     * @covers ::read
     * @uses \AyeAye\Formatter\Reader\Xml::recurseToArray
     * @uses \AyeAye\Formatter\Writer\Xml
     * @uses \AyeAye\Formatter\Writer
     * @return void
     */
    public function testRead()
    {

        $xmlReader = new XmlReader();
        $xmlWriter = new XmlWriter();

        $xmlObject = $xmlReader->read('not xml');
        $this->assertNull(
            $xmlObject
        );

        $array = [
//            'boolean' => true,
            'integer' => 42,
            'string' => 'The quick brown fox jumped over the lazy dog',
            'nonScalar' => [
//                'boolean' => false,
                'integer' => 7 * 9,
                'string' => 'The lazy dog did not jump over the quick brown fox',
            ],
        ];

        $xmlString = $xmlWriter->format($array);

        $xmlObject = $xmlReader->read($xmlString);
        $this->assertEquals(
            $array,
            $xmlObject
        );
    }

    /**
     * @covers ::recurseToArray
     * @return void
     */
    public function testRecurseToArray()
    {
        $xmlReader = new XmlReader();
        $recurseToArray = $this->getObjectMethod($xmlReader, 'recurseToArray');

        // Scalar
        $this->assertSame(
            'string',
            $recurseToArray('string')
        );

        $this->assertSame(
            42,
            $recurseToArray(42)
        );

        $this->assertSame(
            true,
            $recurseToArray(true)
        );

        // Non scalar
        $array = [
            'boolean' => true,
            'integer' => 42,
            'string' => 'The quick brown fox jumped over the lazy dog',
            'nonScalar' => [
                'boolean' => false,
                'integer' => 7 * 9,
                'string' => 'The lazy dog did not jump over the quick brown fox',
            ],
        ];
        $this->assertSame(
            $array,
            $recurseToArray($array)
        );


    }
}
