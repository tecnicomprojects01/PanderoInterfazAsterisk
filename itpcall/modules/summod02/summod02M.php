<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
	if (isset($_POST['modificar'])){
		#echo $_POST['nombre'];
		$idanx = $_POST['idanx'];
		$anx = $_POST['anx'];
				
		$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
		
		if ($_POST['clave'] != ""){
			$secret = $_POST['clave'];
			$sql = "update tb_anexo_parametro set valor='$secret' where idanexo=$idanx and idparametro=5";
			$obj->update_anexo($sql);
		}

		if ($_POST['nombre_n'] != ""){
			$nombre ='"'.$_POST["nombre_n"].'" <'.$anx.'>';
			$sql = "update tb_anexo_parametro set valor='$nombre' where idanexo=$idanx and idparametro=2";
			$obj->update_anexo($sql);
			
			$sql = "select idcorreovoz from tb_correodevoz where idanexo=$idanx";
			$obj->mantenimiento($sql);
			$row = $obj->respuesta1();
			
			$nom = $_POST['nombre_n'];
			$sql = "update tb_correodevoz set nombre='$nom' where idcorreovoz=$row[0]";
        	$obj->mantenimiento($sql);
		}
		
/*		if ($_POST['contexto'] != "0"){
			$context = $_POST['contexto'];
			$sql = "update tb_anexo_parametro set valor='$context' where idanexo=$idanx and idparametro=7";
			$obj->update_anexo($sql);
		}		
*/
		if ($_POST['callLimit'] != ""){
			$callLimit = $_POST['callLimit'];
			$sql = "update tb_anexo_parametro set valor=$callLimit where idanexo=$idanx and idparametro=8";
			$obj->update_anexo($sql);
		}
/*	
		if ($_POST['dtmfmode'] != "0"){
			$dtmfmode = $_POST['dtmfmode'];
			$sql = "update tb_anexo_parametro set valor='$dtmfmode' where idanexo=$idanx and idparametro=9";
			$obj->update_anexo($sql);
		}
		
		if ($_POST['canreinvite'] != "0"){
			$canreinvite = $_POST['canreinvite'];
			$sql = "update tb_anexo_parametro set valor='$canreinvite' where idanexo=$idanx and idparametro=11";
			$obj->update_anexo($sql);
		}
		
		if ($_POST['qualify'] != "0"){
			$qualify = $_POST['qualify'];
			$sql = "update tb_anexo_parametro set valor='$qualify' where idanexo=$idanx and idparametro=12";
			$obj->update_anexo($sql);
		}
		
		if ($_POST['nat'] != "0"){
			$nat = $_POST['nat'];
			$sql = "update tb_anexo_parametro set valor='$nat' where idanexo=$idanx and idparametro=13";
			$obj->update_anexo($sql);
		}

		if ($_POST['callgroup'] != "0"){
			$callgroup = $_POST['callgroup'];
			$sql = "update tb_anexo_parametro set valor=$callgroup where idanexo=$idanx and idparametro=14";
			$obj->update_anexo($sql);
		}
*/
		print_r($_POST['grabar_n']);
		if ($_POST['grabar_n']!=""){
			$grabar = $_POST['grabar_n'];
		
			$sql = "update tb_anexo_parametro set valor=$grabar where idanexo=$idanx and idparametro=22";
			$obj->update_anexo($sql);
		}
/*

		if ($_POST['pickupgroup'] != "0"){
			$pickupgroup = $_POST['pickupgroup'];
			$sql = "update tb_anexo_parametro set valor=$pickupgroup where idanexo=$idanx and idparametro=15";
			$obj->update_anexo($sql);
		}
*/
		if ($_POST['createvoicemail'] == "1"){
			$createvoicemail = $_POST['createvoicemail'];
			$sql = "update tb_anexo_parametro set valor=$createvoicemail where idanexo=$idanx and idparametro=21";
			$obj->update_anexo($sql);
		} else {
			$sql = "update tb_anexo_parametro set valor='0' where idanexo=$idanx and idparametro=21";
			$obj->update_anexo($sql);
		}
		 if ($_POST['passcall'] != ""){
                        $passcall = $_POST['passcall'];
                        $sql = "update tb_anexo_parametro set valor='on' where idanexo=$idanx and idparametro=13";
                        $obj->update_anexo($sql);
                } else {
                        $sql = "update tb_anexo_parametro set valor='off' where idanexo=$idanx and idparametro=13";
                        $obj->update_anexo($sql);
                }
	
		if ($_POST['createwaitcall'] != "0"){
			$createwaitcall = $_POST['createwaitcall'];
			$sql = "update tb_anexo_parametro set valor=$createwaitcall where idanexo=$idanx and idparametro=20";
			$obj->update_anexo($sql);
		}

/*				
		# Update codecs
		if ($_POST['codecs'] != ""){
			$codecs = $_POST['codecs'];
			$sql = "update tb_anexo_parametro set valor='$codecs' where idanexo=$idanx and idparametro=19";
			$obj->update_anexo($sql);
		}
*/		

/*================================Actualizando la tabla tb_provisionar_anexo=====================*/
		$macb=$_POST['txtmac1'];
		$mac=$_POST['txtmac'];
		$modelo=$_POST['cbmodelo'];
		echo $idmod;
		$idanexo=$_POST['idanx'];
		echo $idanexo;
		$idprov=$_POST['idprov'];
		echo $idprov;
  $obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
        $obj->mantenimiento("UPDATE tb_provision_anexo SET prov_modid='$modelo',prov_anex='$idanexo', prov_mac='$mac' where prov_id=$idprov");

/*			$sql="select prov_mac from tb_provision_anexo where prov_anex='".$idanx."'";
			$res=mysql_query($sql) or die(mysql_error());
		        $dato=mysql_fetch_row($res);
		        $rut="/tftpboot/".$dato[0].".cfg";
		        if(file_exists("$rut")){
		                unlink($rut);
		        }
*/
			 if($macb!=$mac){
                        	$rut="/tftpboot/".$macb.".cfg";
                                if(file_exists("$rut")){
                                       unlink($rut);
                                }
                         }
			
			
			 if($mac!='000000000000'){

                                $anexo=$idanexo;
                              include(MODULE_PATH . "/Provisionar/asignar.php");
                                echo "archivo creado";
                             }else{echo "No entro";}
                       







		/*====================Actualizando la tabla tb_desvios================================*/		
		$nanex=$_POST['nanexo'];
		$ntp=$_POST['ntiempo'];
		$nti=$_POST['ntipo'];

		$verif = mysql_query("SELECT * FROM tb_desvio where des_anexo=".$anx);
		$_row = mysql_fetch_row($verif);
if(!is_array($_row))
	mysql_query("INSERT INTO tb_desvio (des_anexo,des_na,des_ba,des_aa,des_cha) VALUES($anx,0,0,0,0)");	
		
		if ($nanex == "0" || $nanex ==""){
				$nanex="0";
				$ntp="0";
				$nti="0";
				$sql = "update tb_desvio set `des_na`=$nanex,`des_ntiempo`=$ntp,`des_ntipo`='$nti' where des_anexo='$anx'";

				$obj->mantenimiento($sql);

		}else {	$sql = "update tb_desvio set `des_na`=$nanex where des_anexo='$anx'";

				$obj->mantenimiento($sql);
				
		}
		if ($ntp != "0" ){
			$sql = "update tb_desvio set `des_ntiempo`=$ntp where des_anexo='$anx'";

			$obj->mantenimiento($sql);
		}
		if ( $nti!= "0" ){
			$sql = "update tb_desvio set `des_ntipo`='$nti' where des_anexo='$anx'";

			$obj->mantenimiento($sql);
		}

		$banex=$_POST['banexo'];
		$btp=$_POST['btiempo'];
		$bti=$_POST['btipo'];

		if ($banex == "0" || $banex ==""){
			$banex="0";$btp="0";$bti="0";			
				$sql = "update tb_desvio set `des_ba`=$banex,`des_btiempo`=$btp,`des_btipo`='$bti' where des_anexo='$anx'";
				$obj->mantenimiento($sql);

			}else {	$sql = "update tb_desvio set `des_ba`=$banex where des_anexo='$anx'";
				$obj->mantenimiento($sql);				
		}
		if ($btp!= "0"){
			$sql = "update tb_desvio set `des_btiempo`=$btp where des_anexo='$anx'";
			$obj->mantenimiento($sql);
		}
		if ($bti!= "0" ){
			$sql = "update tb_desvio set `des_btipo`='$bti' where des_anexo='$anx'";
			$obj->mantenimiento($sql);
		}

		$chanex=$_POST['chanexo'];
                $chtp=$_POST['chtiempo'];
                $chti=$_POST['chtipo'];

                if ($chanex == "0" || $chanex ==""){
                        $chanex="0";$chtp="0";$chti="0";
                                $sql = "update tb_desvio set `des_cha`=$chanex,`des_chtiempo`=$chtp,`des_chtipo`='$chti' where des_anexo='$anx'";
                                $obj->mantenimiento($sql);
                        }else {
                                $sql = "update tb_desvio set `des_cha`=$chanex where des_anexo='$anx'";
                                $obj->mantenimiento($sql);


                }
                if ($chtp!="0" ){

                        $sql = "update tb_desvio set `des_chtiempo`=$chtp where des_anexo='$anx'";
                        $obj->mantenimiento($sql);
                }
                if ($chti!="0"){

                        $sql = "update tb_desvio set `des_chtipo`='$chti' where des_anexo='$anx'";
                        $obj->mantenimiento($sql);
                }

		$aanex=$_POST['aanexo'];
		$atp=$_POST['atiempo'];
		$ati=$_POST['atipo'];

		if ($aanex == "0" || $aanex ==""){
			$aanex="0";$atp="0";$ati="0";			
				$sql = "update tb_desvio set `des_aa`=$aanex,`des_atiempo`=$atp,`des_atipo`='$ati' where des_anexo='$anx'";
				$obj->mantenimiento($sql);
			}else {
				$sql = "update tb_desvio set `des_aa`=$aanex where des_anexo='$anx'";
				$obj->mantenimiento($sql);
				
			
		}
		if ($atp!="0" ){
			
			$sql = "update tb_desvio set `des_atiempo`=$atp where des_anexo='$anx'";
			$obj->mantenimiento($sql);
		}
		if ($ati!="0"){
			
			$sql = "update tb_desvio set `des_atipo`='$ati' where des_anexo='$anx'";
			$obj->mantenimiento($sql);
		}
		
		/*====================================================Generando Sip Adicional==================================================================*/
		$lineas3[]="[default]";
	//	include (MODULE_PATH ."/summod02/Generar_sip.php");
		include (MODULE_PATH ."/summod02/Generar_hints.php");
		include (MODULE_PATH ."/summod02/Generar_voicemail.php");
		include (MODULE_PATH ."/summod02/phonebook.php");
		include (MODULE_PATH ."/summod02/aplicar.php"); 
		include (MODULE_PATH ."/summod02/Generar_fop_botones.php"); 
		include (MODULE_PATH ."/summod02/mensaje_desvio.php");
		/*====================================================Fin del Sip Adicional====================================================================*/
		 header("location: " . base_url() ."/summod02/summod02"); 
	} else {
		header("location: " . base_url() ."/summod02/summod02");
	}
