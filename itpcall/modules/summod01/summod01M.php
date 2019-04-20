<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
	if (isset($_POST['modificar'])){
		$idus = $_POST['idus'];
		$clave = $_POST['claven'];
		$idperfil = $_POST['perfiln'];
		$extension = $_POST['exten'];
		
		$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
		$obj->updateusuario($idus,$clave,$idperfil,$extension);
		//$obj->insertusuario($id,$usuario,$clave,$flag,$idperfil,$idlocal);
		//$obj->liberarmemoria();
		//$obj->cierradb();
		header("location: ".base_url()."summod01/summod01");
	}
?>
