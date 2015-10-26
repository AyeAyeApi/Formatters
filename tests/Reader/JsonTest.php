<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 13/10/2015
 * Time: 08:36
 */

namespace AyeAye\Formatter\Tests\Reader;


use AyeAye\Formatter\Reader\Json;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class JsonTest
 * Tests the Json reader
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Api
 * @coversDefaultClass AyeAye\Formatter\Reader\Json
 */
class JsonTest extends TestCase
{

    /**
     * @test
     * @covers ::read
     * @returns void
     */
    public function testRead()
    {
        $array = [
            'boolean' => true,
            'integer' => 42,
            'string' => 'The quick brown fox jumped over the lazy dog',
            'non-scalar' => [
                'boolean' => false,
                'integer' => 7 * 9,
                'string' => 'The lazy dog did not jump over the quick brown fox',
            ],
        ];
        $jsonString = json_encode($array);

        $jsonReader = new Json();

        $this->assertSame(
            $array,
            $jsonReader->read($jsonString)
        );
    }
}