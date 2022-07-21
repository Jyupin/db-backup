<?php

ini_set('memory_limit', '-1');
ini_set('max_execution_time', '-1');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('EXPORT_PATH', dirname(__FILE__) . "/exports/");

define('DB_HOST', "localhost");
define('DB_PORT', 3306);
define('DB_USERNAME', "root");
define('DB_PASSWORD', "rootroot");

// For Single Database backup
define('DB_DATABASE', "pdash_new");
