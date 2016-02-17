<?php
/**
 * TestCase.php
 * @author    Daniel Mason <daniel@ayeayeapi.com>
 * @copyright 2015 - 2016 Daniel Mason <daniel@ayeayeapi.com>
 * @license   MIT
 * @see       https://github.com/AyeAyeApi/Formatters
 */

namespace AyeAye\Formatter\Tests;

/**
 * Abstract Class TestCase
 * Helpful functions for writing tests
 * @package AyeAye/Formatters
 * @see     https://github.com/AyeAyeApi/Formatters
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * Get an otherwise inaccessible method
     * @param object $object
     * @param $methodName
     * @return callable
     */
    protected function getObjectMethod($object, $methodName)
    {
        $method = new \ReflectionMethod($object, $methodName);
        $method->setAccessible(true);
        $callable = function () use ($object, $method) {
            $arguments = func_get_args();
            array_unshift($arguments, $object);
            return call_user_func_array([$method, 'invoke'], $arguments);
        };
        return $callable;
    }
}
