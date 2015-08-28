<?php
/**
 * A test class that implements JsonSerializable
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests\TestClasses;

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
