#!/usr/bin/php
<?php

/**
 * This command line tool accept only a single argument.
 * To see available argument list simply use "--help", "-help", "-h" or "-?".
 *
 * @author Dilan Madhusanka
 */
if ($argc < 2) {
?>

This is a command line PHP Tool created for run the Database migrations in pure PHP MVC projects.
Author: Dilan Madhusanka
Email:  projects0128@gmail.com

    Usage:
        <?php echo $argv[0]; ?> <option>

    <option>
            can be some word you would like to print out.
            With the --help, -help, -h, list, ls or -? options, you can get this help.

<?php
} elseif ($argc == 2 && in_array($argv[1], array('--help', '-help', '-h', '-?', 'list', 'ls'))) {
    echo 'list all the commands available.';
} elseif ($argc == 2 && $argv[1] === 'migrate') {
    echo "You are tying to $argv[1] the database.";
} else {
    echo "Command $argv[1] is not defined.";
}
?>

