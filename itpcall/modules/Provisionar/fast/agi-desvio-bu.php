#!/usr/bin/php -q
<?php

require('agi-config.php');
require('agi-error.php');

/*********************************
  * OPEN PHP OUPUT IN MODE WRITE *
  *******************************/
$stdOut = fopen('php://stdout', 'w');
$_anexo = isset($_SERVER['argv'][1]) ? trim($_SERVER['argv'][1]) : $_defaultError;

if( $_param1 == $_defaultError) {
	fwrite($stdOut, "SET VARIABLE ISDESVIO \"N\"\n");
	exit();
}

$qu = $DB->query("SELECT * FROM tb_desvio WHERE des_anexo='".$_anexo."'  and de_ba<>'0' LIMIT 1",PDO::FETCH_NUM);

if( $qu->rowCount() != 1 )
{
	fwrite($stdOut, "SET VARIABLE ISDESVIO \"0\"\n");
	exit();
}

$user = $qu->fetch(PDO::FETCH_OBJ);


$_is_N_anexo = ($user->des_ba ==0) ? '0' : $user->des_ba;
$_N_tiempo= ($user ->des_btiempo==0)? '0' : $user ->des_btiempo;
$_N_tipo= ($user ->des_btipo=='0')?'0' : $user -> des_btipo;

fwrite($stdOut, "SET VARIABLE ISDESVIO \"" . $_is_N_anexo . "\"\n");
fwrite($stdOut, "SET VARIABLE ISTIEMPO \"" . $_N_tiempo . "\"\n");
fwrite($stdOut, "SET VARIABLE ISTIPO \"" . $_N_tipo . "\"\n");
?>
