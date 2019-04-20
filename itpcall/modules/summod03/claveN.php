<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
//include("Conexion/conexion_db.php");

        $nom=$_POST['txtusuario'];


if ( is_numeric ($_POST['txtpwd']) ) { 
		$pwd=$_POST['txtpwd'];
   
		if ($_POST['Rdflocal']=='yes'){$flocal="on";}
		else {$flocal="off";}
		if ($_POST['Rdfnacional']=='yes'){$fnac="on";}
		else{ $fnac="off";}
		if ($_POST['Rdfinternacional']=='yes'){$fint="on";}
		else {$fint="off";}
		if ($_POST['Rdcelular']=='yes'){$cel="on";}
		else {$cel="off";}
		
		$pwde=md5($pwd);
		$repetido="off";
		$conexion = mysql_connect("192.168.1.210" , "root" , "itperu321x");
		mysql_select_db("asterisk",$conexion);
		
		$result=mysql_query("SELECT pass_orig FROM tb_claves");
		 while($row = mysql_fetch_array($result)) {  if($pwd==$row["pass_orig"]){$repetido="on"; }}
			if($repetido=="on"){echo "<center>CLAVE REPETIDA!!!</center>";}
			if($repetido=="off"){	
		$sql="INSERT INTO tb_claves(`usuario`,`f-loc`,`f-nac`,`f-int`,`c-loc`,`password`,`flag`,`pass_orig`)";
		$sql.= " values ('$nom','$flocal','$fnac','$fint','$cel','$pwde',0,$pwd)";
		//$conexion=conectarse();
		mysql_query($sql,$conexion) or die(mysql_error());
		//mensaje que se guardo satisfactoriamente

		$archivo = "/etc/asterisk/cod_loc";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		$archivo = "/etc/asterisk/cod_nac";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		$archivo = "/etc/asterisk/cod_int";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		$archivo = "/etc/asterisk/cod_celloc";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		// $archivo = "/etc/asterisk/cod_celnac";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		// $archivo = "/etc/asterisk/cod_rpm";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 
		// $archivo = "/etc/asterisk/cod_lyric";$fp = fopen($archivo, "w"); $write = fputs($fp, ""); fclose($fp); 

		$result=mysql_query("SELECT * FROM tb_claves WHERE flag=0",$conexion);
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

		header("Location: ".base_url()."summod03/claveM_form");
			}
} else { //mensaje de no numerico
		header("Location: ".base_url()."summod03/claveN_form");
		} 
?>
