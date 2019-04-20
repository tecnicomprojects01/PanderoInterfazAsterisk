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
.links{background-color: #FFF3B3 !important;}
</style>
</head>


<body onload="anexos()">
  
  <?php 
	
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
        #$perfil = 1;
        //page_header($obj,$_SESSION['perfil']);
        #page_header($obj,$perfil);
        unset($obj);

if(isset($_POST['btnagregar'])){
		$anexo=$_POST['cbanexo'];
		$mac=$_POST['txtmac'];
		$modelo=$_POST['cbmodelo'];
				
		$result=mysql_query("SELECT prov_mac FROM tb_provision_anexo where prov_mac='$mac' or prov_anex='$anexo'");
		 
		if( mysql_num_rows($result)==0) {  
		 	 

//******registrar en la tabla tb_provisionar_anexo**********//

				$sql="INSERT INTO tb_provision_anexo(`prov_modid`,`prov_anex`,`prov_mac`)";
				$sql.= " values ($modelo,$anexo,'$mac')";
				
				mysql_query($sql);

				
//******registrar en el archivo lista**********//
				$sql1=mysql_query("SELECT prov_mac FROM tb_provision_anexo order by prov_anex");
				while($row1 = mysql_fetch_array($sql1)) {  
				$lineas[] = $row1['prov_mac']; 		
				}
				$archivo = MODULE_PATH . '/Provisionar/yealink/lista'; 
				$file = fopen($archivo, "w"); 
			       foreach( $lineas as $linea ) { 
				fwrite( $file, $linea.PHP_EOL ); 
				}	
				fclose($file);
				include(MODULE_PATH . "/Provisionar/asignar.php");
		}else{echo "<br /><br /><center>ANEXO O MAC YA ESTA REGISTRADO!!!</center>";}
}
if (isset($_GET['idc'])){
	$idc=$_GET['idc'];
	$sql=mysql_query("SELECT prov_id,idanexo,anexo,Modtelf_id,Modtelf_desc,telf_Marca,prov_mac FROM tb_provision_anexo pa INNER JOIN tb_anexos a ON pa.prov_anex=a.idanexo INNER JOIN tb_telefono_modelo tm ON pa.prov_modid=tm.Modtelf_id INNER JOIN tb_telefono_marca tma ON tm.Modtelf_idmar=tma.telf_id Where prov_id=$idc");
	$row = mysql_fetch_array($sql);

	
$idanexo=$row[idanexo];
$anexo=$row[anexo];
$idmod=$row[Modtelf_id];
$modelo=$row[Modtelf_desc];
$marca=$row[telf_Marca];
$macc=$row[prov_mac];

}


if (isset($_GET['idce'])){
	$idce=$_GET['idce'];
	
	$sql="select prov_mac from tb_provision_anexo where prov_id='$idce'";
	$res=mysql_query($sql) or die(mysql_error());
	$dato=mysql_fetch_row($res);	
	$rut="/tftpboot/".$dato[0].".cfg";
	if(file_exists("$rut")){
		unlink($rut);
	}

	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("delete from tb_provision_anexo where prov_id=$idce");
	


}
 

if (isset($_POST['aceptar'])){


	$anexo=$_POST[cbanexo];
	$modelo=$_POST[cbmodelo];
	$mac=$_POST['txtmac'];

	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("SELECT prov_anex FROM tb_provision_anexo WHERE prov_anex=$anexo");
	$can =$obj->cantregistros();

	$idprov=$_POST[idprov];
	$idanexo=$_POST[cbanexo];
	$idmod=$_POST[cbmodelo];


	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("UPDATE tb_provision_anexo SET prov_modid='$idmod',prov_anex='$idanexo' where prov_id=$idprov");

	
	include(MODULE_PATH . "/Provisionar/asignar.php");



}

?>
  
 



<!-- --> 
<div class="content"> 
<form name="frmUsuarios" method="post" action="<?php echo base_url();?>Provisionar/provisionar"><br />
<table>
	<caption>Registrar Nueva MAC</caption>
   
  
<tr align="left" valign="middle">
<?php

	if (isset($_GET['idc']))
	{echo "<td><strong>MAC:</strong> <input name='txtmac' type='text' value='$macc' readonly maxlength=15/>";
	echo "<input type='hidden' name='idprov' value='$idc'> </td>";}
	else
	{echo "<td><strong>MAC:</strong> <input name='txtmac' type='text'maxlength=15/> </td>";}

	echo "<td><strong>Modelo:</strong><select name='cbmodelo' id='modelo' class='style-text-box'>";


	if (isset($_GET['idc']))
	{echo "<option value='$idmod' selected=\'selected\'>$modelo - $marca</option>";}
	else
	{echo "<option value='0' selected=\'selected\'>[Seleccione]</option>";}

	
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj->mantenimiento("SELECT Modtelf_id,Modtelf_desc,telf_Marca FROM tb_telefono_modelo m INNER JOIN tb_telefono_marca ma ON m.Modtelf_idmar=telf_id ORDER BY telf_Marca,Modtelf_desc");
	while($row = $obj->respuesta()){
		echo "<option value='$row[0]'>$row[2] - $row[1]</option>";
	}
     	echo" </select></td>";
	echo"<td> <strong>Anexo:</strong><select name='cbanexo' id='anexo' class='style-text-box'>";


	if (isset($_GET['idc']))
	{echo "<option value='$idanexo' selected=\'selected\'>$anexo</option>";}
	else
	{echo "<option value='0' selected=\'selected\'>[Seleccione]</option>";}


	$obj->mantenimiento("SELECT * FROM tb_anexos WHERE idanexo NOT IN (SELECT prov_anex FROM tb_provision_anexo) ORDER BY anexo;");

	while($row = $obj->respuesta()){
		echo "<option value='$row[0]'>$row[1]</option>";
	}
	echo"</select></td>";


if (isset($_GET['idc']))
{		
	echo"<td height='34'  valign='bottom' align=center colspan=2><input name='aceptar' type='submit' class='btn-person' value='Aceptar'/>";
	echo" <input name='Cancelar' type='submit' class='btn-person' value='Cancelar'/></td>";
}else{
	echo"<td colspan=2 height='34'  valign='bottom' align=center><input name='btnagregar' type='submit' class='btn-person' value='Nuevo'/></td>";
}

?>


 
   </tr>
 
</table>
<br>
<br>
<table>
	<caption>Gestionar provisionamiento de Anexos</caption>
	<thead>
  <tr>
   <th with="200px">N°</th>
	<th>ID</th>
	<th>MAC</th>
	<th>TELEFONO</th>
	<th>ANEXO</th>
	<th>NOMBRE</th>
	<th>ARCHIVO GENERADO</th>
	<th>ADMINISTRAR</th>	 
 </tr>
</thead>
 <?php
	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$sql2=mysql_query("SELECT prov_id,prov_mac,m.Modtelf_desc,a.anexo,p.valor,prov_gen FROM tb_provision_anexo pa INNER JOIN tb_telefono_modelo m ON pa.prov_modid=m.Modtelf_id INNER JOIN tb_anexos a ON pa.prov_anex=a.idanexo INNER JOIN tb_anexo_parametro p ON pa.prov_anex=p.idanexo  WHERE p.idparametro=2 ORDER BY prov_anex");
while($row2 = mysql_fetch_array($sql2)) {
$d=$row2['prov_id'];
$m=$row2['prov_mac'];
$des=$row2['Modtelf_desc'];
$a=$row2['anexo'];
$n=$row2['valor'];
$post=strpos($n,"<");
$name= substr($n,1,$post-3);
$g=$row2['prov_gen'];
$u+=1;

	$item = $cont + 1;
    if (($item) % 2 == 0){
        $est_td = "odd";
    }else{
        $est_td = "";
    }

		echo "<tr class=\"$est_td\">";
		echo "<td>$u</td>";
		echo "<td>$d</td>";
		echo "<td>$m</td>";
		echo "<td>$des</td>";
		echo "<td>$a</td>";
		echo "<td>$name</td>";
		echo "<td>$g</td>";
		$cont ++;

echo "<td><a href='".base_url()."Provisionar/provisionar/idc=$row2[0]' >Modificar</a> <span style='color:red;'>-</span>  <a href='".base_url()."Provisionar/provisionar/idce=$row2[0]' onclick=\"return confirm('Esta seguro de eliminar')\">Eliminar</a></td>";
echo "</tr>";
}

?>

</table>
	
</div>