<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bluetabs.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />

<script type="text/javascript">
<!--
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

function PopupCenter(pageURL, title,w,h) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
-->
</script>

<script type="text/javascript" src="<?php echo base_url();?>js/validacion.js"></script>

<style type="text/css">
</style>
</head>
<body class="body">

  
  <?php
  
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	/*$perfil = 1;
	//page_header($obj,$_SESSION['perfil']);
	//page_header($obj,$perfil);*/
	#$perfil = 1;
	//page_header($obj,$_SESSION['perfil']);
	#page_header($obj,$perfil);

	unset($obj);
?>




<div class="content" > 
<!------	CODIGO GENERADO POR EL USUARIO	------>

<form name="frmAnexos" action="<?php echo base_url();?>summod02/summod02N" method="post" onsubmit="return valida_form_anexo(this);">
<br />
<table width="99%" cellspacing="3" cellpading="3" border="0">
  <caption>GENERAR NUEVO ANEXO</caption>
  <thead>
    <tr>
      <td valign="top" width="60%" class="cont-table">
<table width="100%" cellspacing="3" cellpading="3" border="0">  
<thead> 
  <tr>
    <th colspan="6">Datos Basicos del Anexo</th>
  </tr>
</thead>
<tbody>
<?php
  $error = (isset($_GET["error"])) ? $_GET['error'] : '';
  $id = (isset($_GET["id"])) ? $_GET['id'] : '';
  if ($error == ""){
    $error = "no";
  }else{
    $error = $error;
  }
  
  $txt = "";
  if ($error == "si"){
    $txt = "El anexo ".$id ." ya existe";
  }
  elseif($error == "no"){
    $txt = "";
  }
?>
  <tr>
	<td colspan="6" class="msj-error Estilo3 Estilo5">
      		<div align="left"><?php echo $txt;?><input type="hidden" name="codecs" /></div>
	</td>
</tr>
<tr>
	<td align="right">
      		<div align="left"><span class="Estilo6">Numero:</span></div>
    	</td>
    	<td align="left" colspan="2">
      		<div align="left"><input name="numero" type="text" class="style-text-box " maxlength="20"/></div>
    	</td>
    	<td align="left"><div align="left">
      		<span class="Estilo6">Nombre:</span></div>
    	</td>
	<td align="left" colspan="2">
      		<div align="left"><input name="nombre" type="text" class="style-text-box " /></div>
	</td>
</tr>
<tr>
	<td align="left">
      		<div align="left"><span class="Estilo6">Contrasena: </div>
    	</td>
	<td align="left" colspan="2">
      		<div align="left"><input name="clave" type="password" class="style-text-box " maxlength="30"/></div>
    	</td>
	<td  align="left">
		<div align="left"><span class="Estilo6">Activar Clave de Llamada
	</td>
	<td align="left" colspan="2">
      		<input type="checkbox" name="passcall" />
                <span class="Estilo21">si/no</span>
        </td>
</tr>  

<!--  <tr>
    <td align="right">
      <div align="left"><span class="Estilo6">Canreinvite:</span></div>
    </td>
    <td align="left" colspan="2">
      <div align="left"><span class="Estilo7">
      <select name="canreinvite">
        <option value="no" selected>no</option>
        <option value="yes">yes</option>
      </select>
      </span></div>
    </td>
		<td align="left">
			<span class="Estilo6">Qualify:</span>
		</td>
		<td align="left" colspan="2">
			<div align="left"><span class="Estilo7">
			  	<select name="qualify">
        				<option value="no" >no</option>
				        <option value="yes" selected>yes</option>
      				</select>
      			</span></div>
   		 </td>
	</tr>   
  	<tr>
    		<td align="right">
      			<div align="left"><span class="Estilo6">NAT:</span></div>
    		</td>
    		<td align="left" colspan="2">
      			<div align="left"><span class="Estilo7">
				<select name="nat">
					<option value="no" selected>no</option>
					<option value="yes">yes</option>
				</select>
      			</span></div>
		</td>
   
		<td align="right">
      			<div align="left"><span class="Estilo6">Pickupgroup:</span></div>
    		</td>
		<td align="left" colspan="2"><div align="left">
      			<input name="pickupgroup" type="text" class="style-text-box " value="1" maxlength="5"/></div>
    		</td>
	</tr>  
  	<tr>
  
		<td align="left">
			<div align="left"><span class="Estilo6">Callgroup:</span></div>
    		</td>
		<td align="left" colspan="2"><div align="left">
      			<input name="callgroup" type="text" class="style-text-box " value="1" maxlength="5"/></div>
    		</td>
    		<td align="left">Buzon de voz:</td>
    		<td align="left" colspan="2"><input type="checkbox" name="createvoicemail" value="0">SI/NO</td>
	</tr>
-->
  	<tr>

		<td align="left">
		    	<div align="left"><span class="Estilo6">Llamada en espera:</span></div>
    		</td>
		<td align="left" colspan ="2">
    			<div align="left"><input name="createwaitcall" type="number" class="style-text-box " value="1" min="0"/>0=Ilimitado</div>
    		</td>
		<td align="left">Grabar Llamada:</td>
	    	<td align="left" colspan="2">
			<select name="grabar">
		        	<option value="0" selected>no</option>
	        		<option value="1">yes</option>
      			</select>
		</td>
  	</tr> 
  
