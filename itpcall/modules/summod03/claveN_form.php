<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>
<style type="text/css">
<!--
.Estilo12 {font-weight: bold; font-family: Arial, Helvetica, sans-serif; color: #000000;}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; color: #000000;}
.Estilo14 {font-size: 12px}
-->
</style>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bluetabs.css" />-->
<link rel="stylesheet" href="<?php echo base_url();?>style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<style type="text/css">.links2{background-color: #FFF3B3 !important;}</style>
<body>


<form name="form1" method="post" action="<?php echo base_url();?>summod03/claveN">
<table width="99%" cellspacing="3" cellpading="3" border="0">
	<caption>GENERAR NUEVAS CLAVES A USUARIO</caption>
	<thead>
		<tr>
			<td valign="top" width="50%" class="cont-table">
				<table width="100%" cellspacing="3" cellpading="3" border="0">
					<thead>
						<tr>	
					    	<th colspan="2">INGRESO DE DATOS</th>
					  	</tr>
					</thead>
					<tbody>
						<tr class="text-izq">
						    <td><strong>Usuario: </strong></td>
						    <td><input name="txtusuario" type="text" /></td>
						</tr>
						<tr class="text-izq">
							<td><strong>Contraseña:</strong></td>
							<td><input name="txtpwd" type="password" /></td>
						</tr>
						<tr class="text-izq">
							<td><strong>Fijo Local:</strong></td>
							<td>
								<input name="Rdflocal" type="radio" value="yes" /> ON 
								<input name="Rdflocal" type="radio" Value="no" checked="checked" /> OFF
							</td>
						</tr>	
						<tr class="text-izq">
							<td><strong>Fijo Nacional:</strong></td>
							<td>
								<input name="Rdfnacional" type="radio" value="yes" /> ON
							  	<input name="Rdfnacional" type="radio" Value="no" checked="checked"/> OFF
							 </td>
						</tr>
						<tr class="text-izq">
							<td><strong>Fijo Internacional:</strong></td>
							<td>
							  <input name="Rdfinternacional" type="radio" value="yes" /> ON
							  <input name="Rdfinternacional"type="radio" Value="no" checked="checked"/> OFF
							</td>
						</tr>
						<tr class="text-izq">
							<td><strong>Celular:</strong></td>
							<td>
								<input name="Rdcelular" type="radio" value="yes" /> ON
							  	<input name="Rdcelular" type="radio" Value="no" checked="checked" /> OFF
							</td>
						</tr>
						
						<tr>
							<td colspan="2" align="center">
								<input name="btncancelar" type="button" class="btn-person" onclick="location.href='<?php echo base_url();?>';" value="Cancelar" />
							  	<input name="btngrabar" type="submit" class="btn-person" value=" Guardar " />
							</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td valign="top" width="50%" class="cont-table">
				<div style="width:100%; display:block;"></div>
			</td>
		</tr>
	</thead>
</table>
</form>

<div class="clearfix"></div>