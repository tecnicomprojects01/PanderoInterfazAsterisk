<?
require_once("dblib.php");
require_once("misc.php");

$queue_log_dir  = '/var/log/asterisk/';
$queue_log_file = 'queue_log';

$dbhost = 'localhost';
$dbname = 'qstats';
$dbuser = 'root';
$dbpass = 'itperu321x';

$midb = conecta_db($dbhost,$dbname,$dbuser,$dbpass);
$self = $_SERVER['PHP_SELF'];

$DB_DEBUG = false;

?>
