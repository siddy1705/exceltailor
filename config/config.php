<?php 

//Note: This file should be included first in every php page.

define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER','exceltailor');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));


require_once BASE_PATH.'/lib/MysqliDb.php';

/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
*/

// define('DB_HOST', "localhost");
// define('DB_USER', "root");
// define('DB_PASSWORD', "");
// define('DB_NAME', "corephpadmin");

// define('DB_HOST', "localhost");
// define('DB_USER', "phpmyadmin");
// define('DB_PASSWORD', "7u8i9o0p");
// define('DB_NAME', "corephpadmin");

define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "root");
define('DB_NAME', "corephpadmin");

/**
* Get instance of DB object
*/
function getDbInstance()
{
	return new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); 
}