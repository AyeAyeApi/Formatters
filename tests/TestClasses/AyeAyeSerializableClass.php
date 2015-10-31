<?php
/**
 * AyeAyeSerializableClass.php
 * @author    Daniel Mason <daniel@danielmason.com>
 * @copyright 2015 Daniel Mason
 * @license   GPL 3
 * @see https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests\TestClasses;

use AyeAye\Formatter\Deserializable;
use AyeAye\Formatter\Serializable;

/**
 * Class AyeAyeSerializableClass
 * A test class that implements Deserializable
 * @package AyeAye\Formatter
 * @see https://github.com/AyeAyeApi/Formatters
 */
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
    public static function ayeAyeDeserialize($data)
    {
        if(!is_array($data)) {
            throw new \InvalidArgumentException('$data must be an array');
        }
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
