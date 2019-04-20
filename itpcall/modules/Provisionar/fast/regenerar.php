#!/usr/bin/php -q
<?php

require('agi-config.php');
require('agi-error.php');


if ($enlace=mysql_connect($_DB['host'],$_DB['user'],$_DB['pwd'])){
	if (!mysql_select_db($_DB['db'],$enlace)){
		echo mysql_error()." ".mysql_errno()." Error en la conexion a la Base de Datos ".$_DB['db'];
		exit();
	}
} else {
	echo "Error en la conexion, al Servidor de Base de Datos";
	exit();
}

#t21pJose.cfg

$provs = $DB->query("SELECT prov_anex, prov_mac from tb_provision_anexo",PDO::FETCH_OBJ);

while($row = $provs->fetch(PDO::FETCH_OBJ) ) { 
	unlink("/tftpboot/" . $row->prov_mac . ".cfg");
	$anexo = $row->prov_anex;
	$mac = $row->prov_mac;
/*
$file = fopen('newlista.txt', "r");
	while(!feof($file)){
		$linea= trim(fgets($file));
		$row = explode(",",$linea);
if(empty($row[0])) {
	continue;
}		

$_anexo = $row[1];
$mac = $row[0];
*/
//	$isAnexo = $DB->query("SELECT idanexo FROM tb_anexos WHERE anexo=" . $_anexo,PDO::FETCH_NUM);

//	if($isAnexo->rowCount() == 0x0001) {
//		$a = $isAnexo->fetch(PDO::FETCH_OBJ);
//		$anexo = $a->idanexo;
//echo $anexo ."-<br />";
//prov_modid
//prov_anex
//prov_mac
//prov_gen
//		$DB->query("INSERT INTO tb_provision_anexo(prov_modid,prov_anex,prov_mac,prov_gen) values ('1','" . $anexo . "','" . $mac . "','" . $mac . ".cfg')");
		include("t21p.php");


}
header("Location: /itpcall/Provisionar/provisionar" );
