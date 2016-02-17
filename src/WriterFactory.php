<?php
/**
 * FormatFactory.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter;

/**
 * Class FormatFactory
 * Mediate between a set of writers to choose the right one
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
class WriterFactory
{

    protected $formats;

    public function __construct(array $formats)
    {
        $this->formats = $formats;
    }

    /**
     * @param string|array $formats
     * @return Writer
     * @throws \Exception
     */
    public function getWriterFor($formats)
    {
        // Make an array
        if (is_scalar($formats)) {
            $formats = [$formats];
        }

        // For each provided suffix, see if we have a writer for it
        foreach ($formats as $format) {
            if ($writer = $this->getSpecificWriterFor($format)) {
                return $writer;
            }
        }
        throw new \Exception("Writer not found");
    }

    /**
     * @param string $format
     * @return null|Writer
     * @throws \Exception
     */
    protected function getSpecificWriterFor($format)
    {
        $writer = null;
        if (array_key_exists($format, $this->formats)) {
            if (is_object($this->formats[$format])) {
                $writer = $this->formats[$format];
            } elseif (is_string($this->formats[$format]) && class_exists($this->formats[$format])) {
                $writer = new $this->formats[$format]();
            }
            if (!$writer instanceof Writer) {
                throw new \Exception("Writer for '$format' not a Writer object or class");
            }
        }
        return $writer;
    }
}
