<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
	$idus = $_GET['idus'];
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->deleteusuario($idus);
	//$obj->cierradb();
	unset($obj);
	header("location: ".base_url()."summod01/summod01");
?>
<style type="text/css">.links4{background-color: #FFF3B3 !important;}</style>

