<?php
/************
 * SET VARS *
 ***********/
$_DEBUG	= FALSE;
$_DB = array(
	'host'	=> '192.168.1.210'
	,'user'	=> 'root'
	,'pwd'	=> 'itperu321x'
	,'db'	=> 'asterisk'
);
$CFG = array(
	'anexoSize'				=> 4
	,'minSizePwd'			=> 4
	,'defaulPWD'			=> '1234'
	,'encryption_key'	=> 'lgonzales'
);
/****************
 * NO EDITABLES *
 ***************/
$TABLE = array(
	'perm'	=> 'permisos'
	,'group'	=> 'area'
	,'user'		=> 'user'
);

$_defaultError	= 'X';			//DEFAULT ERROR VALUE
$_cases		= 'X';			//DEFAULT CASE
/************************
 * ARRAY TYPE OUT CALLS *
 ***********************/
$_arrayTypeCall = array(
	'0'	=> 'Ninguno'
	,'1'	=> 'Anexo'
	,'2'	=> 'Local'
	,'3'	=> 'Movil'
	,'4'	=> 'Nacional'
	,'5'	=> 'Internacional'
);

/***********************************
 * ARRAY TYPE REG I/O INPUT/OUTPUT *
 **********************************/
$_arrayTypeIO = array(
	'0'	=> 'ENTRANTE'
	,'1'	=> 'SALIENTE'
);
/**
 *PASSWORD CRYPT
 */
function password($data, $algo = "sha256")
{
	global $CFG;
	$hash = hash_init($algo, HASH_HMAC, $CFG['encryption_key']);
	hash_update($hash, $data);
	return hash_final($hash);
}
/***********************
 * CONNECT DB FUNCTION *
**********************/
try {
		$DB = new PDO("mysql:host=".$_DB['host'].";dbname=".$_DB['db'], $_DB['user'], $_DB['pwd']); 
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}
