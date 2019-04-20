<?php 
session_start();

define('MODULE_PATH', realpath('./modules/'));

require_once(dirname(__FILE__) . '/config/config.inc.php');

require_once(dirname(__FILE__) . '/config/db.inc.php');

require_once(dirname(__FILE__) . '/functions/functions.inc.php');

require_once(APP_PATH . "includes/conexiongestor.php");
	
	if (isset($_POST['ingresar'])){
		$usuario = $_POST['usuario'];
		$clave = $_POST['clave'];
		$perfil = $_POST['perfil'];
		
		$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
		$obj->findusuario($usuario,$clave,$perfil);
		
		if (($obj->cantregistros()) > 0){
			$_SESSION['usuario'] = $usuario;
			$_SESSION['clave'] = $clave;
			$_SESSION['perfil'] = $perfil;
			header("Location: " . base_url());
		}
		else{
			header("Location: ".base_url()."error.php");
		}
		$obj->cierradb();
		unset($obj);
	}
	else{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link type="image/x-icon" href="<?php echo base_url();?>logo_itperu.ico" rel="shortcut icon"/>
<title>ITPERU TELECOM</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/tab.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/validacion.js"></script>
<style type="text/css">
<!--
.Estilo1 {color: #000000}
.Estilo2 {
	font-size: 13px;
}
.Estilo3 {
	color: #2E2F2F
}
.Estilo11 {}
.Estilo12 {font-size: 13px; color:#2E2F2F;  }
.padin1{
	padding-top: 0px;
	padding-bottom: 0px;
}
.marg1{
	margin-bottom: 8px;
}
body{
	background-color: #9cc;
	font-family: verdana,sans-serif;
}
.padin2{
		padding-left: 1em;
	padding-right: 1em;
	padding-bottom: 1em;
}
.btn-primary {
	color: #fff;
	padding: 0.3em 0.5em;
	border-radius: 3px;
    background-color: #0074cc;
    background-image: -ms-linear-gradient(top, #0088cc, #0055cc);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0055cc));
    background-image: -webkit-linear-gradient(top, #0088cc, #0055cc);
    background-image: -o-linear-gradient(top, #0088cc, #0055cc);
    background-image: -moz-linear-gradient(top, #0088cc, #0055cc);
    background-image: linear-gradient(top, #0088cc, #0055cc);
    background-repeat: repeat-x;
    border-color: #0055cc #0055cc #003580;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    filter: progid:dximagetransform.microsoft.gradient(startColorstr='#0088cc', endColorstr='#0055cc', GradientType=0);
    filter: progid:dximagetransform.microsoft.gradient(enabled=false);
}
-->
.campo{
	padding: 4px;
	background-color: #ffffff;
    border: 1px solid #cccccc;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
    -moz-transition: border linear 0.2s, box-shadow linear 0.2s;
    -ms-transition: border linear 0.2s, box-shadow linear 0.2s;
    -o-transition: border linear 0.2s, box-shadow linear 0.2s;
    transition: border linear 0.2s, box-shadow linear 0.2s;
}
.cabe,.cabe tbody tr td{
	background-color: #FFF3B3 !important;
	font-size: 11px;
}
.cont-he{
	background-color: #FFFDF3;
	width: 100%;
	padding: 2em 0;
}
#header{
	margin-bottom: 0px;
	border-bottom: 0px;
}
</style>
</head>
<body >
<div id="header" style="text-align:left;">
	<a href="#" />Home</a>
</div>
<div class="cont-he">
<form id="frmLogin" name="frmLogin" method="post" action="<?php echo base_url();?>login.php" onsubmit="return valida_login(this);">
<div class="borde-login">
<table width="100%" cellpadding="2" cellspacing="1" bgcolor="#f5f5f5" class="padin2">
<tr>
<td colspan="2" align="left" valign="top"><p style="border-bottom:1px solid #e5e5e5; font-size:19.5px; color:#333; font-family: verdana,sans-serif;">Formulario de Ingreso</p></td>
</tr>

<tr>
<td align="right" class="txt-form Estilo1 padin1"><div align="left" class="Estilo2 Estilo3 Estilo11">
  Usuario:
</div></td>
</tr>
<tr>
<td align="left"> <input name="usuario" class="style-input marg1 campo" id="usuario" type="text" /></td>
</tr>
<tr>
<td align="right" class="txt-form Estilo1 padin1"><div align="left" class="Estilo12">
  Clave:
</div></td>
</tr>
<tr>
	<td align="left"><input name="clave" class="style-input marg1 campo" id="clave" type="password" /></td>
</tr>
<tr>
<td align="right" class="txt-form Estilo1 padin1"><div align="left" class="Estilo12"> 
  Perfil:
</div></td>
</tr>
<tr>
	<td align="left">
<select name="perfil" id="perfil" class="style-input marg1 campo">
<option value="1">Administrador</option>
<option value="2">Usuario</option>
<option value="3">Reporte</option>
<option value="4">Super</option>
</select></td>
</tr>
<tr>
<td height="40" colspan="2" align="left" valign="bottom"><input class=" btn-primary" value="Ingresar" name="ingresar" type="submit"/></td>
</tr>
</table>
</div>
</form>
</div>
<?php
	}
	

	$fe=date("Y");
echo "<table class='cabe'>";
echo "<tr><td>&#169 2013 - $fe    ITPERU CORPORATION. Todos los derechos reservados.</td></tr>";
echo "</table>";
?>

</body>
</html>