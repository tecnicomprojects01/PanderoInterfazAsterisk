<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
/* -------Actualizar el archivo voicemail_default.conf--- */
/*
$lineas3[]="[default]";
$obj->listanexo();
while($row=$obj->respuesta()){
			
		$lineas3[] = "$row[1]"."=> ,"."$row[1]".",,,attach=no|saycid=no|envelope=yes|delete=no"; 
}
*/

$archivo1='/etc/asterisk/voicemail_default.conf';
	$file1 = fopen($archivo1, "w"); 
	foreach( $lineas3 as $linea1 ) { 
	fwrite( $file1, $linea1.PHP_EOL ); 
	}	
	fclose($file1);


/* ------Actualizar el Archivo voicemail_adicional.conf ---- */

$obj->listacorreovoz();
while($row=$obj->respuesta()){
	if($row[3]!=="") {
		
		$lineas1[] = "$row[0]"."=> ,"."$row[2]".","."$row[3]".",,delete=yes|attach="."$row[4]"; 
	}
}
$archivo = '/etc/asterisk/voicemail_adicional.conf'; 
$file = fopen($archivo, "w"); 
foreach( $lineas1 as $linea ) { 
fwrite( $file, $linea.PHP_EOL ); 
}	
fclose($file);


?>

