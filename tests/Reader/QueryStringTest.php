<?php
/**
 * QueryStringTest.php
 * @author    Daniel Mason <daniel@ayeayeapi.com>
 * @copyright 2015 - 2016 Daniel Mason <daniel@ayeayeapi.com>
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests\Reader;

use AyeAye\Formatter\Reader\QueryString;
use AyeAye\Formatter\Tests\TestCase;

/**
 * Class QueryStringTest
 * Test the Query String Reader
 * @package AyeAye/Foratters
 * @see     https://github.com/AyeAyeApi/Formatters
 * @coversDefaultClass AyeAye\Formatter\Reader\QueryString
 */
class QueryStringTest extends TestCase
{

    /**
     * @test
     * @covers ::read
     * @return void
     */
    public function testRead()
    {
        $array = [
//            'boolean' => true,
            'integer' => 42,
            'string' => 'The quick brown fox jumped over the lazy dog',
            'non-scalar' => [
//                'boolean' => false,
                'integer' => 7 * 9,
                'string' => 'The lazy dog did not jump over the quick brown fox',
            ],
        ];
        $queryString = http_build_query($array);

        $queryStringReader = new QueryString();

        $this->assertEquals(
            $array,
            $queryStringReader->read($queryString)
        );
    }
}
