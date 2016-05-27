<?php

namespace ParseConfig;
include_once 'ParseConfig/Type.php';

class Variable {
	private $type;
	private $name;
	private $value;
	private $regex; # to limit accepted input more than jus the type validation

	public function __construct(Type $type, $name, $regex = null) {
		$this->type = $type;
		$this->name = $name;
		$this->regex = $regex;
	}

	public function getName() {
		return $this->name;
	}

	public function getValue() {
		return $this->value;
	}

	public function trySet($value) {
		# check that the value isValid for the type
		# AND check that the value isValid for this specific Variable's validator
		if ($this->type->isValid($value) && $this->isValid($value)) {
			$this->value = $this->type->cast($value);
		}
		else {
			throw new \InvalidArgumentException("value [$value] is not valid for $this->name");
		}
	}

	public function isValid($value) {
		# This value isValid if we have no regex, or if we have a regex and it matches
		return (is_null($this->regex) || preg_match($this->regex, $value));
	}
}

?>
