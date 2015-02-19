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
     * @param string|array $formats
     * @return Formatter
     * @throws \Exception
     */
    public function getFormatterFor($formats)
    {
        // Make an array
        if(is_scalar($formats)) {
            $formats = [$formats];
        }

        // For each provided suffix, see if we have a formatter for it
        foreach($formats as $format) {
            if($formatter = $this->getSpecificFormatterFor($format)) {
                return $formatter;
            }
        }
        throw new \Exception("Formatter not found");
    }

    /**
     * @param string $format
     * @return null|Formatter
     * @throws \Exception
     */
    protected function getSpecificFormatterFor($format)
    {
        $formatter = null;
        if (array_key_exists($format, $this->formats)) {
            if (is_object($this->formats[$format])) {
                $formatter = $this->formats[$format];
            } elseif (is_string($this->formats[$format]) && class_exists($this->formats[$format])) {
                $formatter = new $this->formats[$format]();
            }
            if (!$formatter instanceof Formatter) {
                throw new \Exception("Formatter for '$format' not a Formatter object or class");
            }
        }
        return $formatter;
    }

}