<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
	if (isset($_POST['crear'])){
		$id = "NULL";
		$usuario = $_POST['usuario'];
		$clave = $_POST['clave'];
		
		$flag = 1;
		$idperfil = $_POST['perfil'];
		$idlocal = 1;

		$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);	
		$obj->insertusuario($id,$usuario,$clave,$flag,$idperfil,$idlocal);
		$obj->cierradb();
		unset($obj);
		header("location: ".base_url()."summod01/summod01");
	}
?>
