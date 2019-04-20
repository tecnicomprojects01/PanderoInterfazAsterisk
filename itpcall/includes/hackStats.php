<?php 

if(isset($_SESSION['AUTHVAR']['loggedIn']) && isset($_SESSION['AUTHVAR']['level']) && isset($_SESSION['AUTHVAR']['login']) ) {
	$perfil = getPerfil($_SESSION['AUTHVAR']['level']);
	$_SESSION['perfil'] = $perfil;
	$_SESSION['clave'] = 'Y';
	$_SESSION['usuario'] = $_SESSION['AUTHVAR']['login'];
	
}

function getPerfil($perfil) {
	switch ($perfil) {
		case 15:
			#Administrador
			return 0x0001;
		break;
		case 2:
			#Usuario
			return 0x0002;
		break;
		case 3:
		default:
			#Reporteador
			return 0x0003;
		break;
	}
}
?>