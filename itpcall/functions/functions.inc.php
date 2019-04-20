<?php 

function getRelAnexos() {
error_reporting(0);

if(exec("pidof asterisk") > 0){
$timeout = 45;
$socket = fsockopen("127.0.0.1","5038", $errno, $errstr, $timeout);
fputs($socket, "Action: Login\r\n");
fputs($socket, "UserName: adminweb\r\n");
fputs($socket, "Secret: webmanx\r\n\r\n");
$wrets = '';
fputs($socket, "Action: Command\r\n");
fputs($socket, "Command: sip show peers\r\n\r\n");
fputs($socket, "Action: Logoff\r\n\r\n");
	while (!feof($socket)) {
		$wrets .= fread($socket, 8192);
	}
fclose($socket);

$parts = explode('ACL Port     Status',$wrets);
$_p = explode('4x4',$parts[1]);
$contenido = trim($_p[0]);
$retorno = array();
$fp = fopen("php://memory", 'r+');
fputs($fp, $contenido);
rewind($fp);
while($line = fgets($fp)){

  $line = explode(' ',$line);
  $_a = explode('/',$line[0]);
  $anexo = (is_array($_a) && count($_a) > 1) ? $_a[0] : $line[0];
  $data = array(

	'ANEXO'	=> $anexo
	,'NOIP'	=> $line[22]
	,'IP'	=> $line[17]
	,'NOSTATUS'	=> $line[69]
	,'STATUS'	=> $line[68]
	,'LATENCIA'	=> $line[69].$line[70]

	,'NOSTATUS2'	=> $line[70]
	,'STATUS2'	=> $line[69]
	,'LATENCIA2'	=> $line[70].$line[71]

  );
  $data = array_unique($data);

  $retorno[] = $data;
}
fclose($fp);
return $retorno;
}else{
$retorno='';
return $retorno;
}

}

function base_url() {
	return URL_PATH;
}

function makeMenu($perfil = 'X') {
	
	switch($perfil) {
		case 3:
			$_jsPerfil = "_reportes";
		break;
		case 1:
			$_jsPerfil = "_administrador";
		break;
		case 2:
		default:
			$_jsPerfil = "";
		break;
	}
	
	return $_jsPerfil;
}

