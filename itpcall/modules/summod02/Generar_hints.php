<?php
/* -------Actualizar el archivo voicemail.conf--- */
$lineas4[]="[hints]";
$obj->listanexo();
while($row=$obj->respuesta()){
			
		$lineas4[] = "exten =>"."$row[1]".",hint,SIP/"."$row[1]"; 
}

$archivo1='/etc/asterisk/extensions_hints.conf';
	$file4 = fopen($archivo1, "w"); 
	foreach( $lineas4 as $linea4 ) { 
	fwrite( $file4, $linea4.PHP_EOL ); 
	}	
	fclose($file4);

?>