<!--
// Codec 
  <tr>
    <td align="right">
      <div align="left"><span class="Estilo6">Codec:</span></div>
    </td>
    <td colspan="5" align="left">
      <div align="left"><span class="Estilo7">       
      <input type="checkbox" name="codec" onclick="check_codec()" value="ulaw" checked="checked" />ulaw &nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="codec" onclick="check_codec()" value="alaw"/>alaw &nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="codec" onclick="check_codec()" value="gsm" />gsm  &nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="codec" onclick="check_codec()" value="g729"/>g729 &nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="codec" onclick="check_codec()" value="g723"/>g723 &nbsp;&nbsp;&nbsp;
      </span><span class="Estilo7">
      </span></div>
    </td>
  </tr>
-->
  <!-- Fin codec -->  

<thead>
  <tr>
    <th colspan="6">Datos de Aprovisionamiento</th>
  </tr>
</thead>
  <tr>
    <td align="right">
      <div align="left" class="Estilo3"><strong>MAC: </strong></div>
    </td>
    <td align='left'><div align='left' class='Estilo 3'><input name='txtmac' type='text' class='style-text-box ' value="000000000000" maxlength="12"/></div>
    </td>
    <td align='left' colspan='2'>
      <div align="left" class="Estilo3"><strong>Modelo de Telefono: </strong></div>
    </td>
	<td colspan='2'>
	 <select name="cbmodelo">
<?php
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
        $obj->mantenimiento("SELECT Modtelf_id,Modtelf_desc,telf_Marca FROM tb_telefono_modelo m INNER JOIN tb_telefono_marca ma ON m.Modtelf_idmar=telf_id ORDER BY telf_Marca,Modtelf_desc");
        while($row = $obj->respuesta()){
                echo "<option value='$row[0]'>$row[2] - $row[1]</option>";
        }
        echo" </select></td>";

?>

</td>
</tr>
<!--  Inicio Desvio    -->
<thead> 
  <tr>
    <th colspan="6">Desvio de Anexo</th>
  </tr>
</thead>
  <tr>
    <td align="right">
      <div align="left" class="Estilo3"><strong>Al No Constestar </strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3"><input name="nanexo" type="text" class="style-text-box " value="0" maxlength="12"/></div>
    </td>
    <td align="left">
      <div align="left" class="Estilo3"><strong>Tiempo</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3">
      <input name="ntiempo" type="text" class="style-text-box" value="0" maxlength="12"/></div>
    </td>
    <td align="left">
      <div align="left" class="Estilo3"><strong>Tipo Canal</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3">
       <select name="ntipo">
	<option value='0' selected=\"selected\">[Seleccione]</option>
        <option value="SIP">Anexo</option>
        <option value="topex">Celular</option>
        <option value="i2">Fijo</option>
      </select>
	</div>
    </td>

  </tr>
  <tr>
    <td align="right">
      <div align="left" class="Estilo3"><strong>Ocupado</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3"><input name="banexo" type="text" class="style-text-box " value="0" maxlength="12"/></div>
    </td>
    <td align="left">
      <div align="left" class="Estilo3"><strong>Tiempo</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3">
      <input name="btiempo" type="text" class="style-text-box" value="0" maxlength="12"/></div>
    </td>
    <td align="left">
      <div align="left" class="Estilo3"><strong>Tipo Canal</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3">
       <select name="btipo">
	<option value='0' selected=\"selected\">[Seleccione]</option>
        <option value="SIP">Anexo</option>
        <option value="topex">Celular</option>
        <option value="i2">Fijo</option>
      </select>
	</div>
    </td>

  </tr>
 <tr>
    <td align="right">
      <div align="left" class="Estilo3"><strong>Desconectado</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3"><input name="chanexo" type="text" class="style-text-box " value="0" maxlength="12"/></div>
    </td>
    <td align="left">
      <div align="left" class="Estilo3"><strong>Tiempo</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3">
      <input name="chtiempo" type="text" class="style-text-box" value="0" maxlength="12"/></div>
    </td>
    <td align="left">
      <div align="left" class="Estilo3"><strong>Tipo Canal</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3">
       <select name="chtipo">
        <option value='0' selected=\"selected\">[Seleccione]</option>
        <option value="SIP">Anexo</option>
        <option value="topex">Celular</option>
        <option value="i1">Fijo</option>
      </select>
        </div>
    </td>

  </tr>


<tr>
    <td align="right">
      <div align="left" class="Estilo3"><strong>Todos </strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3"><input name="aanexo" type="text" class="style-text-box " value="0" maxlength="12"/></div>
    </td>
    <td align="left">
      <div align="left" class="Estilo3"><strong>Tiempo</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3">
      <input name="atiempo" type="text" class="style-text-box" value="0" maxlength="12"/></div>
    </td>
    <td align="left">
      <div align="left" class="Estilo3"><strong>Tipo Canal</strong></div>
    </td>
    <td align="left"><div align="left" class="Estilo3">
       <select name="atipo">
	<option value='0' selected=\"selected\">[Seleccione]</option>
        <option value="SIP">Anexo</option>
        <option value="topex">Celular</option>
        <option value="i2">Fijo</option>
      </select>
	</div>
    </td>

  </tr>
  <!--  Fin Desvio -->
  <tr>
    <td colspan="6" align="center">
      <input name="cancelar" value="Cancelar" class="btn-person" type="reset" onclick="location.href='<?php echo base_url();?>summod02/summod02'"/>
      <input type="submit" name="crear" value="Guardar" class="btn-person"/>
    </td>
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

<!------	FIN CODIGO GENERADO POR EL USUARIO	-->
</div>
