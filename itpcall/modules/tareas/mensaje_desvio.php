<?php

 require_once(dirname(__FILE__).'/../../functions/functions.inc.php');




$sp = array(
  'UNKNOWN'	=> 'DESCONECTADO'
  ,'(Unspecified)' => 'NO ASIGNADO'
);
	
	$mysql_conn = mysql_connect('localhost', 'root', 'itperu321x')or die(exit());
	mysql_select_db('asterisk', $mysql_conn );

$anexos = getRelAnexos();

foreach($anexos as $k) {

	if($k['IP']!='(Unspecified)') {
		$IP=$k['IP'];
		$arg=" des_anexo=".$k['ANEXO']." and ";

		$query = mysql_query("SELECT des_aa FROM tb_desvio WHERE".$arg." des_aa<>'0' ");

		$valor = mysql_fetch_object($query)->des_aa;

		if ($valor!=''){
			print_r('<pre>');
			print_r($k["ANEXO"]);
			print_r($valor);
			Print_r($IP);
			print_r('</pre>');
			 system("/opt/tareas/yealink_reboot.pl ".$k['ANEXO']." ".$k['IP']." 'DESVIO=>".$valor."'"); 
		}

	}
}
mysql_close($mysql_conn);
?>
