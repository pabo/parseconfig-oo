<?php
namespace ParseConfig;
include_once 'ParseConfig/Parser.php';

$configFile = 'influx.config';

# set up the specification for the config file
$config = new Spec();
$config->add(new Variable(new TypeString(), "host"));
$config->add(new Variable(new TypeNumber(), "server_id"));
$config->add(new Variable(new TypeNumber(), "server_load_alarm"));
$config->add(new Variable(new TypeString(), "user"));
$config->add(new Variable(new TypeBoolean(), "verbose"));
$config->add(new Variable(new TypeBoolean(), "test_mode"));
$config->add(new Variable(new TypeBoolean(), "debug_mode"));
$config->add(new Variable(new TypeString(), "log_file_path", "/^[a-zA-Z0-9._\/-]+$/"));
$config->add(new Variable(new TypeBoolean(), "send_notifications"));

$configParser = new Parser($config, $configFile);
$configParser->parse();

#var_dump($config);
$config->dumpAllVariables();
#print "host is " . $config->getValueOf("host") . "\n";

?>
