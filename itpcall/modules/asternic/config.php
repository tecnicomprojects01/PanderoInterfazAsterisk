<?
require_once("dblib.php");
require_once("misc.php");

// Credentials for MYSQL database
$dbhost = 'localhost';
$dbname = 'qstats';
$dbuser = 'root';
$dbpass = 'itperu321x';

// Credentials for AMI (for the realtime tab to work)
// See /etc/asterisk/manager.conf

$manager_host   = "127.0.0.1";
$manager_user   = "asternicstats";
$manager_secret = "1tp3ru321";

// Available languages "es", "en", "ru", "de", "fr"
$language = "es";

require_once("lang/$language.php");

$midb = conecta_db($dbhost,$dbname,$dbuser,$dbpass);
$self = $_SERVER['PHP_SELF'];

$DB_DEBUG = false; 

session_start();
session_register("QSTATS");
header('content-type: text/html; charset: utf-8'); 

?>
