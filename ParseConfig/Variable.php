<?php
namespace ParseConfig;
include_once 'ParseConfig/Type.php';

/**
 * @class Variable
 *
 * Defines a variable, its name, type, value, and allowed values
 *
 * @package ParseConfig
 */
class Variable {
	private $type;
	private $name;
	private $value;
	private $regex; # to limit accepted input more than jus the type validation

	/*
	* new Variable()
	*
	* The Variable constructor
	*
	* @param Type $type - a Type from Type.php (ex. TypeBoolean)
	* @param string $name - the variable name
	* @param string $regex - [optional] a regex that validates values for this variable
	*/

	public function __construct(Type $type, $name, $regex = null) {
		$this->type = $type;
		$this->name = $name;
		$this->regex = $regex;
	}

	/**
	* getName()
	*
	* Gets the variable's name
	*
	* @return string
	*/
	public function getName() {
		return $this->name;
	}

	/**
	* getValue()
	*
	* Gets the variable's value
	*
	* @return string|int|float|bool - depending on its Type
	*/
	public function getValue() {
		return $this->value;
	}

	/**
	* trySet()
	*
	* Attempts to set the value for this variable, by checking both the Type's
	* allowed values and this variable's allowed regex
	*
	* @param string $value - the value we are attempting to set
	* @throws InvalidArgumentException if the value is invalid for this Type/variable
	*/
	public function trySet($value) {
		if ($this->type->isValid($value) && $this->isValid($value)) {
			$this->value = $this->type->cast($value);
		}
		else {
			throw new \InvalidArgumentException("value [$value] is not valid for $this->name");
		}
	}

	/**
	* isValid()
	*
	* Checks a proposed value against this variable's allowed regex
	*
	* @param string $value - the value we are testing
	* @return bool
	*/
	
	public function isValid($value) {
		# This value isValid if we have no regex, or if we have a regex and it matches
		return (is_null($this->regex) || preg_match($this->regex, $value));
	}
}

?>
