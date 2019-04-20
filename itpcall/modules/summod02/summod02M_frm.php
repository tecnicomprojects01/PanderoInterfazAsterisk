<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}

?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bluetabs.css" />
</script>

<style type="text/css">

.Estilo20 {
	color: #000000;
	font-weight: bold;
}

</style>

<script type="text/javascript">

function check_codec(){
	var nchk = 0;
	var c_value = "";
	var c=0;
	var cad = "";
	nchk = document.frmAnexos.codec.length;
	for (var i=0; i < nchk; i++){
		if (document.frmAnexos.codec[i].checked){
			c++;
			c_value = c_value + document.frmAnexos.codec[i].value + '&';
		}
	}

	if (c_value.charAt(c_value.lastIndexOf('&')) == "&"){
		c_value = c_value.substring(0,c_value.length - 1)
	}
	document.frmAnexos.codecs.value = c_value;
}

</script>

</head>

<body class="body">

 
  <?php 

	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);	
	#$perfil = 1;
	//page_header($obj,$_SESSION['perfil']);
	#page_header($obj,$perfil);
	unset($obj);
?>

<!--  Contenido dinamico  -->
<div class="content"> 
<?php
	//$base = "db_PBX";
	$idanx = $_GET['idanx'];
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->select_anexo($idanx);
	$param = array();
	$valor = array();
	
	$c = 0;
	while($row=$obj->respuesta()){
		$param[$c] = $row[1];
		$valor[$c] = $row[2];
		$c++;
	}
	
	$i=0;
	while ($i < $obj->cantregistros()){
		if ($param[$i] == "account") {$account = $valor[$i];}
		if ($param[$i] == "secret") {$secret = $valor[$i];}
		if ($param[$i] == "callerid") {$callerid = $valor[$i];}
		if ($param[$i] == "context") {$context = $valor[$i];}
		if ($param[$i] == "canreinvite") {$canreinvite = $valor[$i];}
		if ($param[$i] == "qualify") {$qualify = $valor[$i];}
		if ($param[$i] == "nat") {$passcall = $valor[$i];}
		if ($param[$i] == "callgroup") {$callgroup = $valor[$i];}
		if ($param[$i] == "pickupgroup") {$pickupgroup = $valor[$i];}
		if ($param[$i] == "call-limit") {$callLimit = $valor[$i];}
		if ($param[$i] == "dtmfmode") {$dtmfmode = $valor[$i];}
		if ($param[$i] == "createwaitcall") {$createwaitcall = $valor[$i];}
		if ($param[$i] == "createvoicemail") {$createvoicemail = $valor[$i];}
		if ($param[$i] == "record") {$grabar = $valor[$i];}

		$i++;
	}

                        $obj = new conexiongestor($srv01,$usu01,$pas01,$base01);

                        $sqlprov=mysql_query("select prov_id,prov_modid,prov_anex,prov_mac,Modtelf_desc from tb_provision_anexo pa INNER JOIN tb_telefono_modelo tm ON pa.prov_modid=tm.Modtelf_id where prov_anex=$idanx");
                        $rowprov= mysql_fetch_row($sqlprov);
                        $idprov=$rowprov[0];
                        $idmod=$rowprov[1];
			$modelo=$rowprov[4];
			$idanexp=$rowprov[2];
			$mac=$rowprov[3];
	
	$sql = "select anexo,des_na,des_ntiempo,des_ntipo,des_ba,des_btiempo,des_btipo,des_aa,des_atiempo,des_atipo,des_cha,des_chtiempo,des_chtipo from tb_desvio d INNER JOIN tb_anexos a ON d.des_anexo=a.anexo  where a.idanexo = $idanx";
	$obj->buscar_desvio($sql);	
	//$cv_estado = false;
	if ($obj->cantregistros() > 0) {
		//$cv_estado = true;
		$row=$obj->respuesta1();
		if ($row[1] <> ""){
			$nanexo = $row[1];		
			$ntiempo = $row[2];
			$ntipo = $row[3];
		}
		if ($row[4] <> ""){
			$banexo = $row[4];
			$btiempo = $row[5];
			$btipo = $row[6];

		}
		if ($row[7] <> ""){
			$aanexo = $row[7];
			$atiempo = $row[8];
			$atipo = $row[9];

		}
		 if ($row[10] <> ""){
                        $chanexo = $row[10];
                        $chtiempo = $row[11];
                        $chtipo = $row[12];

                }

	}
	else{
			$nanexo = "0";		
			$ntiempo = "0";
			$ntipo = "0";
			$banexo = "0";
			$btiempo = "0";
			$btipo = "0";
			$aanexo = "0";
			$atiempo = "0";
			$atipo = "0";
			$chanexo = "0";
                        $chtiempo = "0";
                        $chtipo = "0";

	}

	$codecs = "";
	$obj->mantenimiento("select valor from tb_anexo_parametro INNER JOIN tb_anexos using(idanexo) where idparametro=19 and idanexo='".$idanx."'");
	$row1 = $obj->respuesta1();
	$codecs = $row1[0];
	//$codecs = explode('&',$codecs);
	//echo $codecs;
