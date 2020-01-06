<?php
require_once '../config/constants.php';

spl_autoload_register('autoload');

function autoload($classname, $dir = null) {
    if (is_null($dir)) {
        $dir = PROJECT_ROOT;
    }
    foreach (scandir($dir) as $filename) {
        // Search for directories and run autoload for each directory.
        if (is_dir($dir . $filename) && substr($filename, 0, 1 ) !== '.') {
            autoload($classname, $dir . $filename . DIRECTORY_SEPARATOR);
        }

        // Search for files and include them if class name matches with the file name.
        if (substr($filename, 0, 2 ) !== '._' && preg_match( "/.php$/i" , $filename)) {
            // check if file name is equal to class name. If equal then include
            $class = explode('\\', $classname);
            $file = str_replace('.php', '', $filename);
            if (end($class) == $file) {
                if (file_exists($dir . $filename)) {
                    require_once $dir . $filename;
                } else {
                    var_dump("File " . $dir . $filename . "does not exists");
                }
            }
        }
    }
}