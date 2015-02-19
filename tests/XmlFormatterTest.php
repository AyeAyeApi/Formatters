<?php
/**
 * Test the Json Formatter
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\Formats\Xml;
use AyeAye\Formatter\Tests\TestClasses\JsonSerializableClass;

class XmlFormatterTest extends TestCase
{

    public function testContentType()
    {
        $xmlFormatter = new Xml();
        $contentType = $xmlFormatter->getContentType();
        $this->assertTrue(
            $contentType === 'application/xml',
            'Incorrect content type for Xml: ' . PHP_EOL . $contentType
        );
    }

    public function testHeader()
    {
        $xmlFormatter = new Xml();
        $header = $xmlFormatter->getHeader();
        $this->assertTrue(
            $header === '<?xml version="1.0" encoding="UTF-8" ?>',
            'Xml header did not contain schema definition: ' . PHP_EOL . $header
        );
    }

    public function testFooter()
    {
        $xmlFormatter = new Xml();
        $footer = $xmlFormatter->getFooter();
        $this->assertTrue(
            $footer === '',
            'Xml footer was not an empty string: ' . PHP_EOL . $footer
        );
    }

    public function testSimpleObjectXml()
    {
        $blankObject = new \stdClass();
        $xmlFormatter = new Xml();

        $xml = $xmlFormatter->format($blankObject);
        $this->assertTrue(
            $xml === '<stdClass></stdClass>',
            'Xml did not contain an empty object: ' . PHP_EOL . $xml
        );

        $xml = $xmlFormatter->format($blankObject, 'testName');
        $this->assertTrue(
            $xml === '<testName></testName>',
            'Xml did not contain an empty object with test name: ' . PHP_EOL . $xml
        );
    }

    public function testSimpleArrayXml()
    {
        $blankArray = [];
        $xmlFormatter = new Xml();

        $xml = $xmlFormatter->format($blankArray);
        $this->assertTrue(
            $xml === '<array></array>',
            'Xml did not contain an empty array: ' . PHP_EOL . $xml
        );

        $xml = $xmlFormatter->format($blankArray, 'testName');
        $this->assertTrue(
            $xml === '<testName></testName>',
            'Xml did not contain an empty array with test name: ' . PHP_EOL . $xml
        );
    }

    public function testComplexObject()
    {
        $complexObject = (object)[
            'childObject' => (object)[
                    'property' => 'value'
                ],
            'childArray' => [
                'element1',
                'element2'
            ]
        ];
        $expectedXml =
            '<stdClass>'
            .'<childObject>'
            .'<property>value</property>'
            .'</childObject>'
            .'<childArray>'
            .'<_0>element1</_0>'
            .'<_1>element2</_1>'
            .'</childArray>'
            .'</stdClass>';

        $xmlFormatter = new Xml();
        $xml = $xmlFormatter->format($complexObject);
        $this->assertTrue(
            $xml === $expectedXml,
            'Xml did not contain an complex object: ' . PHP_EOL . $xml
        );

        $expectedXml =
            '<testName>'
            .'<childObject>'
            .'<property>value</property>'
            .'</childObject>'
            .'<childArray>'
            .'<_0>element1</_0>'
            .'<_1>element2</_1>'
            .'</childArray>'
            .'</testName>';

        $xml = $xmlFormatter->format($complexObject, 'testName');
        $this->assertTrue(
            $xml === $expectedXml,
            'Xml did not contain an complex object with test name: ' . PHP_EOL . $xml
        );
    }

    public function testDefaultNodeName()
    {
        $empty = '';
        $xmlFormatter = new Xml();
        $xml = $xmlFormatter->format($empty);
        $this->assertTrue(
            $xml === '<data></data>',
            'Default node name was not data: ' . PHP_EOL . $xml
        );
    }

    public function testJsonSerializable()
    {
        $testObject = new JsonSerializableClass();
        $expectedXml =
            '<JsonSerializableClass>'
            .'<array>'
            .'<testString>string</testString>'
            .'<testBool>true</testBool>'
            .'</array>'
            .'</JsonSerializableClass>';

        $xmlFormatter = new Xml();
        $xml = $xmlFormatter->format($testObject);
        $this->assertTrue(
            $xml === $expectedXml,
            'Default node name was not data: ' . PHP_EOL . $xml
        );
    }
}
