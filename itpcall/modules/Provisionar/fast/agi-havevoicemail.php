#!/usr/bin/php -q
<?php

require('agi-config.php');
require('agi-error.php');

/*********************************
  * OPEN PHP OUPUT IN MODE WRITE *
  *******************************/
$stdOut = fopen('php://stdout', 'w');
$_anexo = isset($_SERVER['argv'][1]) ? trim($_SERVER['argv'][1]) : $_defaultError;


$qu = $DB->query("SELECT tba.valor from tb_anexo_parametro tba inner join tb_anexos ta on tba.idanexo=ta.idanexo WHERE ta.anexo='".$_anexo." ' and tba.idparametro=21 LIMIT 1",PDO::FETCH_NUM);

if( $qu->rowCount() != 1 )
{
	fwrite($stdOut, "SET VARIABLE HAVEVOICEMAIL \"0\"\n");
	exit();
}

$user = $qu->fetch(PDO::FETCH_OBJ);

if( $user->valor != '1' ) {
	fwrite($stdOut, "SET VARIABLE HAVEVOICEMAIL \"0\"\n");
	exit();
}
fwrite($stdOut, "SET VARIABLE HAVEVOICEMAIL \"1\"\n");

?>