function page_header(&$obj,$perfil){
	echo "<div class=\"header\">";
	echo "<div style='height:70px;width:307px;'>";
	echo "<a href='http://www.sumtecperu.com' target='_blank'><img src='../img/sumtec.png' alt='Sumtec' width='251' height='65' /></a>";
	echo "</div>";

	echo "<div class=\"content-menu-logout\">";
	echo "<div id=\"bluemenu\" class=\"bluetabs\">";
	echo" <ul>";

	$obj->selectmodulo($perfil);
		
	$cont=0;
	$sw = false;
	$page = "";
	while($row=$obj->respuesta()){
		if ($row[0] == "Inicio") {$page = "../index.php"; $sw=false; $smnu = 0; $view = 1;}
		if ($row[0] == "Usuarios") {$page = "summod01/summod01.php"; $sw = true; $smnu = 0; $view = 1;}
		if ($row[0] == "Anexos") {$page = "summod02/summod02.php"; $sw = true; $smnu = 3; $view = 1;}
		if ($row[0] == "Claves") {$page = "summod03/summod03.php"; $sw = true;$smnu = 0; $view = 1;}
		if ($row[0] == "Monitoreo") {$page = "summod04/summod04.php"; $sw = true; $smnu = 0; $view = 1;}
		if ($row[0] == "Reporte") {$page = "summod05/summod05.php"; $sw = true; $smnu = 1; $view = 1;}
		if ($row[0] == "Telesum") {$page = "summod06/summod06.php"; $sw = true; $smnu = 0; $view = 1;}
		if ($row[0] == "Contextos") {$page = "summod07/summod07.php"; $sw = true; $smnu = 0; $view = 0;}
		if ($row[0] == "Tarifas") {$page = "summod08/summod08.php"; $sw = true; $smnu = 0; $view = 0;}
		if ($row[0] == "Callcenter") {$page = "summod09/summod09.php"; $sw = true; $smnu = 2; $view = 1;}
		if ($row[0] == "Proveedor") {$page = "summod10/summod10.php"; $sw = true; $smnu = 0; $view = 0;}
		if ($row[0] == "Colas") {$page = "summod11/summod11.php"; $sw = true; $smnu = 0; $view = 0;}
		if ($row[0] == "Agentes") {$page = "summod12/summod12.php"; $sw = true; $smnu = 0; $view = 0;}
		if ($row[0] == "Acerca de") {$page = "../acercade.php"; $sw = false; $smnu = 0; $view = 1;}

		if ($sw == false){echo "<li><a href=\"$page\">$row[0]</a></li>";}
		if ($sw == true){echo "<li><a href=\"../$page\">$row[0]</a></li>";}

		/**
		 if ($view == 1){
		 if ($sw == true){
		 if ($smnu == 1){ echo "<li><a href='../$page' rel='dropmenu1_b'>$row[0]</a></li>";}
		 else if($smnu == 2){ echo "<li><a href='../$page' rel='dropmenu1_c'>$row[0]</a></li>";}
		 else if($smnu == 3){ echo "<li><a href='../$page' rel='dropmenu1_a'>$row[0]</a></li>";}
		 else { echo "<li><a href=\"../$page\">$row[0]</a></li>";}
		 }
		 }
		 if ($sw == false){echo "<li><a href=\"$page\">$row[0]</a></li>";}
		 **/
		$cont++;
	}
	//$obj->cierradb();
	unset($obj);
	echo"</ul>";
	echo "</div>";

	echo "<div class=\"content-btn-logout\">";
	echo "<a class=\"btn-sesion\" href=\"../logout.php\">";
	#echo "<img src='../img/btn-logout.png' alt=\"Cerrar Sesion\" width=\"143\" height=\"23\" />";
	echo "<img src='../img/btn-logout.png' alt=\"Cerrar Sesion\" />";
	echo "</a>";
	echo "</div>";
	#	Menu Desplegable
	/**
	echo "<div id='dropmenu1_b' class='dropmenudiv_b'>";
	echo "<a href='../summod05/summod05.php'>Reporte</a>";
	echo "<a href='../summod08/summod08.php'>Tarifas</a>";
	echo "<a href='../summod10/summod10.php'>Proveedor</a>";
	echo "</div>";

	#	Menu Desplegable
	echo "<div id='dropmenu1_c' class='dropmenudiv_b'>";
	echo "<a href='../summod11/summod11.php'>Colas</a>";
	echo "<a href='../summod12/summod12.php'>Agentes</a>";
	echo "<a href='../summod09/summod09.php'>Monitoreo</a>";
	echo "</div>";

	echo "<div id='dropmenu1_a' class='dropmenudiv_b'>";
	echo "<a href='../summod02/summod02.php'>Anexos</a>";
	echo "<a href='../summod02/anexosxlote.php'>Anexos x Lote</a>";
	echo "<a href='../summod07/summod07.php'>Contextos</a>";
	echo "</div>";
	**/

	echo "<!-- no borrar-->";
	echo "</div>";
	echo "</div>";

	#	Begin menu desplegable
	echo "<script type='text/javascript'>";
	#	SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
	echo "tabdropdown.init('bluemenu','auto')";
	echo "</script>";
	#	End menu desplegable
}

function tiempo($tmp){
	$hor=(int)($tmp/3600);              if(strlen($hor)==1)$hor="0".$hor;
	$min=(int)(($tmp-$hor*3600)/60);    if(strlen($min)==1)$min="0".$min;
	$seg=$tmp-$min*60-$hor*3600;        if(strlen($seg)==1)$seg="0".$seg;
	$tiempo=$hor.":".$min."'".$seg;
	return $tiempo;
}
