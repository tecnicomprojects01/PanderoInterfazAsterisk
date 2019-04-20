<?php
$sp = array(
  'UNKNOWN'	=> 'DESCONECTADO'
  ,'(Unspecified)' => 'NO ASIGNADO'
);

  
$mysql_conn = mysql_connect('192.168.1.210', 'root', 'itperu321x');
mysql_select_db('asterisk', $mysql_conn );


if (mysql_errno()) {
	exit();
}else {
  
//print_r('BEGIN FUNCTION');

$anexos = getRelAnexos();

//print_r('GET RESULT OK');
$lineas8[]="<?php";
if($anexos!=""){
	foreach($anexos as $k) {

		if(is_null($k['IP']))
			continue;

		if($k['IP']!='(Unspecified)') {
			$IP=$k['IP'];
			$arg=" des_anexo=".$k['ANEXO']." and ";

			$query = mysql_query("SELECT des_aa FROM tb_desvio WHERE".$arg." des_aa<>'0' ");

			$valor = mysql_fetch_object($query)->des_aa;

			if ($valor!=''){
/*				print_r('<pre>');
				print_r($k["ANEXO"]);
				if($k['ANEXO']==1119) $dato = 'CAPTURA DE DATO';
				print_r($valor);
				print_r($IP);
				print_r('</pre>');
*/
				$lineas8[] = "system(\"/opt/tareas/yealink_reboot.pl ".$k['ANEXO']." ".$k['IP']." 'DESVIO=>".$valor."'\");";
//				print_r($cmd);
//				shell_exec($cmd);
//				$msn="DESVIO=>".$valor;
//				$anx=$k['ANEXO'];
//				$ip=$k['IP'];
//				$cmd="/opt/tareas/yealink_reboot.pl $anx $ip $msn";
//				print_r($cmd);
//				system($cmd);
//				passthru($cmd); 
		
			}

		}

	}
$lineas8[]="?>";
$archivo = '/opt/tareas/ejecutar.php';
$file = fopen($archivo, "w");
foreach( $lineas8 as $lineae ) {
        fwrite( $file, $lineae.PHP_EOL );
}
fclose($file);


}
mysql_free_result($anexos);

}
//print_r('No se ejecuto por estar apagado asterisk='.$dato);
mysql_close($mysql_conn);


?>
