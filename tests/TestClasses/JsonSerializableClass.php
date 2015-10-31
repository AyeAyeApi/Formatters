<?php
/**
 * JsonSerializableClass.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests\TestClasses;

/**
 * Class JsonSerializableClass
 * A test class that implements JsonSerializable
 * @package AyeAye\Formatter
 * @see https://github.com/AyeAyeApi/Formatters
 */
class JsonSerializableClass implements \JsonSerializable
{

    public function jsonSerialize()
    {
        return [
            'testString' => 'string',
            'testBool' => true,
        ];
    }
}
