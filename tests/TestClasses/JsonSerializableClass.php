<?php
/**
 * [Description]
 * @author Daniel Mason
 * @copyright Loft Digital, 2014
 */

namespace Gisleburt\Formatter\Tests\TestClasses;


class JsonSerializableClass implements \JsonSerializable {

    public function jsonSerialize() {
        return [
            'testString' => 'string',
            'testBool' => true,
        ];
    }

} 