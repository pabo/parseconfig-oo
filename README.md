# Welcome to ParseConfig
This is a sample PHP project for a developer position. Please see my other sample repositories as well!

[ParseConfig](#parseconfig)  
[Specification](#specification)  
[Example](#example-usage)  
[TODO](#todo)  
[Author](#author)  

## ParseConfig
`ParseConfig` parses a configuration file which may contain comments and configuration variable key/pairs and spits out an associative array of the variables which it set. This parsing is done line by line.

Lines beginning with the '#' character are treated as comments and ignored.
Lines containing the '=' character are treated as configuration variable key/value pairs and we attempt to parse them as such. If they fail either the key or value regex we throw an Exception, but for now catch it and simply print a warning.
All other lines are ignored.
If a key is given more than once in the configuration file, the value in the last valid definition will be used.

Configuration variables are whitelisted and their names are case sensitive.

There are three supported types in the `ParseConfig` namespace:
 - `TypeString` - any string of text matching `/^[a-zA-Z0-9_.\/-]+$/` (Note that spaces are not included.)
 - `TypeNumber` - any ints or floats. a string matching `/^\d*\.?\d+$/`, which is then cast to an int or float.
 - `TypeBoolean` - yes/no, on/off, true/false. a string matching `/^(yes|no|true|false|on|off)$/` which is then cast to a bool.

## Example usage:
Run `php influxtest.php` or `php unittest.php` for a demonstration. Relevant portions are explained below.

First, set up the specification for the config file and add your variable definitions (The third argument is an optional regex. This is specific to the variable being defined and in addition to any validation we already do on a per-Type basis.)

    $config = new Spec();

    $config->add('ParseConfig\TypeString', "host");
    $config->add('ParseConfig\TypeNumber', "server_id");
    $config->add('ParseConfig\TypeBoolean', "verbose");
    $config->add('ParseConfig\TypeString', "log_file_path", "/^[a-zA-Z0-9._\/-]+$/");

Then, create a Parser instance and use it to parse():

    $configParser = new Parser($config, $configFile);
    $configParser->parse();

Now, each variable's value is accessible with getValueOf():

    print "host is " . $config->getValueOf("host") . "\n";

Or, you can dump all the variables' values at once:

    $config->dumpAllVariables();

## Specification
Write some code that can parse a configuration file
following the specifications below. Follow your
own best practices and coding/design principles.

- Do not use existing "complete" configuration parsing
  libraries/functions, we want to see how you would write the code
  to do this.
- Use of core and stdlib functions/objects such as string
  manipulation, regular expressions, etc is ok.
- We should be able to get the values of the config parameters in
  code, via their name. How this is done specifically is up to you.
- Boolean-like config values (on/off, yes/no, true/false) should
  return real booleans: true/false.
- Numeric config values should return real numerics: integers,
  doubles, etc
- Ignore or error out on invalid config lines, your choice.
- Please include a short example usage of your code so we can see
  how you call it/etc.
- Push your work to a public github repository and send us the link.

#### Valid config file:

    # This is what a comment looks like, ignore it
    # All these config lines are valid
    host = test.com
    server_id=55331
    server_load_alarm=2.5
    user= user
    # comment can appear here as well
    verbose =true
    test_mode = on
    debug_mode = off
    log_file_path = /tmp/logfile.log
    send_notifications = yes

##TODO

- make Types static? really only need one instance of each.
- review passing of Variables "through" Spec

## Author
Hey - I'm Brett. I like coding and solving problems. Questions?

brett.schellenberg@gmail.com
