<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bluetabs.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/validacion.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dropdowntabs.js"></script>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo3 {color: #000000}
.Estilo4 {
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
	font-weight: bold;
}
.Estilo5 {font-family: Arial, Helvetica, sans-serif; color: #000000; }
#m_anexos {display: block;}
.links{background-color: #FFF3B3 !important;}
</style>

 
  <script type="text/javascript">
<!--
function check_codec(){
	var nchk = 0;
	var c_value = "";
	var c=0;
	var cad = "";
	nchk = document.frmAnxLote.codec.length;
	for (var i=0; i < nchk; i++){
		if (document.frmAnxLote.codec[i].checked){
			c++;
			c_value = c_value + document.frmAnxLote.codec[i].value + '&';
		}
	}

	if (c_value.charAt(c_value.lastIndexOf('&')) == "&"){
		c_value = c_value.substring(0,c_value.length - 1)
	}
	document.frmAnxLote.codecs.value = c_value;
}
-->
</script>
  
  <?php 
        $obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
        #$perfil = 1;
        //page_header($obj,$_SESSION['perfil']);
        #page_header($obj,$perfil);
        unset($obj);


/*	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	#$perfil = 1;
	page_header($obj,$_SESSION['perfil']);
	#page_header($obj,$perfil);
	unset($obj);*/
?>

<body>
  


<div class="clear"></div>
<div class="content"> 
<?php
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$anexo = 0;
	$fin = 0;

	if (isset($_POST['crear'])) {
		$anexo = $_POST['inicio'];
		$fin = $_POST['fin'];
		$codecs = $_POST['codecs'];
		
		while ($anexo <= $fin){
			$idanexo = "NULL";
			$anexo = $anexo;
			$flag = "1";
			$idlocal = "1";
					
			$obj->insert_anexo($idanexo,$anexo,$flag,$idlocal);
			
			# Open Buscar idanexo
			$obj->buscar_anexo($anexo);
			while($row=$obj->respuesta()){
				$idanexo = $row[0];
			}
			
			# Open Insert anexo_parametro
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
				if ($param[$i] == "account"){ $valor = $anexo; $orden=1;}
				if ($param[$i] == "type") {$valor = "friend"; $orden=3;}			
				if ($param[$i] == "username"){ $valor = $anexo; $orden=4;}
				if ($param[$i] == "secret"){ $valor = $_POST['clave']; $orden=5;}
				if ($param[$i] == "callerid"){ $valor ='"'.$anexo.'" <'.$anexo.'>'; $orden=2;}
				if ($param[$i] == "host") {$valor = "dynamic";	$orden=6;}
				if ($param[$i] == "context") {$valor = $_POST['contexto']; $orden=7;}
				if ($param[$i] == "call-limit") {$valor = $_POST['call-limit']; $orden=8;}
				if ($param[$i] == "dtmfmode") {$valor = $_POST['dtmfmode']; $orden=9;}
				if ($param[$i] == "subscribecontext") {$valor = "hints"; $orden=10;}
				if ($param[$i] == "canreinvite") {$valor = $_POST['canreinvite']; $orden=11;}				
				if ($param[$i] == "qualify") {$valor = $_POST['qualify']; $orden=12;}
				if ($param[$i] == "nat") {$valor = $_POST['nat']; $orden=13;}				
				if ($param[$i] == "callgroup") {$valor = $_POST['callgroup']; $orden=14;}
				if ($param[$i] == "pickupgroup") {$valor = $_POST['pickupgroup']; $orden=15;}										
				if ($param[$i] == "mailbox") {$valor = $anexo."@default"; $orden=16;}
				if ($param[$i] == "setvar") {$valor = "USERID=".$anexo; $orden=17;}
				if ($param[$i] == "disallow"){$valor = "all"; $orden=18;} 
				if ($param[$i] == "allow"){
					if ($codecs == ""){$valor = "ulaw";}
					else {$valor = $codecs;}
					$orden=19;
				} 				
				if ($param[$i] == "createwaitcall"){$valor = 1; $orden=20;}
				if ($param[$i] == "createvoicemail"){$valor = 0; $orden=21;}
				if ($param[$i] == "record"){$valor = 0; $orden=22;}
 				
			
				$obj->insert_anexo_param($idanexo,$idparam[$i],$valor,$orden);	
				$i = $i + 1;
				
				
				}

			$nanexo=0;
				$ntiempo=0;
				$ntipo='0';
				$banexo=0;
				$cha=0;
				$chtiempo=0;
				$chtipo=0;
				$btiempo=0;
				$btipo='0';
				$aanexo=0;
				$atiempo=0;
				$atipo='0';
				$obj->insert_desvio($anexo,$nanexo,$ntiempo,$ntipo,$banexo,$btiempo,$btipo,$aanexo,$atiempo,$atipo,$cha,$chtiempo,$chtipo);

			# Open insert tb_monitoreo
			$anx_est = 1;
			$lla_tmp = "NULL";
			$lla_cnl = "NULL";
			$lla_dst = "NULL";
			$anx_nro = $anexo;
			$anx_ip = "NULL";
			$anx_nom = $anexo;
			$obj->insert_monitoreo($anx_est,$lla_tmp,$lla_cnl,$lla_dst,$anx_nro,$flag,$anx_ip,$anx_nom);
			$anexo++;
		}
	include(MODULE_PATH ."/summod02/Generar_sip.php");
	include(MODULE_PATH ."/summod02/Generar_hints.php");
	include(MODULE_PATH ."/summod02/Generar_voicemail.php");
	include(MODULE_PATH ."/summod02/aplicar.php");
		echo "<br><br><center><a href='summod02.php'>Ver Anexos<a/></center>";
	}
	else {
?>
<form name="frmAnxLote" method="post" action="<?php echo base_url();?>summod02/anexosxlote" onsubmit="return valida_usuario(this);"><br />
<table width="99%" cellspacing="3" cellpading="3" border="0">
	<caption>CREACION DE ANEXOS X LOTE</caption>
	<thead>
		<tr>
			<td valign="top" width="60%" class="cont-table">
<table width="100%" cellspacing="3" cellpading="3" border="0">
<tbody>
     
	<tr>
	<td  width="28%" height="27" align="right" valign="bottom"><div align="left" class="Estilo1 Estilo3">Inicio :</div></td>
	<td width="35%" align="left" valign="bottom"><input name="inicio" type="text" maxlength="6"/></td>
	<td width="56%" align="left" valign="bottom"><span class="Estilo4">Fin :</span></td>
	<td width="56%" align="left" valign="bottom"><input type="text" name="fin" maxlength="6" /></td>
	</tr> 
  <!--  PRUEBA  -->
  <tr>
    <td align="right"><div align="left" class="Estilo5">
      <blockquote>&nbsp; </blockquote>
    </div>    <blockquote class="Estilo5"><p align="left"><strong>Clave:</strong></p>
    </blockquote></td>
    <td align="left"><input name="clave" type="password" class="style-text-box " maxlength="12"/></td>
    <td align="left"><span class="Estilo5"><strong>Contexto:</strong></span></td>
    <td align="left"><select name="contexto" id="contexto" class="style-text-box">
      <?php
	#include ("../includes/connect0.php");
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("select idnivel,nivel,descripcion,tipo from tb_anexos_niveles where descripcion <>'NULL'");
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
      <a href="javascript:alert('<?php echo $des;?>')">Ayuda</a>&nbsp;&nbsp; </td>
  </tr>
  <tr>
    <td align="right"><div align="left" class="Estilo5"><strong>Canreinvite:</strong></div></td>
    <td align="left">      <span class="Estilo3">
        <select name="canreinvite">
          <option value="no" selected>no</option>
          <option value="yes">yes</option>
        </select>
      </span> </td>
    <td align="left"><span class="Estilo5"><strong>Qualify:</strong></span></td>
    <td align="left"><select name="qualify">
      <option value="no" >no</option>
      <option value="yes" selected>yes</option>
      </select></td>
  </tr>   
  <tr>
    <td align="right"><div align="left" class="Estilo5"><strong>NAT:</strong></div></td>
    <td align="left">      <span class="Estilo3">
        <select name="nat">
          <option value="no" selected>no</option>
          <option value="yes">yes</option>
        </select>
      </span> </td>
<td align="left"><span class="Estilo5"><strong>Callgroup:</strong></span></td>
    <td align="left"><input name="callgroup" class="style-text-box" type="text" maxlength="5" value="1"/></td>
    <!--<td align="left"><span class="Estilo5"><strong>Call-limit:</strong></span></td>
    <td align="left"><input name="call-limit" class="style-text-box" type="text" maxlength="5" value="0"/></td>-->
	
  </tr>
  <tr>
    <!--<td align="right"><div align="left" class="Estilo5"><strong>Dtmfmode:</strong></div></td>
    <td align="left">      <span class="Estilo3">
        <select name="dtmfmode">
          <option value="rfc2833" selected>rfc2833</option>
          <option value="inband">inband</option>
          <option value="info">info</option>
          <option value="auto">auto</option>
        </select>
      </span> </td>-->
    
  </tr>
  <tr>
    <td align="right"><div align="left" class="Estilo5"><strong>Pickupgroup:</strong></div></td>
    <td align="left"><input name="pickupgroup" type="text" class="style-text-box " value="1" maxlength="5"/></td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><div align="left" class="Estilo5"><strong>Codec:</strong></div></td>
    <td colspan="3" align="left"><span class="Estilo3">
 
 <input type="checkbox" name="codec" onclick="check_codec()" value="ulaw" checked="checked"/>
      ulaw
      <input type="checkbox" name="codec" onclick="check_codec()" value="alaw"/>
      alaw
     <input type="checkbox" name="codec" onclick="check_codec()" value="gsm" />
      gsm     
      <input type="checkbox" name="codec" onclick="check_codec()" value="g729"/>
      g729
      <input type="checkbox" name="codec" onclick="check_codec()" value="g723"/>
      g723
      <!-- <input type="checkbox" name="codec" onclick="check_codec()" value="gxp"/>gxp -->
        <input type="hidden" name="codecs" />
    </span></td>
  </tr>
	<tr>
	<td height="29" colspan="2" align="center">
	  <input  class="btn-person" value="Cancelar" type="reset" onclick="location.href='<?php echo base_url();?>summod02/summod02'"/>
	  &nbsp;</td>
	<td colspan="2" align="center"><input name="crear" type="submit" class="btn-person" value="Guardar" /></td>
	</tr>
	</tbody>	
	</table>
			</td>
			<td valign="top" width="40%" class="cont-table">
				<div style="width:100%; display:block;"></div>
			</td>
		</tr>
	</thead>
</table>


</form>

</div>
<?php
	}
?>
</body>