?>
<form name="frmAnexos" action="<?php echo base_url();?>summod02/summod02M" method="post" >

<table width="99%" cellspacing="3" cellpading="3" border="0">
	<caption>MODIFICAR DATOS DE ANEXO</caption>
	<thead>
	 <tr>
    		  <td valign="top" width="60%" class="cont-table">
			<table width="100%" cellspacing="3" cellpading="3" border="0">  
		<thead>

 		<tr>
    			<th colspan="3">Datos Basicos del Anexo</th>
  		</tr>
		</thead>
	<tbody>

	
				<tr>
				<td align="right">
					<div align="left" class="Estilo20">Numero:</div>
				</td>
				<td align="left">
					<label class="style-text-box"><?php echo $account;?></label>
				</td>
				<td align="left">&nbsp;
				</td>
				</tr>
				<tr>
				<td align="right">
					<div align="left" class="Estilo20">Nombre:</div>
				</td>
				<td align="left">
					<span class="Estilo22 Estilo21">
					<label class="style-text-box"><?php echo $callerid;?></label>
					<input name="nombre" type="hidden" value='<?php echo "$callerid";?>' /> </span>
				</td>
				<td align="left">
<? 
					$post=strpos($callerid,"<");
					$name= substr($callerid,1,$post-3); 
?>
					<input name="nombre_n" class="style-text-box" type="text" maxlength="35" value='<?php echo $name;?>' />
				</td>
				</tr>

				<tr>
				<td align="right"><div align="left" class="Estilo20">Clave:</div></td>
				<td align="left"><label class="style-text-box Estilo22 Estilo21"><?php echo $secret;?></label></td>
				<td align="left"><input name="clave" class="style-text-box" type="text" value='<?php echo $secret ?>' maxlength="30" /></td>
				</tr>
		<!--		<tr>
				<td align="right"><div align="left" class="Estilo20">Contexto:</div></td>
				<td align="left"><label class="style-text-box Estilo22 Estilo21"><?php echo $context;?></label></td>
				<td align="left"><select name="contexto" id="contexto" class="style-text-box">
  <?php
					$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
					$obj->mantenimiento("select idnivel,nivel,descripcion from tb_anexos_niveles");
					$c = 1;
					$des = "";
					echo "<option value='0' selected=\"selected\">[Seleccione]</option>";
					while($row = $obj->respuesta()){
						echo "<option value='$row[1]'>$row[1]</option>";
						$des.= $row[1].' : '.$row[2].'\n';
						$c = $c + 1;
					}
?>
					</select>
					<input type="button" value="Ayuda" onclick="javascript: alert('<?php echo $des;?>')" />
				</td>
				</tr> -->
				<tr>
				<td align="right"><div align="left" class="Estilo20">Buzon de Voz:</div></td>
				<td align="left"><label class="style-text-box Estilo22 Estilo21"><?php echo ($createvoicemail=="1") ? "SI" : "NO";?></label></td>
				<td align="left">
					<input type="checkbox" name="createvoicemail" value="1" <?php echo ($createvoicemail == "1") ? "checked": "";?>/>
					<span class="Estilo21">si/no</span>
				</td>
				</tr>
				 <tr>
                                <td align="right"><div align="left" class="Estilo20">Activar Clave de llamada:</div></td>
                                <td align="left"><label class="style-text-box Estilo22 Estilo21"><?php echo ($passcall=="on") ? "SI" : "NO";?></label></td>
                                <td align="left">
                                        <input type="checkbox" name="passcall" <?php echo ($passcall == "on") ? "checked": "";?>/>
                                        <span class="Estilo21">si/no</span>
                                </td>
                                </tr>
				<tr>
				<td align="right"><div align="left" class="Estilo20">Llamada en espera:</div></td>
				<td align="left"><label class="style-text-box Estilo22 Estilo21"><?php echo $createwaitcall;?></label></td>
				<td align="left">
					<input type="number" name="createwaitcall" min="0" value="<?php echo $createwaitcall;?>"/>
					<span class="Estilo21">0=ilimitado</span>
				</td>
				</tr>
