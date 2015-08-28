<?php
/**
 * A test class that implements JsonSerializable
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Formatter\Tests\TestClasses;

use AyeAye\Formatter\Deserializable;
use AyeAye\Formatter\Serializable;

class AyeAyeSerializableClass implements Serializable, Deserializable
{

    /**
     * @var string
     */
    protected $testString = 'string';

    /**
     * @var bool
     */
    protected $testBool = true;

    /**
     * @return array
     */
    public function ayeAyeSerialize()
    {
        return [
            'testString' => $this->testString,
            'testBool' => $this->testBool,
        ];
    }

    /**
     * @param $data
     * @return static
     */
    public static function ayeAyeDeserialize(array $data)
    {
        $object = new static();
        $object->testString = array_key_exists('testString', $data)
            ? (string)$data['testString']
            : '';
        $object->testBool = array_key_exists('testBool', $data)
            ? filter_var($data['testBool'], FILTER_VALIDATE_BOOLEAN)
            : false;
        return $object;
    }
}
