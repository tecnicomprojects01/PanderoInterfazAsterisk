<?php


$lineas4="";
//	$arch="asterisk -rx 'sip show peers'";	
//	$ip2=system($arch,$arr);
	$salida = shell_exec('asterisk -rx "sip show peers" > log.txt');
	var_dump($salida);
	$lineas4.=$ip2;   
echo "$lineas4";


$file = fopen("log.txt", "r");
while(!feof($file)) {
		$num= trim(fgets($file));
print("$num\n");
}
	
?>