<!--				<tr>
				<td align="right"><div align="left" class="Estilo20">Codecs:</div></td>
				<td align="left"><label class="style-text-box Estilo22 Estilo21"><?php echo $codecs;?></label></td>
				<td align="left">
	
					<input type="checkbox" name="codec" onclick="check_codec()" value="ulaw" checked="checked"/>
					<span class="Estilo21">ulaw
					<input type="checkbox" name="codec" onclick="check_codec()" value="alaw"/>
				    	alaw
					<input type="checkbox" name="codec" onclick="check_codec()" value="gsm" />
				    	gsm  
				       <input type="checkbox" name="codec" onclick="check_codec()" value="g729"/>
				   	g729
					<input type="checkbox" name="codec" onclick="check_codec()" value="g723"/>
				    	g723
					</span>
				</td>
				</tr>
				<tr>
				<td align="right">
					<div align="left" class="Estilo20">Canreinvite:
					</div>
				</td>
				<td align="left">
					<span class="Estilo22 Estilo21">
					<label class="style-text-box"><?php echo $canreinvite;?></label>
					<input type="hidden" name="canreinvite" value="<?php echo $canreinvite; ?>" />
					</span>
				</td>
				<td align="left">
					<select name="canreinvite2">
					<option value="0" selected><?php echo $canreinvite;?></option>
					<option value="no">no</option>
					<option value="yes">yes</option>
					</select>
				</td>
				</tr>
				<tr>
				<td align="right"><div align="left" class="Estilo20"><strong>Qualify:</strong></div></td>
				<td align="left">
					<span class="Estilo22 Estilo21">
					<label class="style-text-box"><?php echo $qualify;?></label>
					<input type="hidden" name="qualify" value="<?php echo $qualify;?>" />
					</span>
				</td>
				<td align="left"><select name="qualify2">
					<option value="0" selected> <?php echo $qualify;?></option>
					<option value="no">no</option>
					<option value="yes">yes</option>
					</select>
				</td>

				</tr>

// Nat
				<tr>
				<td align="right"><div align="left" class="Estilo20"><strong>NAT:</strong></div></td>
				<td align="left"><label class="style-text-box Estilo22 Estilo21"><?php echo $nat;?></label></td>
				<td align="left"><select name="nat">
					<option value="0" selected><?php echo $nat;?></option>
					<option value="no">no</option>
					<option value="yes">yes</option>
					</select>
				</td>
				</tr>
				<tr>
				<td align="right"><div align="left" class="Estilo20"><strong>Callgroup:</strong></div></td>
				<td align="left"><span class="Estilo22 Estilo21">
					<label class="style-text-box"><?php echo $callgroup;?></label>
					<input type="hidden" name="callgroup" value="<?php echo $callgroup;?>" />
					</span>
				</td>
				<td align="left"><input name="callgroup2" class="style-text-box" type="text" maxlength="5" value="<?php echo $callgroup;?>" /></td>
				</tr>
				<tr>
				<td align="right"><div align="left" class="Estilo20"><strong>Pickupgroup:</strong></div></td>
				<td align="left" ><span class="Estilo22 Estilo21">
					<label class="style-text-box"><?php echo $pickupgroup;?></label>
					<input type="hidden" name="pickupgroup" value="<?php echo $pickupgroup;?>" />
					</span>
				</td>
				<td align="left"><input name="pickupgroup2" class="style-text-box" type="text" maxlength="5"   value="<?php echo $pickupgroup;?>" /></td>
				</tr>
-->
				<tr>
					<td align="right"><div align="left" class="Estilo20"><strong>Grabar Llamada:</strong></div></td>
					<td align="left" ><span class="Estilo22 Estilo21">
						<label class="style-text-box">
				
						<?php echo $grabar;?></label>
						
						</span>
					</td>
					<td align="left"> <select name="grabar_n">
<?php
$grab=($grabar==0)?'no':'yes';

?>
					<option value=$grabar selected><?php echo $grab;?></option>
					<option value="0">no</option>
					<option value="1">yes</option>
					</select></td>
				</tr>

<!-- Fin Nat -->



<thead>
  <tr>
    <th colspan="3">Datos de Aprovisionamiento</th>
  </tr>
