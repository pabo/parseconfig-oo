<?php

namespace ParseConfig;
include_once 'ParseConfig/Variable.php';

class Spec {
	public $variables = array(); // assoc array of name->Variable objects

	public function add($type, $name, $regex = null) {
		$this->variables[$name] = new Variable(new $type(), $name, $regex);
	}

	# Searches for and returns the Variable object by name
	public function getVariableByName($name) {
		if (array_key_exists($name, $this->variables)) {
			return $this->variables[$name];
		}
		else {
			throw new \OutOfBoundsException("variable [$name] is not in the spec");
		}
	}

	# Gets the value of the Variable of given name
	public function getValueOf($name) {
		return $this->getVariableByName($name)->getValue();
	}

	# prints a summary of all Variables
	public function dumpAllVariables() {
		foreach ($this->variables as $name => $variable) {
			print "$name: ";
			print $variable->getValue();
			print "\n";
		}
	}
}

?>
