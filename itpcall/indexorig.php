<?php 
session_start();
ob_start();

define('MODULE_PATH', realpath('./modules/'));

require_once(dirname(__FILE__) . '/config/config.inc.php');

require_once(dirname(__FILE__) . '/config/db.inc.php');

require_once(dirname(__FILE__) . '/functions/functions.inc.php');

require_once(APP_PATH . "includes/conexiongestor.php");

require_once(APP_PATH . "includes/hackStats.php");
if (!isset($_SESSION['usuario']) && !isset($_SESSION['clave'])) {
	//header('Location: login.php'); //Login normal
	header("Location: " . base_url() . "../stats/");
	exit();
}

$perfil=(isset($_SESSION['perfil'])) ? $_SESSION['perfil'] : 'X';

$module = (isset($_GET['module'])) ? $_GET['module'] : MODULE_DEFAULT;

$controller = (isset($_GET['controller'])) ? $_GET['controller'] : CONTROLLER_DEFAULT;

if(!is_dir(MODULE_PATH . '/' . $module)) {
	$module = MODULE_DEFAULT;
}

if(!is_file(MODULE_PATH . '/' . $module . '/' . $controller . '.php')) {
	$module = MODULE_DEFAULT;
	$controller = CONTROLLER_DEFAULT;
}

include_once(dirname(__FILE__) . '/header.php');

include_once(MODULE_PATH . '/' . $module . '/' . $controller . '.php');

include_once(dirname(__FILE__) . '/footer.php');

?>