</thead>
  <tr>
    <td align="right">
      <div align="left" class="Estilo3"><strong>MAC: </strong></div>
    </td>
	<td align="left">
        	<span class="Estilo22 Estilo21">
                <label class="style-text-box"><?php echo $mac;?></label>
                <input type="hidden" name="txtmac1" value="<?php echo $mac; ?>" />
                </span>
        </td>

    <td align='left'><div align='left' class='Estilo 3'><input name='txtmac' type='text' class='style-text-box ' value="<?php echo $mac; ?>" maxlength="12"/></div>
    </td>
	</tr>
	<tr>
    		<td align='left'>
		      <div align="left" class="Estilo3"><strong>Modelo de Telefono: </strong></div>
		</td>
		<td align="left">
                	<span class="Estilo22 Estilo21">
                        <label class="style-text-box"><?php echo $modelo;?></label>
                        <input type="hidden" name="idprov" value="<?php echo  $idprov; ?>" />
                        </span>
                </td>

	        <td align='left'>
        		 <select name="cbmodelo">
<?php
        $obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
        $obj->mantenimiento("SELECT Modtelf_id,Modtelf_desc,telf_Marca FROM tb_telefono_modelo m INNER JOIN tb_telefono_marca ma ON m.Modtelf_idmar=telf_id ORDER BY telf_Marca,Modtelf_desc");
        while($row = $obj->respuesta()){
		if($row[1]==$modelo){
			 echo "<option value='$row[0]' selected=\'selected\' >$row[2] - $row[1]</option>";
		}else{
			 echo "<option value='$row[0]' >$row[2] - $row[1]</option>";

		}
        }
        echo" </select></td>";

?>

</td>


<!--  Inicio Desvio    -->
 			<thead>
  				<tr>
    				<th colspan="3">Desvio de Anexo</th>
  				</tr>
			</thead>
				<tr>
    					<td align="right">
				      		<div align="left" class="Estilo20"><strong>Al No Constestar </strong></div>
					</td>
					<td align="left">
						<label class="style-text-box"><?php echo $nanexo;?></label>
					</td>
					<td align="left"><div align="left"><input name="nanexo" type="text" class="style-text-box " value='<?php echo $nanexo ?>' maxlength="12"/></div>
    					</td>
				</tr>
				<tr>
					<td align="left">
				      	<div align="left" >Tiempo</div>
					</td>
					<td align="left">
						<label class="style-text-box"><?php echo $ntiempo; ?></label>
					</td>
					<td align="left">
						<div align="left" ><input name="ntiempo" type="text" class="style-text-box" value='<?php echo $ntiempo ?>' maxlength="12"/></div>
    					</td>
				</tr>
				<tr>
					<td align="left">
				   	   	<div align="left" >Tipo Canal</div>
					</td>
					<td align="left">
<?					 		if($ntipo=='SIP') $nntipo='Anexo';
							if($ntipo=='topex') $nntipo='Celular';
							if($ntipo=='i2') $nntipo='Fijo';
							if($ntipo=='0') $nntipo='Seleccione';	
?>

						<label class="style-text-box"><?php echo $nntipo;?></label>
					</td>
					<td align="left">
						<div align="left" ><select name="ntipo">
							<option value='<?php echo $ntipo ?>' selected=\"selected\"><?php echo $nntipo; ?></option>
        						<option value="SIP">Anexo</option>
        						<option value="topex">Celular</option>
        						<option value="i2">Fijo</option>
     						 </select>
						</div>
    					</td>
		
				</tr>
  				<tr>
					<td align="right">	
				    	  	<div align="left" ><strong>Ocupado</strong></div>
					</td>
					<td align="left">
						<label class="style-text-box"><?php echo $banexo;?></label>
					</td>
					<td align="left">
						<div align="left" ><input name="banexo" type="text" class="style-text-box " value="<?php echo $banexo;?>" maxlength="12"/></div>
    					</td>
				</tr>
				<tr>
					<td align="left">
				      		<div align="left" >Tiempo</div>
					</td>
					<td align="left">
						<label class="style-text-box"><?php echo $btiempo;?></label>
					</td>
					<td align="left">
						<div align="left" ><input name="btiempo" type="text" class="style-text-box" value="<?php echo $btiempo;?>" maxlength="12"/></div>
    					</td>
				</tr>
    					<td align="left">
      						<div align="left">Tipo Canal</div>
    					</td>
					<td align="left">
<?					 		if($btipo=='SIP') $nbtipo='Anexo';
							if($btipo=='topex') $nbtipo='Celular';
							if($btipo=='i2') $nbtipo='Fijo';
							if($btipo=='0') $nbtipo='Seleccione';	
