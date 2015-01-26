<?php
/**
 * Turn suffix's into Formats
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter;

class FormatFactory
{

    protected $formats;

    public function __construct(array $formats)
    {
        $this->formats = $formats;
    }

    /**
     * @param $suffix
     * @return Formatter
     * @throws \Exception
     */
    public function getFormatFor($suffix)
    {
        if (array_key_exists($suffix, $this->formats)) {
            if (is_object($this->formats[$suffix])) {
                $format = $this->formats[$suffix];
            } elseif (is_string($this->formats[$suffix]) && class_exists($this->formats[$suffix])) {
                $format = new $this->formats[$suffix]();
            } else {
                throw new \Exception("Format for '$suffix' not a valid class or object");
            }

            if ($format instanceof Formatter) {
                return $format;
            }

            throw new \Exception("Format for '$suffix' not a Format object or class");
        }
        throw new \Exception("Format for '$suffix' not found");
    }
}
