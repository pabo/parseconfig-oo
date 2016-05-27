<?php

namespace ParseConfig;

/**
 * @class Type
 *
 * Defines an abstract class Type for concrete Types to extend. Two methods are required
 * for implementation:
 * - isValid() checks whether a value can be interpreted as this Type
 * - cast() interprets the value as this Type and returns a string, int, float, bool as appropriate
 *
 * @package ParseConfig
 */
abstract class Type {
	abstract public function isValid($value);
	abstract public function cast($value);
}

/**
 * @class TypeString
 *
 * A string class. Valid values are limited by the regex.
 *
 * @package ParseConfig
 */
class TypeString extends Type {
	public function isValid($value) {
		return preg_match("/^[a-zA-Z0-9_.\/-]+$/", $value);
	}

	public function cast($value) {
		return $value;
	}
}

/**
 * @class TypeNumber
 *
 * A number class. Valid values are limited by the regex. cast() can return int or float.
 *
 * @package ParseConfig
 */
class TypeNumber extends Type {
	public function isValid($value) {
		return preg_match("/^\d*\.?\d+$/", $value);
	}

	public function cast($value) {
		return 0 + $value;
	}
}

/**
 * @class TypeBoolean
 *
 * A boolean class. Valid values are limited by the regex. cast() will return a bool.
 *
 * @package ParseConfig
 */
class TypeBoolean extends Type {
	public function isValid($value) {
		return preg_match("/^(yes|no|true|false|on|off)$/", $value);
	}

	public function cast($value) {
		return (bool) preg_match("/^(yes|on|true)$/", $value);
	}
}

?>
