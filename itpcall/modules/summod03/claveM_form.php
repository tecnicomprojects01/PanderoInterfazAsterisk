<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bluetabs.css" />-->
<link rel="stylesheet" href="<?php echo base_url();?>style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />

<style type="text/css">
<!--
.Estilo6 {color: #FFFFFF; font-weight: bold; }
.Estilo8 {
	color: #000000
}
.Estilo11 {color: #000000; font-weight: bold; font-size:11px }
.links2{background-color: #FFF3B3 !important;}
-->
</style>
</head>

<body>
  
  <?php 
	
	$valor=""; $valor1=""; $valor2=""; $valor3="";$vfloc=""; $vfnac=""; $vfint=""; $vcloc=""; $vcnac=""; $vrpm=""; $vrlyric="";
	if($_POST) {
		$valor1=trim($_POST['elimina']);
		$valor=trim($_POST['actualiza']);
		$vid=trim($_POST['id']);
		$vfloc=trim($_POST['f-loc']);
	 	$vfnac=trim($_POST['f-nac']);
	 	$vfint=trim($_POST['f-int']);
	 	$vcloc=trim($_POST['c-loc']);
	 	
	}
	if(isset($_GET['elimina'])) {
		$valor1=trim($_GET['elimina']);
		$vid=trim($_GET['id']);
	}
?>
  

<table>

<caption>GESTION DE CLAVES A USUARIOS</caption>
<thead>
<tr><!--<td width="25" height="29" bgcolor="#CCCCCC"><div align="center" class="Estilo6 Estilo8">ID</div></td>-->
<th >Usuario</th>
<th >Fijo Local</th>
<th >Fijo Nacional</th>
<th >Fijo internacional</th>
<th >Celular</th>
<th >Clave</th>
<th >Acci&oacute;n</th>
</tr>
</thead>
<? 
$cn=mysql_connect("192.168.1.210","root","itperu321x") or die ("Error al conectar con el servidor");
$db=mysql_select_db("asterisk",$cn) or die ("Error al conectar con la base de datos");
/*$sql="SELECT `Id`,`usuario`,`f-loc`,`f-nac`,`f-int`,`c-loc`,`rpm` FROM tb_claves";*/
if($valor=="si"){
  mysql_query("UPDATE tb_claves SET `f-loc`='$vfloc', `f-nac`='$vfnac', `f-int`='$vfint', `c-loc`='$vcloc'   WHERE  Id='$vid' ");
                }

if($valor1=="si"){
  mysql_query("DELETE FROM tb_claves WHERE  Id='$vid' ");
                }

if($valor=="si" || $valor1=="si"){

$archivo = "/etc/asterisk/cod_loc";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		$archivo = "/etc/asterisk/cod_nac";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		$archivo = "/etc/asterisk/cod_int";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		$archivo = "/etc/asterisk/cod_celloc";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		// $archivo = "/etc/asterisk/cod_celnac";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		// $archivo = "/etc/asterisk/cod_rpm";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		// $archivo = "/etc/asterisk/cod_lyric";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 

		$result=mysql_query("SELECT * FROM tb_claves WHERE flag=0",$cn);
		while($row = mysql_fetch_array($result)) { 
		$user=trim($row["usuario"]); $pass=trim($row["password"]);
		if($row["f-loc"]=="on"){ $archivo = "/etc/asterisk/cod_loc";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}
		if($row["f-nac"]=="on"){ $archivo = "/etc/asterisk/cod_nac";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}
		if($row["f-int"]=="on"){ $archivo = "/etc/asterisk/cod_int";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}
		if($row["c-loc"]=="on"){ $archivo = "/etc/asterisk/cod_celloc";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}

                                           }

}





	
	$registro=mysql_query("SELECT `Id`,`usuario`,`f-loc`,`f-nac`,`f-int`,`c-loc`,`pass_orig` FROM tb_claves order by usuario",$cn);		
while($fila=mysql_fetch_array($registro)){
	$item = $cont + 1;
    if (($item) % 2 == 0){
        $est_td = "odd";
    }else{
        $est_td = "";
    }
    echo "<tr class=\"$est_td\">";
?>
<form action="<?php echo base_url();?>summod03/claveM_form/" method="post">
<input type=hidden name=id value="<?=$fila["Id"]?>"><input 
type=hidden name=actualiza value=si>
<!--<td bgcolor='#CCCCCC'><span class='Estilo11'>" .$fila["Id"]. "</span></td>";-->
<td><?=$fila["usuario"] ?></td>
<td><? if($fila["f-loc"]=="on"){ echo "<INPUT name=f-loc type=checkbox checked>";}else{echo 
"<INPUT name=f-loc type=checkbox>";} ?></td>
<!--echo "<td><span class='Estilo7'>" .$fila["f-loc"]. "</td>";-->
<? echo "<td>" ; if($fila["f-nac"]=="on"){ echo "<INPUT name=f-nac type=checkbox checked>";}else{echo 
"<INPUT name=f-nac type=checkbox>";} "</td>";
echo "<td>" ; if($fila["f-int"]=="on"){ echo "<INPUT name=f-int type=checkbox checked>";}else{echo 
"<INPUT name=f-int type=checkbox>";}"</td>";
echo "<td>" ; if($fila["c-loc"]=="on"){ echo "<INPUT name=c-loc type=checkbox checked>";}else{echo 
"<INPUT name=c-loc type=checkbox>";} "</td>";
echo "<td>".$fila["pass_orig"]."</td>";
echo "<td align='center'><INPUT TYPE='submit' VALUE='Actualizar' class='btn-person cle-btn'><span style='color:red;'>-</span>"."<form>
<INPUT TYPE='BUTTON' VALUE='Eliminar' class='btn-person cle-btn' ONCLICK=\"if(!confirm('Esta seguro que desea Eliminar este Usuario?')){return true} ".
      "action=window.location.href='".base_url()."summod03/claveM_form/elimina=si&id=".$fila["Id"]."'\">".
      "</td></form></tr>";
      $cont ++;
}

/*?>
<tr align='center'><form action=cNuevo.php METHOD=GET><input type=hidden name=id value="<?=$fila["Id"]?>"><input 
type=hidden name=actualiza value=si>
 <td align='center'><?=$fila["usuario"]?></td>
 <td align='center'><?php if($fila["f-loc"]=="on"){echo "<INPUT name=f-loc type=checkbox checked>";}else{echo 
"<INPUT name=f-loc type=checkbox>";}  ?></td>	  
  <?  echo "<td align='center'>"; if($fila["f-nac"]=="on"){echo "<INPUT name=f-nac type=checkbox checked>";}else{echo 
"<INPUT 
name=f-nac type=checkbox>";}  echo "</td>";
    echo "<td align='center'>"; if($fila["f-int"]=="on"){echo "<INPUT name=f-int type=checkbox checked>";}else{echo 
"<INPUT 
name=f-int type=checkbox>";}  echo "</td>";
    echo "<td align='center'>"; if($fila["c-loc"]=="on"){echo "<INPUT name=c-loc type=checkbox vchecked>";}else{echo 
"<INPUT 
name=c-loc type=checkbox>";} 

    echo "<td colspan=2 align='center'>".
      "<INPUT TYPE='submit' VALUE='Actualizar'>".
      "<form><INPUT TYPE='BUTTON' VALUE='Eliminar' ONCLICK=\"if(!confirm('Esta seguro que desea Eliminar este Usuario?')){return true} ".
      "action=window.location.href='cNuevo.php?elimina=si&id=".$fila["Id"]."'\">".
      "</td></form></tr>";*/


mysql_free_result($registro);
mysql_close($cn); 
?>

</table>

<!--</form>-->
