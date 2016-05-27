<?php

namespace ParseConfig;

include_once 'ParseConfig/Spec.php';

class Parser {
	private $configSpec;
	private $file;

	public function __construct(Spec $configSpec, $file) {
		$this->configSpec = $configSpec;
		$this->file = $file;
	}

	public function parse() {
		if (($handle = fopen($this->file, "r")) !== FALSE) {
			while (($line = fgets($handle)) !== FALSE) {

				# skip comments
				if ($line[0] === "#") {
					continue;
				}

				$line = rtrim($line);

				# if the line has an = in it, ignore optional spaces directly on either side and try to parse as name=value
				if (preg_match("/^\s*(.+?)\s*=\s*(.+?)$/", $line, $matches)) {
					$name = $matches[1];
					$value = $matches[2];

					#attempt to set the variable to value
					try {
						$this->configSpec->getVariableByName($name)->trySet($value);
					}
					catch (\InvalidArgumentException $e) {
						print "Warning: " . $e->getMessage() . "\n";
					}
				}
			}
			fclose($handle);
		}
		else {
			# error opening file
			throw new \Exception("Error opening file $file");
		}
	}

	#unneeded
	#private function tryParseLine($name, $value) {
		#$this->configSpec->getVariableByName($name)->trySet($value);
	#}

	#testing method
	#public function getSpec() {
		#return $this->configSpec;
	#}
}

?>
