<?php

namespace ParseConfig;
include_once 'ParseConfig/Variable.php';

class Spec {
	public $variables = array(); // assoc array of name->Variable objects

	public function add(Variable $variable) {
		$this->variables[$variable->getName()] = $variable;
	}

	# Searches for and returns the Variable object by name
	public function getVariableByName($name) {
		return $this->variables[$name];
	}

	public function getValueOf($name) {
		return $this->getVariableByName($name)->getValue();
	}

	public function dumpAllVariables() {
		foreach ($this->variables as $name => $variable) {
			print "$name: ";
			print $variable->getValue();
			print "\n";
		}
	}


}
?>
