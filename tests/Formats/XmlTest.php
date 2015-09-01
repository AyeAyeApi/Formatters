<?php
/**
 * Test the Json Formatter
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests\Formats;

use AyeAye\Formatter\Formats\Xml;
use AyeAye\Formatter\Tests\TestCase;
use AyeAye\Formatter\Tests\TestClasses\JsonSerializableClass;

/**
 * Class XmlFormatterTest
 * @package AyeAye\Formatter\Tests
 * @coversDefaultClass \AyeAye\Formatter\Formats\Xml
 */
class XmlTest extends TestCase
{
    /**
     * @test
     * @covers ::getHeader
     */
    public function testGetHeader()
    {
        $xml = new Xml();
        $this->assertSame(
            '<?xml version="1.0" encoding="UTF-8" ?>',
            $xml->getHeader()
        );
    }

    /**
     * @test
     * @covers ::getNodeName
     */
    public function testGetNodeName()
    {
        $xml = new Xml();
        $getNodeName = $this->getObjectMethod($xml, 'getNodeName');

        $this->assertSame(
            'stdClass',
            $getNodeName(new \stdClass())
        );

        $this->assertSame(
            'array',
            $getNodeName([])
        );

        $this->assertSame(
            'data',
            $getNodeName(true)
        );
    }

    /**
     * @test
     * @covers ::parseScalarData
     */
    public function testParseScalarData()
    {
        $xml = new Xml();
        $parseScalarData = $this->getObjectMethod($xml, 'parseScalarData');

        $this->assertSame(
            'true',
            $parseScalarData(true)
        );

        $this->assertSame(
            '&lt;b&gt;TEST&lt;/b&gt;',
            $parseScalarData('<b>TEST</b>')
        );
    }

    /**
     * @test
     * @covers ::parseNonScalarData
     * @uses \AyeAye\Formatter\Formatter::parseData
     * @uses \AyeAye\Formatter\Formats\Xml::partialFormat
     * @uses \AyeAye\Formatter\Formats\Xml::getNodeName
     * @uses \AyeAye\Formatter\Formats\Xml::parseScalarData
     */
    public function testParseNonScalarData()
    {
        $xml = new Xml();
        $parseNonScalarData = $this->getObjectMethod($xml, 'parseNonScalarData');

        $array = [
            'element1',
            'element2'
        ];

        $expectedXml =
            '<data>element1</data>'
            .'<data>element2</data>';

        $this->assertSame(
            $expectedXml,
            $parseNonScalarData($array)
        );

        $expectedXml =
            '<element>element1</element>'
            .'<element>element2</element>';

        $this->assertSame(
            $expectedXml,
            $parseNonScalarData($array, 'element')
        );
    }

    /**
     * @test
     * @covers ::partialFormat
     * @uses \AyeAye\Formatter\Formats\Xml::getNodeName
     * @uses \AyeAye\Formatter\Formats\Xml::parseScalarData
     * @uses \AyeAye\Formatter\Formats\Xml::parseNonScalarData
     * @uses \AyeAye\Formatter\Formatter::parseData
     */
    public function testFormat()
    {
        $complexObject = (object)[
            'childObject' => new JsonSerializableClass(),
            'childArray' => [
                'element1',
                'element2'
            ]
        ];

        $expectedXml =
            '<stdClass>'
            . '<childObject>'
            . '<testString>string</testString>'
            . '<testBool>true</testBool>'
            . '</childObject>'
            . '<childArray>'
            . '<childArray>element1</childArray>'
            . '<childArray>element2</childArray>'
            . '</childArray>'
            . '</stdClass>';

        $xml = new Xml();
        $this->assertSame(
            $expectedXml,
            $xml->partialFormat($complexObject)
        );

        $expectedXml =
            '<testName>'
            . '<childObject>'
            . '<testString>string</testString>'
            . '<testBool>true</testBool>'
            . '</childObject>'
            . '<childArray>'
            . '<childArray>element1</childArray>'
            . '<childArray>element2</childArray>'
            . '</childArray>'
            . '</testName>';

        $this->assertSame(
            $expectedXml,
            $xml->partialFormat($complexObject, 'testName')
        );
    }
}