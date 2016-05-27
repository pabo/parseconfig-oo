<?php
# TODO
# un-assoc-arrayify configSpecVariables array?

namespace ParseConfig;
include_once 'ParseConfig/Parser.php';

$configFile = 'test.config';

$config = new Spec();
$config->add('ParseConfig\TypeBoolean', "boolean.yesno.yes");
$config->add('ParseConfig\TypeBoolean', "boolean.yesno.no");
$config->add('ParseConfig\TypeBoolean', "boolean.yesno.true");
$config->add('ParseConfig\TypeBoolean', "boolean.yesno.false");
$config->add('ParseConfig\TypeBoolean', "boolean.yesno.null");

$config->add('ParseConfig\TypeBoolean', "boolean.truefalse.yes");
$config->add('ParseConfig\TypeBoolean', "boolean.truefalse.no");
$config->add('ParseConfig\TypeBoolean', "boolean.truefalse.true");
$config->add('ParseConfig\TypeBoolean', "boolean.truefalse.false");
$config->add('ParseConfig\TypeBoolean', "boolean.truefalse.null");

$config->add('ParseConfig\TypeString', "string.regex.letters.abcd", "/^[a-z]+$/");
$config->add('ParseConfig\TypeString', "string.regex.letters.AbCd", "/^[a-z]+$/");
$config->add('ParseConfig\TypeString', "string.regex.letters.1abc", "/^[a-z]+$/");
$config->add('ParseConfig\TypeString', "string.regex.letters.abc_", "/^[a-z]+$/");

$config->add('ParseConfig\TypeNumber', "number.100");
$config->add('ParseConfig\TypeNumber', "number.one");
$config->add('ParseConfig\TypeNumber', "number.5.5");
$config->add('ParseConfig\TypeNumber', "number.0");
$config->add('ParseConfig\TypeNumber', "number.0.0");

$config->add('ParseConfig\TypeString', "uncommented");

$config->add('ParseConfig\TypeString', "spaces.none");
$config->add('ParseConfig\TypeString', "spaces.left");
$config->add('ParseConfig\TypeString', "spaces.right");
$config->add('ParseConfig\TypeString', "spaces.leading");
$config->add('ParseConfig\TypeString', "spaces.trailing");
$config->add('ParseConfig\TypeString', "spaces.lots");
$config->add('ParseConfig\TypeString', "spaces.between");

$config->add('ParseConfig\TypeString', "extra");

$parser = new Parser($config, $configFile);
$parser->parse();

#var_dump($config);
$config->dumpAllVariables();

?>
