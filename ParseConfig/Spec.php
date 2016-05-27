<?php
/**
 * @class Spec
 *
 * Defines a collection of variables, their names, types, and allowed values
 *
 * @package ParseConfig
 */

namespace ParseConfig;
include_once 'ParseConfig/Variable.php';

class Spec {
	public $variables = array(); // assoc array of name->Variable objects

	/**
	* add()
	*
	* Adds a variable specification to the collection
	*
	* @param string $type - a string containing the fully qualified name of the
	*                       Type from Type.php (ex. 'ParseConfig\TypeString')
	* @param string $name - the variable name
	* @param string $regex - [optional] a regex that validates values for this variable
	*/
	public function add($type, $name, $regex = null) {
		$this->variables[$name] = new Variable(new $type(), $name, $regex);
	}

	/**
	* getVariableByName()
	*
	* Looks up a variable by name in the collection
	*
	* @param string $name - the variable name
	* @return Variable object
	* @throws OutOfBoundsException if a variable with this name does not exist
	*/
	public function getVariableByName($name) {
		if (array_key_exists($name, $this->variables)) {
			return $this->variables[$name];
		}
		else {
			throw new \OutOfBoundsException("variable [$name] is not in the spec");
		}
	}

	/**
	* getValueOf()
	*
	* Gets the value of the named variable
	*
	* @param string $name - the variable name
	* @return string|int|float|bool - depending on its Type
	*/
	public function getValueOf($name) {
		return $this->getVariableByName($name)->getValue();
	}

	/**
	* dumpAllVariables()
	*
	* Prints a summary of all variables in the collection
	*/
	public function dumpAllVariables() {
		foreach ($this->variables as $name => $variable) {
			print "$name: ";
			print $variable->getValue();
			print "\n";
		}
	}
}

?>
