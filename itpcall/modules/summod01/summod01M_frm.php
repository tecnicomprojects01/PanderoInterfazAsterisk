<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bluetabs.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/validacion.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dropdowntabs.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>style.css">
<style type="text/css">
<!--
.Estilo1 {
	color: #000000;
	font-weight: bold;
}
-->
.links4{background-color: #FFF3B3 !important;}
</style>
</head>
<body>

  
  
  <?php

        $obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
        #$perfil = 1;
        //page_header($obj,$_SESSION['perfil']);
        #page_header($obj,$perfil);
        unset($obj);

?>

<!-- --> 
</div>

<!--  Contenido dinamico  -->
<div class="content"> 
<?php
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->selectusuariop($_GET['idus']);		
	$cont=0;
	$row=$obj->respuesta()
?>
	<form name="frmUsuario" method="post" action="<?php echo base_url();?>summod01/summod01M">
<table width="99%" cellspacing="3" cellpading="3" border="0">
	<caption>MODIFICAR DATOS DE USUARIO</caption>
	<thead>
		<tr>
			<td valign="top" width="50%" class="cont-table">
				<table>	 
	<tr class="text-izq">
	<td>Usuario :</td>
	<td><input type="text" name="usuario" value="<?php echo $row[0];?>" readonly=""></td>
	</tr>
	<tr class="text-izq">
	<td>Clave :</td>
	<td><input type="password" name="clave" value="<?php echo $row[1];?>" readonly=""></td>
	</tr>
	
	<tr class="text-izq">
	<td>Perfil :</td>
	<td><input type="text" name="perfil" value="<?php echo $row[2];?>" readonly=""></td>
	</tr>
	
	<tr class="text-izq">
	<td>Clave Nueva</td>
	<td><input type="password" name="claven" value=""></td>
	</tr>
	<tr class="text-izq">
	<td>Extension :</td>
	<td><input type="text" name="exten" value="<?php echo $row[3];?>"></td>
	</tr>

	<tr class="text-izq">
	<td>Perfil :</td>
	<td>
<?php
	if ($row[0] == "admin" && $row[2] == "Administrador"){
		echo "<select name='perfiln'><option value='1' selected='selected' disabled='disabled'>Administrador</option></select>";
	}
	else {
?>
	<select name="perfiln">
		<option value="0">[Seleccione Perfil...]</option>
		<option value="1">Administrador</option>
		<option value="2">Usuario</option>
		<option value="3">Reporte</option>
	</select>	
<?php
	}
?>	</td>
	</tr>
	<tr valign="middle">
	<td height="45" colspan="2" align="center">
	<input type="button" class="btn-person" onclick="location.href='<?php echo base_url();?>summod01/summod01'" value="Cancelar">
	&nbsp;
	<input name="modificar" type="submit" class="btn-person" value="Modificar"></td>
	<input type="hidden" name="idus" value=<?php echo $_GET['idus'];?> />
	</tr>
	</table>
			</td>
			<td valign="top" width="50%" class="cont-table">
				<div style="width:100%; display:block;"></div>
			</td>
		</tr>
	</thead>
</table>		
	
	<br>
	</form>
</div>
<!--  Fin Contenido dinamico  -->