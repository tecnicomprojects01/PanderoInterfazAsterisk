<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}

	
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$idanx = $_GET['idanx'];
	$anx = $_GET['anx'];
	$sql = "delete from tb_anexo_parametro where idanexo='".$idanx."'";
	$obj->mantenimiento($sql);	
	$sql = "delete from tb_correodevoz where idanexo='".$idanx."'";
	$obj->mantenimiento($sql);
	$sql = "delete from tb_monitoreo where anx_numero='".$anx."'";
	$obj->mantenimiento($sql);
	$sql = "delete from tb_anexos where idanexo='".$idanx."'";
	$obj->mantenimiento($sql);
	$sql = "delete from tb_desvio where des_anexo='".$anx."'";
	$obj->mantenimiento($sql);
	
	
	
	$sql="select prov_mac from tb_provision_anexo where prov_anex='".$idanx."'";
	$res=mysql_query($sql) or die(mysql_error());
	$dato=mysql_fetch_row($res);
		
	$rut="/tftpboot/".$dato[0].".cfg";
	if(file_exists("$rut")){
		unlink($rut);
	}

	$sql = "delete from tb_provision_anexo where prov_anex='".$idanx."'";
	$obj->mantenimiento($sql);


	
	include(MODULE_PATH ."/summod02/Generar_sip.php");
	include(MODULE_PATH ."/summod02/Generar_hints.php");
	include(MODULE_PATH ."/summod02/Generar_voicemail.php");
	include(MODULE_PATH ."/summod02/phonebook.php");
	include(MODULE_PATH ."/summod02/aplicar.php");
	include(MODULE_PATH ."/summod02/Generar_fop_botones.php");
	include (MODULE_PATH ."/summod02/mensaje_desvio.php");

	if (isset($_GET['idce'])){
        	$idce=$_GET['idce'];

	        $sql="select prov_mac from tb_provision_anexo where prov_id='$idce'";
        	$res=mysql_query($sql) or die(mysql_error());
	        $dato=mysql_fetch_row($res);
	        $rut="/tftpboot/".$dato[0].".cfg";
        	if(file_exists("$rut")){
                	unlink($rut);
	        }

        	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	        $obj->mantenimiento("delete from tb_provision_anexo where prov_id=$idce");



	}




	header("location: " . base_url() ."/summod02/summod02"); 

$obj->cierradb();

	
?>
