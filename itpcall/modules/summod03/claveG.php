<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>

<link rel=STYLESHEET type=text/css href="<?php echo base_url();?>extras/estilos.css">
<link rel="stylesheet" href="<?php echo base_url();?>style.css">
<link rel=STYLESHEET type=text/css href="<?php echo base_url();?>extras/menu.css">
<style type="text/css">
<!--
.Estilo1 {color: #000000}
-->
</style>
</head>
<body>
<br />
<img align="left" src="<?php echo base_url();?>img/logo_itperu_telecom.png" />
<script type="text/javascript" src="<?php echo base_url();?>extras/verifica.js"></script>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>



<table align="center" id='table' width="80%" class='tinytable'>
 
  <tr ><td colspan=7><B></B></td></tr>
  <tr ><td colspan=7><h3 align="center" class="Estilo1"><b>MODIFICACION DE USUARIOS ACTUALES - </b></h3>    
    <div align="center"><span class="Estilo1"><a href=<?php echo base_url();?>summod03/claveG/aplicar=si>APLICAR CAMBIOS!!!</A> </h3> </span></div>
  </tr>
   <tr >
   <td><h3 align="center" class="Estilo1">ID</h3></td>
   		<td><h3 align="center" class="Estilo1">USUARIO</h3></td>
	    <td><h3 align="center" class="Estilo1">F-LOC</h3></td>
    	<td><h3 align="center" class="Estilo1">F-NAC</h3></td>
	    <td><h3 align="center" class="Estilo1">F-INT</h3></td>
		<td><h3 align="center" class="Estilo1">CELULAR</h3></td>
       	<td ><h3 align="center" class="Estilo1"><b>ACCION</b></h3></td>
   </tr>

<?php

$link=Conectarse();

 $valor=""; $valor1=""; $valor2=""; $valor3="";
 $vfloc=""; $vfnac=""; $vfint=""; $vcloc=""; $vcnac=""; $vrpm=""; $vrlyric="";
 $nombre=""; $clave="";
//------------------------------------------------------------------------------------------------------------------------------------------------
 $valor3=trim($_GET['aplicar']);
 $nombre=trim($_GET['nombre']);
 $clave=trim($_GET['clave']);
 $valor1=trim($_GET['elimina']);
 $valor=trim($_GET['actualiza']);
 $vid=trim($_GET['id']);
 $vfloc=trim($_GET['f-loc']);
 $vfnac=trim($_GET['f-nac']);
 $vfint=trim($_GET['f-int']);
 $vcloc=trim($_GET['c-loc']);
 $vcnac=trim($_GET['c-nac']);
 $vrpm=trim($_GET['rpm']); 
 $vrlyric=trim($_GET['c-lyric']); 
 $repetido="off";
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
if($valor=="si"){
  mysql_query("UPDATE tb_claves SET `f-loc`='$vfloc', `f-nac`='$vfnac', `f-int`='$vfint', `c-loc`='$vcloc', `c-nac`='$vcnac', `rpm`='$vrpm', `c-lyric`='$vrlyric'  WHERE  Id='$vid' ");
                }

if($valor1=="si"){
  mysql_query("DELETE FROM tb_claves WHERE  Id='$vid' ");
                }

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

if($valor3=="si"){
 $archivo = "/etc/asterisk/cod_loc";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
 $archivo = "/etc/asterisk/cod_nac";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
 $archivo = "/etc/asterisk/cod_int";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
 $archivo = "/etc/asterisk/cod_celloc";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
// $archivo = "/etc/asterisk/cod_celnac";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
// $archivo = "/etc/asterisk/cod_rpm";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
// $archivo = "/etc/asterisk/cod_lyric";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 

 $result=mysql_query("SELECT * FROM tb_claves WHERE flag=0",$link);
 while($row = mysql_fetch_array($result)) { 
 $user=trim($row["usuario"]); $pass=trim($row["password"]);
if($row["f-loc"]=="on"){ $archivo = "/etc/asterisk/cod_loc";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}
if($row["f-nac"]=="on"){ $archivo = "/etc/asterisk/cod_nac";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}
if($row["f-int"]=="on"){ $archivo = "/etc/asterisk/cod_int";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}
if($row["c-loc"]=="on"){ $archivo = "/etc/asterisk/cod_celloc";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}

/*
if($row["c-nac"]=="on"){ $archivo = "/etc/asterisk/cod_celnac";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}
if($row["rpm"]=="on"){ $archivo = "/etc/asterisk/cod_rpm";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; $write = fputs($fp, $string); fclose($fp);}
if($row["c-lyric"]=="on"){ $archivo = "/etc/asterisk/cod_lyric";$fp = fopen($archivo, "a+");$string = "$user:$pass\n"; 
$write = fputs($fp, $string); fclose($fp);}
 */
                                           }
                }		

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
?>


// ------------------------------Impresion de Tabla-----------------------------------   
<? $cant_usu=0;
$result=mysql_query("SELECT * FROM tb_claves ORDER by usuario ASC",$link);
while($row = mysql_fetch_array($result)) { ?>
<tr align='center'><form action="<?php echo base_url();?>summod03/cNuevo" METHOD=GET><input type=hidden name=id value="<?=$row["Id"]?>"><input 
type=hidden name=actualiza value=si>
 <td align='center'><?=$row["usuario"]?></td>
 <td align='center'><?php if($row["f-loc"]=="on"){echo "<INPUT name=f-loc type=checkbox checked>";}else{echo 
"<INPUT name=f-loc type=checkbox>";}  ?></td>	  
  <?  echo "<td align='center'>"; if($row["f-nac"]=="on"){echo "<INPUT name=f-nac type=checkbox checked>";}else{echo 
"<INPUT 
name=f-nac type=checkbox>";}  echo "</td>";
    echo "<td align='center'>"; if($row["f-int"]=="on"){echo "<INPUT name=f-int type=checkbox checked>";}else{echo 
"<INPUT 
name=f-int type=checkbox>";}  echo "</td>";
    echo "<td align='center'>"; if($row["c-loc"]=="on"){echo "<INPUT name=c-loc type=checkbox checked>";}else{echo 
"<INPUT 
name=c-loc type=checkbox>";} 


    echo "<td colspan=2 align='center'>".
      "<INPUT TYPE='submit' VALUE='Actualizar'>".
      "<form><INPUT TYPE='BUTTON' VALUE='Eliminar' ONCLICK=\"if(!confirm('Esta seguro que desea Eliminar este Usuario?')){return true} ".
      "action=window.location.href='".base_url()."summod03/cNuevo/elimina=si&id=".$row["Id"]."'\">".
      "</td></form></tr>";
    $cant_usu++;   				  }
?>
</table>
<br>
   Cantidad Total de Usuarios:<?php echo $cant_usu; ?><br>
   


        <script type="text/javascript" src="<?php echo base_url();?>script.js"></script>





