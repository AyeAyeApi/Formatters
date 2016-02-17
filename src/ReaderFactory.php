<?php
/**
 * Reader.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter;

/**
 * Interface Reader
 * Read a formatted string and turn it back into data
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
class ReaderFactory implements Reader
{

    /**
     * @var Reader[]
     */
    protected $readers = [];

    /**
     * @param Reader[] $readers
     */
    public function __construct(array $readers = [])
    {
        foreach ($readers as $reader) {
            $this->addReader($reader);
        }
    }

    /**
     * @param Reader $reader
     * @return $this
     */
    public function addReader(Reader $reader)
    {
        $this->readers[] = $reader;
        return $this;
    }

    /**
     * @param $string
     * @return array
     */
    public function read($string)
    {
        foreach ($this->readers as $reader) {
            $result = $reader->read($string);
            if ($result) {
                return $result;
            }
        }
        return null;
    }
}