?>

						<label class="style-text-box"><?php echo $nbtipo;?></label>
					</td>
 					<td align="left">
						<div align="left" ><select name="btipo">

							<option value='<?php echo $btipo;?>' selected=\"selected\"><?php echo $nbtipo;?></option>
        						<option value="SIP">Anexo</option>
        						<option value="topex">Celular</option>
        						<option value="i2">Fijo</option>
     						 </select>
						</div>
    					</td>
				</tr>
				<tr>
                                        <td align="right">
                                                <div align="left" ><strong>Desconectado</strong></div>
                                        </td>
                                        <td align="left">
                                                <label class="style-text-box"><?php echo $chanexo;?></label>
                                        </td>
                                        <td align="left">
                                                <div align="left" ><input name="chanexo" type="text" class="style-text-box " value="<?php echo $chanexo;?>" maxlength="12"/></div>
                                        </td>
                                </tr>
                                <tr>
                                        <td align="left">
                                                <div align="left" >Tiempo</div>
                                        </td>
                                        <td align="left">
                                                <label class="style-text-box"><?php echo $chtiempo;?></label>
                                        </td>
                                        <td align="left">
                                                <div align="left" ><input name="chtiempo" type="text" class="style-text-box" value="<?php echo $chtiempo;?>" maxlength="12"/></div>
                                        </td>
                                </tr>
                                        <td align="left">
                                                <div align="left">Tipo Canal</div>
                                        </td>
                                        <td align="left">
<?                                                      if($chtipo=='SIP') $nchtipo='Anexo';
                                                        if($chtipo=='topex') $nchtipo='Celular';
                                                        if($chtipo=='i2') $nchtipo='Fijo';
                                                        if($chtipo=='0') $nchtipo='Seleccione';
							if($chtipo=='') $nchtipo='Seleccione';

?>

                                                <label class="style-text-box"><?php echo $nchtipo;?></label>
                                        </td>
                                        <td align="left">
                                                <div align="left" ><select name="chtipo">

                                                        <option value='<?php echo $chtipo;?>' selected=\"selected\"><?php echo $nchtipo;?></option>
							<option value="SIP">Anexo</option>
                                                        <option value="topex">Celular</option>
                                                        <option value="i2">Fijo</option>
                                                 </select>
                                                </div>
                                        </td>
                                </tr>


				<tr>
					<td align="right">
						<div align="left" ><strong>Todos </strong></div>
					</td>
					<td align="left">
						<label class="style-text-box"><?php echo $aanexo;?></label>
					</td>
					<td align="left">
						<div align="left" ><input name="aanexo" type="text" class="style-text-box " value="<?php echo $aanexo;?>" maxlength="12"/></div>
    					</td>
				</tr>
				<tr>
    					<td align="left">
				      		<div align="left" >Tiempo</div>
					</td>
					<td align="left">
						<label class="style-text-box"><?php echo $atiempo;?></label>
					</td>
					<td align="left">
						<div align="left"> <input name="atiempo" type="text" class="style-text-box" value="<?php echo $atiempo;?>" maxlength="12"/></div>
					</td>
				</tr>
				<tr>
					<td align="left">
						<div align="left" >Tipo Canal</div>
					</td>
					<td align="left">
<?					 		if($atipo=='SIP') $natipo='Anexo';
							if($atipo=='topex') $natipo='RPM';
							if($atipo=='topex') $natipo='Celular';
							if($atipo=='i2') $natipo='Fijo';
							if($atipo=='0') $natipo='Seleccione';	
?>

						<label class="style-text-box"><?php echo $natipo;?></label>
					</td>
					<td align="left">
						<div align="left" ><select name="atipo">

							<option value='<?php echo $atipo;?>' selected=\"selected\"><?php echo $natipo;?></option>
        						<option value="SIP">Anexo</option>
        						<option value="topex">Celular</option>
							<option value="topex">RPM</option>
        						<option value="i2">Fijo</option>
     						 </select>
						</div>
    					</td>
		
  				</tr>
  <!--  Fin Desvio -->

				<tr align="center">
					<td colspan="3" align="right">
					<div align="center">
						<input name="cancelar" value="Cancelar" class="btn-person" type="reset" onclick="location.href='<?php echo base_url();?>summod02/summod02'"/>  
						<input type="submit" name="modificar" value="Modificar" class="btn-person" />
					</div>
				</td>
<!--onclick=""-->
	
			</tr>
		</tbody>
	</table>	
      		</td><td></td>


				

<!-- Codecs nuevos-->

					<input type="hidden" name="codecs"/>
					<input type="hidden" name="idanx" value="<?php echo $_GET['idanx'];?>" />
								
				
	</tr>
	</thead>
</table>

<input type="hidden" name="anx" value="<?php echo $_GET['anx'];?>" />
<br />
</form>
</div>
<!--  Fin Contenido dinamico  -->

