<?php
/**
 * Test the Json Formatter
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests\Formats;

use AyeAye\Formatter\Formats\Json;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class JsonFormatterTest
 * @package AyeAye\Formatter\Tests
 * @coversDefaultClass \AyeAye\Formatter\Formats\Json
 */
class JsonTest extends TestCase
{
    /**
     * @test
     * @covers ::format
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
        $jsonFormatter = new Json();
        $expectedJson = '{"childObject":{"property":"value"},"childArray":["element1","element2"]}';
        $this->assertJsonStringEqualsJsonString(
            $expectedJson,
            $jsonFormatter->format($complexObject)
        );
    }
}
