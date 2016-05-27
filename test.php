<?php
# TODO
# un-assoc-arrayify configSpecVariables array?

namespace ParseConfig;
include_once 'ParseConfig/Parser.php';

$File = 'test.config';

$config = new Spec();
$config->add(new Variable(new TypeBoolean(), "boolean.yesno.yes"));
$config->add(new Variable(new TypeBoolean(), "boolean.yesno.no"));
$config->add(new Variable(new TypeBoolean(), "boolean.yesno.true"));
$config->add(new Variable(new TypeBoolean(), "boolean.yesno.false"));
$config->add(new Variable(new TypeBoolean(), "boolean.yesno.null"));

$config->add(new Variable(new TypeBoolean(), "boolean.truefalse.yes"));
$config->add(new Variable(new TypeBoolean(), "boolean.truefalse.no"));
$config->add(new Variable(new TypeBoolean(), "boolean.truefalse.true"));
$config->add(new Variable(new TypeBoolean(), "boolean.truefalse.false"));
$config->add(new Variable(new TypeBoolean(), "boolean.truefalse.null"));

$config->add(new Variable(new TypeString(), "string.regex.letters.abcd", "/^[a-z]+$/"));
$config->add(new Variable(new TypeString(), "string.regex.letters.AbCd", "/^[a-z]+$/"));
$config->add(new Variable(new TypeString(), "string.regex.letters.1abc", "/^[a-z]+$/"));
$config->add(new Variable(new TypeString(), "string.regex.letters.abc_", "/^[a-z]+$/"));

$config->add(new Variable(new TypeNumber(), "number.100"));
$config->add(new Variable(new TypeNumber(), "number.one"));
$config->add(new Variable(new TypeNumber(), "number.5.5"));
$config->add(new Variable(new TypeNumber(), "number.0"));
$config->add(new Variable(new TypeNumber(), "number.0.0"));

$config->add(new Variable(new TypeString(), "uncommented"));

$config->add(new Variable(new TypeString(), "spaces.none"));
$config->add(new Variable(new TypeString(), "spaces.left"));
$config->add(new Variable(new TypeString(), "spaces.right"));
$config->add(new Variable(new TypeString(), "spaces.leading"));
$config->add(new Variable(new TypeString(), "spaces.trailing"));
$config->add(new Variable(new TypeString(), "spaces.lots"));
$config->add(new Variable(new TypeString(), "spaces.between"));

$parser = new ConfigParser($config, $configFile);
$parser->parse();

#var_dump($config);
$config->dumpAllVariables();

?>
