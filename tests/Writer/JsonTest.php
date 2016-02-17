<?php
/**
 * JsonTest.php
 * @author    Daniel Mason <daniel@ayeayeapi.com>
 * @copyright 2015 - 2016 Daniel Mason <daniel@ayeayeapi.com>
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests\Writer;

use AyeAye\Formatter\Writer\Json;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class JsonTest
 * Test the Json Formatter
 * @package AyeAye\Formatter
 * @see https://github.com/AyeAyeApi/Formatters
 * @coversDefaultClass \AyeAye\Formatter\Writer\Json
 */
class JsonTest extends TestCase
{
    /**
     * @test
     * @covers ::partialFormat
     * @uses \AyeAye\Formatter\Writer::parseData
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
