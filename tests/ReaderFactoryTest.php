<?php
/**
 * ReaderFactoryTest.php
 * @author    Daniel Mason <daniel@ayeayeapi.com>
 * @copyright 2015 - 2016 Daniel Mason <daniel@ayeayeapi.com>
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests;

use AyeAye\Formatter\Reader;
use AyeAye\Formatter\Reader\Json;
use AyeAye\Formatter\Reader\QueryString;
use AyeAye\Formatter\Reader\Xml;
use AyeAye\Formatter\ReaderFactory;

/**
 * Class ReaderFactoryTest
 * Test the reader factory
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 * @coversDefaultClass \AyeAye\Formatter\ReaderFactory
 */
class ReaderFactoryTest extends TestCase
{

    /**
     * @test
     * @covers ::__construct
     * @uses \AyeAye\Formatter\ReaderFactory::addReader
     */
    public function testConstruct()
    {
        $json = new Json();
        $xml = new Xml();
        $query = new QueryString();

        $readerFactory = new ReaderFactory([
            $json,
            $xml,
        ]);

        $readers = $this->getObjectAttribute($readerFactory, 'readers');

        $this->assertContains(
            $json,
            $readers
        );
        $this->assertContains(
            $xml,
            $readers
        );
        $this->assertNotContains(
            $query,
            $readers
        );
    }

    /**
     * @test
     * @covers ::__construct
     * @uses \AyeAye\Formatter\ReaderFactory::addReader
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testConstructFail()
    {
        new ReaderFactory([new \stdClass()]);
    }

    /**
     * @test
     * @covers ::addReader
     * @uses \AyeAye\Formatter\ReaderFactory::__construct
     */
    public function testAddReader()
    {
        $json = new Json();
        $readerFactory = new ReaderFactory();
        $readers = $this->getObjectAttribute($readerFactory, 'readers');

        $this->assertNotContains(
            $json,
            $readers
        );

        $readerFactory->addReader($json);
        $readers = $this->getObjectAttribute($readerFactory, 'readers');

        $this->assertContains(
            $json,
            $readers
        );
    }

    /**
     * @test
     * @covers ::read
     * @uses \AyeAye\Formatter\ReaderFactory::__construct
     * @uses \AyeAye\Formatter\ReaderFactory::addReader
     */
    public function testRead()
    {
        $testString = 'testString';
        $testResult = 'testResult';
        /** @var \PHPUnit_Framework_MockObject_MockObject|Reader $reader */
        $reader = $this->getMockForAbstractClass('\AyeAye\Formatter\Reader');
        $reader
            ->expects($this->once())
            ->method('read')
            ->with($testString)
            ->will($this->returnValue($testResult));

        $readerFactory = new ReaderFactory();

        $this->assertNull(
            $readerFactory->read($testString)
        );

        $readerFactory->addReader($reader);

        $this->assertSame(
            $testResult,
            $readerFactory->read($testString)
        );
    }
}
