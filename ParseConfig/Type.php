<?php

namespace ParseConfig;

abstract class Type {
	public function isValid($value) {}
	public function cast($value) {}
}

class TypeString extends Type {
	public function __construct() {
	}

	public function isValid($value) {
		return preg_match("/^[a-zA-Z0-9_.\/-]+$/", $value);
	}

	public function cast($value) {
		return $value;
	}
}

class TypeNumber extends Type {
	public function __construct() {
	}

	public function isValid($value) {
		return preg_match("/^\d*\.?\d+$/", $value);
	}

	public function cast($value) {
		return $value;
	}
}

class TypeBoolean extends Type {
	public function __construct() {
	}

	public function isValid($value) {
		return preg_match("/^(yes|no|true|false|on|off)$/", $value);
	}

	public function cast($value) {
		return (bool) preg_match("/^(yes|on|true)$/", $value);
	}
}
