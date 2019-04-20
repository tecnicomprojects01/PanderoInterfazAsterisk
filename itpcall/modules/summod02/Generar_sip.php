<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
         
$obj->listanexo();

while($row=$obj->respuesta()){
	$obj1 = new conexiongestor($srv01,$usu01,$pas01,$base01);
	$obj1->listaparametroanexo();
	while($row1=$obj1->respuesta()){
		if($row[0]==$row1[0]){
			if ($row1[2]=="account"){
				$lineas[] = "[".$row1[3]."]"; 
			}
			if($row1[2]=="allow"){
				//$lineas[]="$row1[2]"."= "."$row1[3]";
				if (strpos($row1[3],"ulaw")!==false){$lineas[]="$row1[2]"."= ulaw";}
				if (strpos($row1[3],"alaw")!==false){$lineas[]="$row1[2]"."= alaw";}
				if (strpos($row1[3],"gsm")!==false){$lineas[]="$row1[2]"."= gsm";}
				if (strpos($row1[3],"g729")!==false){$lineas[]="$row1[2]"."= g729";}
				if (strpos($row1[3],"g723")!==false){$lineas[]="$row1[2]"."= g723";}

			}
			if($row1[2] =="createwaitcall"){
				$lineas[]= "call-limit=" .$row1[3]; 
			}
			if($row1[2] == "createvoicemail" && $row1[3] == "1"){
				$lineas[]= "mailbox=" .$row[1] . "@default"; 
				$lineas3[] = "$row[1]"."=> ,"."$row[1]".",,,attach=no|saycid=no|envelope=yes|delete=no";
			}


			if($row1[2]!=="account" and $row1[2]!=="allow" && $row1[2] !=="createwaitcall" && $row1[2] !== "mailbox" && $row1[2] !=="createvoicemail"&& $row1[2] !=="record"){
				$lineas[]="$row1[2]"."= "."$row1[3]"; 
			}
		}
	}
	$lineas[]="";
}
$archivo = '/etc/asterisk/sip_adicional.conf'; 
$file = fopen($archivo, "w"); 
foreach( $lineas as $linea ) { 
	fwrite( $file, $linea.PHP_EOL ); 
}	
fclose($file);


?>
