<?php
/**
 * Test the Json Formatter
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests\Formats;

use AyeAye\Formatter\Formats\Php;
use AyeAye\Formatter\Tests\TestCase;

class PhpFormatterTest extends TestCase
{

    public function testContentType()
    {
        $phpFormatter = new Php();
        $contentType = $phpFormatter->getContentType();
        $this->assertTrue(
            $contentType === 'text/plain',
            'Incorrect content type for php serialized string' . PHP_EOL . $contentType
        );

        $phpFormatter->setCallbackName('callback');
        $contentType = $phpFormatter->getContentType();
        $this->assertTrue(
            $contentType === 'application/php',
            'Incorrect content type for php using callback: ' . PHP_EOL . $contentType
        );
    }

    public function testHeader()
    {
        $phpFormatter = new Php();

        $header = $phpFormatter->getHeader();
        $this->assertTrue(
            $header === '',
            'Php header was not an empty string: ' . PHP_EOL . $header
        );

        $phpFormatter->setCallbackName('callback');
        $header = $phpFormatter->getHeader();
        $this->assertTrue(
            $header === '<?php ',
            'Php header did not include open tag using callback: ' . PHP_EOL . $header
        );
    }

    public function testFooter()
    {
        $phpFormatter = new Php();

        $footer = $phpFormatter->getFooter();
        $this->assertTrue(
            $footer === '',
            'Php footer was not an empty string: ' . PHP_EOL . $footer
        );

        $phpFormatter->setCallbackName('callback');
        $footer = $phpFormatter->getFooter();
        $this->assertTrue(
            $footer === '',
            'Php footer was not an empty string using callback: ' . PHP_EOL . $footer
        );
    }

    public function testSimpleObjectPhp()
    {
        $blankObject = new \stdClass();
        $phpFormatter = new Php();

        $expectedPhp = 'O:8:"stdClass":0:{}';
        $php = $phpFormatter->format($blankObject);
        $this->assertTrue(
            $php === $expectedPhp,
            'Php did not contain an empty object: ' . PHP_EOL . $php
        );

        $phpFormatter->setCallbackName('callback');
        $php = $phpFormatter->format($blankObject);
        $this->assertTrue(
            $php === "callback(unserialize('$expectedPhp'));",
            'Php did not contain an empty object using callback: ' . PHP_EOL . $php
        );
    }

    public function testSimpleArrayPhp()
    {
        $blankArray = [];
        $phpFormatter = new Php();

        $expectedPhp = 'a:0:{}';
        $php = $phpFormatter->format($blankArray);
        $this->assertTrue(
            $php === $expectedPhp,
            'Php did not contain an empty array: ' . PHP_EOL . $php
        );

        $phpFormatter->setCallbackName('callback');
        $php = $phpFormatter->format($blankArray);
        $this->assertTrue(
            $php === "callback(unserialize('$expectedPhp'));",
            'Php did not contain an empty object using callback: ' . PHP_EOL . $php
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
        $expectedPhp = 'O:8:"stdClass":2:{s:11:"childObject";O:8:"stdClass":1:{s:8:"property";s:5:"value";}s:10:'
            .'"childArray";a:2:{i:0;s:8:"element1";i:1;s:8:"element2";}}';

        $phpFormatter = new Php();

        $php = $phpFormatter->format($complexObject);
        $this->assertTrue(
            $php === $expectedPhp,
            'Php did not contain the complex object: ' . PHP_EOL . $php
        );

        $phpFormatter->setCallbackName('callback');
        $php = $phpFormatter->format($complexObject);
        $this->assertTrue(
            $php === "callback(unserialize('$expectedPhp'));",
            'Php did not contain the complex object using callback: ' . PHP_EOL . $php
        );

    }
}
