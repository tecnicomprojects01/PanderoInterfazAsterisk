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
<link rel="stylesheet" href="<?php echo base_url();?>style.css">
<style type="text/css">
.links{background-color: #FFF3B3 !important;}
</style>
</head>
<body>
<?php
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
        #$perfil = 1;
        //page_header($obj,$_SESSION['perfil']);
        #page_header($obj,$perfil);
        unset($obj);
	


if (isset($_POST['crear'])){

	$anex=$_POST[anexo];
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("SELECT c.idanexo,anexo FROM tb_correodevoz c INNER JOIN tb_anexos a ON c.idanexo=a.idanexo  WHERE c.idanexo=$anex");
	$can =$obj->cantregistros();

if($can>0){
header("location: ".base_url()."summod02/summod02V/error=si&id=$anex");
}else{
$nom=$_POST[nombre];
$mail=$_POST[email];

if ($_POST[estado]=='on'){
$flag=1;
}else{$flag=0; }

$obj->mantenimiento("INSERT INTO tb_correodevoz (nombre,clave,mail,adjunto,flag,idanexo) VALUES ('$nom','1234','$mail','yes',$flag,$anex)");

include (MODULE_PATH ."/summod02/Generar_voicemail.php");
include (MODULE_PATH ."/summod02/aplicar.php");

}
}

if (isset($_GET['idc'])){
	$idc=$_GET['idc'];
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("select idcorreovoz,nombre,mail,anexo,c.flag,c.idanexo from tb_correodevoz c INNER JOIN tb_anexos a ON c.idanexo=a.idanexo where c.idcorreovoz=$idc");
	$row = $obj->respuesta();
$idanexo=$row[idanexo];
$num=$row[anexo];
$nom=$row[nombre];
$mail=$row[mail];
$flag=$row[flag];
$idcorreo=$row[idcorreovoz];
}

if (isset($_GET['idce'])){
	$idce=$_GET['idce'];
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("delete from tb_correodevoz where idcorreovoz=$idce");
	include(MODULE_PATH ."/summod02/Generar_voicemail.php");
	include(MODULE_PATH ."/summod02/aplicar.php");

}


if (isset($_POST['aceptar'])){

	$anex=$_POST[anexo];
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("SELECT c.idanexo,anexo FROM tb_correodevoz c INNER JOIN tb_anexos a ON c.idanexo=a.idanexo  WHERE c.idanexo=$anex");
	$can =$obj->cantregistros();

if($can>0){
header("location: ".base_url()."summod02/summod02V/error=si&id=$anex");
}else{


	$idcv=$_POST[idcorreo];
	$anex=$_POST[anexo];
	$nom=$_POST[nombre];
	$mail=$_POST[email];

if ($_POST[estado]=='on'){
$flag=1;
}else{$flag=0; }

	
$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
$obj->mantenimiento("UPDATE tb_correodevoz SET nombre='$nom',mail='$mail',flag=$flag,idanexo=$anex where idcorreovoz=$idcv");

include (MODULE_PATH ."/summod02/Generar_voicemail.php");
include (MODULE_PATH ."/summod02/aplicar.php");
}

}

?>



</p>
<div class="clear"></div>
<!-- --> 
<div class="content"> 
<form name="frmUsuarios" method="post" action="<?php echo base_url();?>summod02/summod02V">
<table>
   
  <caption>Agregar Buzon de Voz</caption>


<tr align="left" valign="middle">
   <td> <strong>Anexo: </strong><select name="anexo" id="anexo" class="style-text-box">

<?php



	if (isset($_GET['idc']))
	{echo "<option value='$idanexo' selected=\'selected\'>$num</option>";}
	else
	{echo "<option value='0' selected=\'selected\'>[Seleccione]</option>";}

	
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("select idanexo,anexo from tb_anexos");

	while($row = $obj->respuesta()){
		echo "<option value='$row[0]'>$row[1]</option>";
	}


?>
      </select></td>
<?php
if (isset($_GET['idc']))
{	$idc=$_GET[idc];

    	echo"<td><strong>Nombre:</strong> <input name='nombre' type='text' value='$nom' maxlength=10/> </td>";
	echo"<input name='idcorreo' type='hidden' value='$idc'>";

	echo"<td><strong>E-mail:</strong> <input name='email' type='text' value='$mail' maxlength=20/> </td>";
	if($flag==1){
   	echo"<td><strong>Estado: </strong><input type='checkbox' name='estado' checked='checked'  /></td>";
	}else {
	echo"<td><strong>Estado: </strong><input type='checkbox' name='estado'  /></td>";
	}
	echo"<td height='34'  valign='bottom' align=center colspan=2><input name='aceptar' type='submit' class='btn-person' value='Aceptar'/>";
	echo" <input name='Cancelar' type='submit' class='btn-person' value='Cancelar'/></td>";


}else{
	echo"<td><strong>Nombre:</strong> <input name='nombre' type='text' maxlength=10/> </td>";
	echo"<td><strong>E-mail:</strong> <input name='email' type='text' maxlength=20/> </td>";
   	echo"<td><strong>Estado:</strong> <input type='checkbox' name='estado'   /></td>";
	echo"<td colspan=2 height='34'  valign='bottom' align=center><input name='crear' type='submit' class='btn-person' value='Nuevo'/></td>";

}

?>



	
 
   </tr>
 
</table>
<br/><br/>
<table>
  <caption>Gestionar Buzon de Voz</caption>
  <thead>
  <tr>
    <th>Item</th>
    <th>Anexo</th>
	<th>Nombre</th>
    <th>E-mail</th>
    <th>Estado</th>
    <th colspan=2>Administracion</th>
  </tr>
</thead>
 <?php
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("select idcorreovoz,nombre,mail,anexo,c.flag,c.idanexo from tb_correodevoz c INNER JOIN tb_anexos a on c.idanexo=a.idanexo");
	//$i=0;
	while($row = $obj->respuesta()){

		$item = $cont + 1;
        if (($item) % 2 == 0){
            $est_td = "odd";
        }else{
            $est_td = "";
        }

	//	$i++;
		echo "<tr class=\"$est_td\">";
		echo "<td>$item</td>";
		echo "<td>$row[3]</td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td>";
		$cont ++;
	if($row[4]==1){
		echo "<td>Activo</td>";
	}else{
	echo "<td>Inactivo</td>";
	}	

echo "<td><a href='".base_url()."summod02/summod02V/idc=$row[0]' >Modificar</a> <span style='color:red;'>-</span>  <a href='".base_url()."summod02/summod02V/idce=$row[0]' onclick=\"return confirm('Esta seguro de eliminar')\">Eliminar</a></td>";
	echo "</tr>";
	}

?>

</table>
	
</div>
<div class="clearfix"></div>