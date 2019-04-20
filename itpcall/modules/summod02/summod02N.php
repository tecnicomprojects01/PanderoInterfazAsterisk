<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
	if (isset($_POST['crear'])){
		//$error = $_POST['error'];
		$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
		
		$anexo = $_POST['numero'];
		$obj->buscar_anexo($anexo);		
		$cant = $obj->cantregistros();
		
		if ($cant > 0){
			header("location: ". base_url() ."summod02/summod02N_frm/error=si&id=$anexo");
		}else{
			//header("location: summod02N_frm.php?error=no");

			// Tbl_Anexos
			$idanexo = "NULL";
			$anexo = $_POST['numero'];
			$codecs = $_POST['codecs'];
			$nat = $_POST['nat'];
			$canreinvite = $_POST['canreinvite'];
			$qualify = $_POST['qualify'];
			$flag = "1";
			$idlocal = "1";
			$nanexo=$_POST['nanexo'];
			$ntiempo=$_POST['ntiempo'];
			$ntipo=$_POST['ntipo'];
			$banexo=$_POST['banexo'];
			$btiempo=$_POST['btiempo'];
			$btipo=$_POST['btipo'];
			$aanexo=$_POST['aanexo'];
			$atiempo=$_POST['atiempo'];
			$atipo=$_POST['atipo'];
			$chanexo=$_POST['chanexo'];
                        $chtiempo=$_POST['chtiempo'];
                        $chtipo=$_POST['chtipo'];			
                        $createwaitcall=$_POST['createwaitcall'];			
                        $createvoicemail=$_POST['createvoicemail'];	
			$grabar=$_POST['grabar'];		
			$mac=$_POST['txtmac'];
			$modtelf=$_POST['modtelf'];
			$passcall=($_POST['passcall']!="")?'on':'off';
			$obj->insert_anexo($idanexo,$anexo,$flag,$idlocal);
			$anx_est = 1;
			$lla_tmp = "NULL";
			$lla_cnl = "NULL";
			$lla_dst = "NULL";
			$anx_nro = $_POST['numero'];
			$anx_ip = "NULL";
			$anx_nom = $_POST['nombre'];
			
			$obj->insert_monitoreo($anx_est,$lla_tmp,$lla_cnl,$lla_dst,$anx_nro,$flag,$anx_ip,$anx_nom);
			// Fin
					
			//Tbl_anexo_parametro
			$obj->buscar_anexo($anexo);
			while($row=$obj->respuesta()){
				$idanexo = $row[0];
			}// Fin
			
			$idparam = array();
			$param = array();
			
			$cont=0;		
			$obj->select_param();
			$totreg = $obj->cantregistros();
			while($row=$obj->respuesta()){
				$idparam[$cont] = $row[0];
				$param[$cont] = $row[1];
				$cont = $cont + 1;
			}
			
			$i = 0;
			while ($i < $totreg){
				if ($param[$i] == "account"){ $valor = $_POST['numero']; $orden=1;}				
				if ($param[$i] == "callerid"){ $valor = '"'.$_POST["nombre"].'" <'.$_POST["numero"].'>'; $orden=2;}
				if ($param[$i] == "type") {$valor = "friend"; $orden=3;}
				if ($param[$i] == "username"){ $valor = $_POST['numero']; $orden=4;}
				if ($param[$i] == "secret"){ $valor = $_POST['clave']; $orden=5;}
				if ($param[$i] == "host") {$valor = "dynamic";	$orden=6;}
				if ($param[$i] == "context") {$valor = $_POST['contexto']; $orden=7;}
				if ($param[$i] == "call-limit") {$valor = $_POST['call-limit']; $orden=8;}
				if ($param[$i] == "dtmfmode") {$valor = $_POST['dtmfmode']; $orden=9;}
				if ($param[$i] == "subscribecontext") {$valor = "hints"; $orden=10;}				
				if ($param[$i] == "canreinvite") {$valor = $_POST['canreinvite']; $orden=11;}				
				if ($param[$i] == "qualify") {$valor = $_POST['qualify']; $orden=12;}
				if ($param[$i] == "nat") {$valor = $passcall; $orden=13;}				
				if ($param[$i] == "callgroup") {$valor = $_POST['callgroup']; $orden=14;}
				if ($param[$i] == "pickupgroup") {$valor = $_POST['pickupgroup']; $orden=15;}
				if ($param[$i] == "mailbox") {$valor = $_POST['numero']."@default"; $orden=16;}
				if ($param[$i] == "setvar") {$valor = "USERID=".$_POST['numero']; $orden=17;}
				if ($param[$i] == "disallow"){$valor = "all"; $orden=18;}
				if ($param[$i] == "allow"){
					if ($codecs == ""){$valor = "ulaw";}
					else {$valor = $codecs;}
					$orden=19;
				} 				
				if ($param[$i] == "createwaitcall"){$valor = $_POST['createwaitcall']; $orden=20;}
				if ($param[$i] == "createvoicemail"){$valor = $_POST['createvoicemail']; $orden=21;}
		print_r($_POST['createvoicemail']);
				if ($param[$i] == "record"){$valor = $_POST['grabar']; $orden=22;}
				$obj->insert_anexo_param($idanexo,$idparam[$i],$valor,$orden);	
				$nombre = $_POST['nombre'];
				$i = $i + 1;
			
			}
			$flag = 1;
			$obj->insert_desvio($anexo,$nanexo,$ntiempo,$ntipo,$banexo,$btiempo,$btipo,$aanexo,$atiempo,$atipo,$chanexo,$chtiempo,$chtipo);								
			      $obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
		
//	                $mac=$_POST['txtmac'];
 //       	        $modelo=$_POST['cbmodelo'];
//	                $result=mysql_query("SELECT prov_mac FROM tb_provision_anexo where prov_mac='$mac' or prov_anex='$anexo'");
//	                if( mysql_num_rows($result)==0) {

//******registrar en la tabla tb_provisionar_anexo**********//

//                                $sql="INSERT INTO tb_provision_anexo(`prov_modid`,`prov_anex`,`prov_mac`)";
 //                               $sql.= " values ($modelo,$anexo,'$mac')";
   //                             mysql_query($sql);
	//			if($mac!='000000000000'){
	//			 include(MODULE_PATH . "/Provisionar/asignar.php");
	//			}
			}
/*====================================================Generando Sip Adicional==================================================================*/
// include (MODULE_PATH ."/summod02/aplicar_grabar.php");
//include (MODULE_PATH ."/summod02/Generar_sip.php");
include(MODULE_PATH ."/summod02/Generar_hints.php");
include (MODULE_PATH ."/summod02/Generar_voicemail.php");
include(MODULE_PATH ."/summod02/phonebook.php");
include (MODULE_PAH ."/summod02/Generar_fop_botones.php");
include (MODULE_PATH ."/summod02/mensaje_desvio.php");
include (MODULE_PATH ."/summod02/aplicar.php"); 
/*====================================================Fin del Sip Adicional====================================================================*/

                              $obj = new conexiongestor($srv01,$usu01,$pas01,$base01);

			$sqlanexo=mysql_query("select idanexo from tb_anexos where anexo='$anexo'");
			$rowanexo= mysql_fetch_row($sqlanexo);
			$idanexo=$rowanexo[0];                      
			echo $idanexo;	
			$mac=$_POST['txtmac'];
			echo $mac;
                     $modelo=$_POST['cbmodelo'];
			echo $modelo;
                      $result=mysql_query("SELECT prov_mac FROM tb_provision_anexo where prov_mac='$mac'");
			$vrd="SELECT prov_mac FROM tb_provision_anexo where prov_mac='$mac'";
			echo $vrd;
                     if( mysql_num_rows($result)==0) {

//******registrar en la tabla tb_provisionar_anexo**********//

                                $sql="INSERT INTO tb_provision_anexo(`prov_modid`,`prov_anex`,`prov_mac`)";
                               $sql.= " values ($modelo,$idanexo,'$mac')";
				echo $sql;

                            mysql_query($sql);
                      if($mac!='000000000000'){
				$anexo=$idanexo;
                              include(MODULE_PATH . "/Provisionar/asignar.php");
				echo "archivo creado";
                             }else{echo "No entro";}
                        }

 header("location: " . base_url() ."/summod02/summod02"); 
}
?>
