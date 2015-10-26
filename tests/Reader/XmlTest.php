<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 13/10/2015
 * Time: 08:42
 */

namespace AyeAye\Formatter\Tests\Reader;


use AyeAye\Formatter\Reader\Xml as XmlReader;
use AyeAye\Formatter\Formats\Xml as XmlWriter;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class XmlTest
 * @package ${PROJECT_NAME}
 * @see     https://github.com/AyeAyeApi/Api
 * @coversDefaultClass \AyeAye\Formatter\Reader\Xml
 */
class XmlTest extends TestCase
{

    /**
     * @test
     * @covers ::read
     * @uses \AyeAye\Formatter\Reader\Xml::recurseToArray
     * @uses \AyeAye\Formatter\Formats\Xml
     * @uses \AyeAye\Formatter\Formatter
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