<?php
/**
 * Test the Json Formatter
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests\Writer;

use AyeAye\Formatter\Writer\Json;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class JsonFormatterTest
 * @package AyeAye\Formatter\Tests
 * @coversDefaultClass \AyeAye\Formatter\Writer\Json
 */
class JsonTest extends TestCase
{
    /**
     * @test
     * @covers ::partialFormat
     * @uses \AyeAye\Formatter\Formatter::parseData
     */
    public function testFormat()
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
        $json = new Json();
        $expectedJson = '{"childObject":{"property":"value"},"childArray":["element1","element2"]}';
        $this->assertJsonStringEqualsJsonString(
            $expectedJson,
            $json->partialFormat($complexObject)
        );
    }
}