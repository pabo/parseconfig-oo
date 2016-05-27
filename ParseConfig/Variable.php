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

	# we know the type, and have a value to try to stuff in
	# 1. check that the value fits the type
	# 2. check that the extra regex matches
	public function trySet($value) {
		if ($this->type->isValid($value) && $this->matches($value)) {
			$this->value = $this->type->cast($value);
		}
		else {
			throw new \InvalidArgumentException("value [$value] is not valid for $this->name");
		}
	}

	public function matches($value) {
		return (is_null($this->regex) || preg_match($this->regex, $value));
	}
}

?>
