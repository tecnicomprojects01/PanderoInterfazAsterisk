<?php  
session_start();  

require_once(dirname(__FILE__) . '/config/config.inc.php');

//	SE BORRA LOS ELEMENTOS DE LA VARIABLE SESSION
$_SESSION = array(); 
//	SE DESTRUYE LA SESION 
session_destroy();  
// 	SE REDIRECCIONA A LA PAGINA DE LOGUEO
header ("Location: " . URL_PATH); 
?> 
