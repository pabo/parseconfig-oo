<?php
namespace ParseConfig;
include_once 'ParseConfig/Parser.php';

$configFile = 'influx.config';

# set up the specification for the config file
$config = new Spec();

#config->add('type from Type.php    ', "name", "optional regex");
$config->add('ParseConfig\TypeString', "host");
$config->add('ParseConfig\TypeNumber', "server_id");
$config->add('ParseConfig\TypeNumber', "server_load_alarm");
$config->add('ParseConfig\TypeString', "user");
$config->add('ParseConfig\TypeBoolean', "verbose");
$config->add('ParseConfig\TypeBoolean', "test_mode");
$config->add('ParseConfig\TypeBoolean', "debug_mode");
$config->add('ParseConfig\TypeString', "log_file_path", "/^[a-zA-Z0-9._\/-]+$/");
$config->add('ParseConfig\TypeBoolean', "send_notifications");

$configParser = new Parser($config, $configFile);
$configParser->parse();

var_dump($config);
$config->dumpAllVariables();
#print "host is " . $config->getValueOf("host") . "\n";

?>
