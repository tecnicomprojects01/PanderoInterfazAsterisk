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
.Estilo1 {color: #F4F4F4}
.Estilo2 {
	color: #000000;
	font-weight: bold;
}
.links4{background-color: #FFF3B3 !important;}
</style>

</head>
<body >
  
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
<form name="frmUsuario" method="post" action="<?php echo base_url();?>summod01/summod01N" onSubmit="return valida_usuario(this);">
<table width="99%" cellspacing="3" cellpading="3" border="0">
	<caption>GENERAR NUEVO USUARIO</caption>
	<thead>
		<tr>
			<td valign="top" width="40%" class="cont-table">
	<table>         
	<tr class="text-izq">
	<td >Usuario:</td>
	<td><input type="input" name="usuario"></td>
	</tr>
	<tr class="text-izq">
	<td>Clave:</td>
	<td><input type="password" name="clave"></td>
	</tr>
	<tr class="text-izq">
	<td>Perfil:</td>
	<td>
	<select name="perfil" style='width:145px'>
		<option value="0">[Seleccione ...]</option>
		<option value="1">Administrador</option>
		<option value="2">Usuario</option>
		<option value="3">Reporte</option>
	</select>	</td>
	</tr>
	<tr>
	<td colspan="2">
	<input type="reset" class="btn-person" onclick="location.href='<?php echo base_url();?>summod01/summod01'" value="Cancelar" />
	
	<input name="crear" type="submit" class="btn-person" value="Guardar" /></td>
	</tr>
	</table>
			</td>
			<td valign="top" width="60%" class="cont-table">
				<div style="width:100%; display:block;"></div>
			</td>
		</tr>
	</thead>
</table>
	
    
</form>
</div>
<!--  Fin Contenido dinamico  -->