<?php
/**
 * @class Parser
 *
 * Parses a config file
 *
 * @package ParseConfig
 */

namespace ParseConfig;

include_once 'ParseConfig/Spec.php';

class Parser {
	private $spec;
	private $file;

	/**
	* new Parser()
	*
	* The Parser constructor
	*
	* @param Spec $spec - specification of variables to read during parsing
	* @param string $file - the config file to parse
	*/
	public function __construct(Spec $spec, $file) {
		$this->spec = $spec;
		$this->file = $file;
	}

	/**
	* parse()
	*
	* Given a path to a config file and a specification of variables contained in it, parse
	* the file and store the values of the variables in the spec
	*
	* @param Spec $spec - specification of variables to read during parsing
	* @param string $file - the config file to parse
	*/
	public function parse() {
		if (($handle = fopen($this->file, "r")) !== FALSE) {
			while (($line = fgets($handle)) !== FALSE) {

				# skip comments
				if ($line[0] === "#") {
					continue;
				}

				# trim trailing whitespace
				$line = rtrim($line);

				# if the line has an = in it, ignore optional spaces directly on either side and try to parse as name=value
				if (preg_match("/^\s*(.+?)\s*=\s*(.+?)$/", $line, $matches)) {
					$name = $matches[1];
					$value = $matches[2];

					# attempt to set the variable to value, if the spec allows
					try {
						$this->spec->getVariableByName($name)->trySet($value);
					}
					catch (\InvalidArgumentException $e) {
						print "Warning: " . $e->getMessage() . "\n";
					}
					catch (\OutOfBoundsException $e) {
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
}

?>
