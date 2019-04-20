#!/usr/bin/php -q
<?php

require('agi-config.php');
require('agi-error.php');


if ($enlace=mysql_connect($_DB['host'],$_DB['user'],$_DB['pwd'])){
	if (mysql_select_db($_DB['db'],$enlace)){
		//echo "Conexion OK ".$this->base;
	} else {
		echo mysql_error()." ".mysql_errno()." Error en la conexion a la Base de Datos ".$_DB['db'];
		exit();
	}
} else {
	echo "Error en la conexion, al Servidor de Base de Datos";
	exit();
}

$file = fopen('newlista.txt', "r");
	while(!feof($file)){
		$linea= trim(fgets($file));
		$row = explode(",",$linea);
if(empty($row[0])) {
	continue;
}		

//$_anexo = $_SERVER['argv'][1];
//$mac = $_SERVER['argv'][2];
$_anexo = $row[1];
$mac = $row[0];

$isAnexo = $DB->query("SELECT idanexo FROM tb_anexos WHERE anexo=" . $_anexo,PDO::FETCH_NUM);

if($isAnexo->rowCount() == 0x0001) {
	$a = $isAnexo->fetch(PDO::FETCH_OBJ);
	$anexo = $a->idanexo;
//prov_modid
//prov_anex
//prov_mac
//prov_gen
	$DB->query("INSERT INTO tb_provision_anexo(prov_modid,prov_anex,prov_mac,prov_gen) values ('1','" . $anexo . "','" . $mac . "','" . $mac . ".cfg')");
	include("t21p.php");


}






	}
fclose($file);
