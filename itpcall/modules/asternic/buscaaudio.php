<?Php 
	
	$file = $_REQUEST['ruta'];	
	$fecha = $_REQUEST['fecha'];
	$pais = $_REQUEST['pais'];	
	$callsense = strtolower($_REQUEST['callsense']);
	/*echo $file."<br>";
	echo $fecha."<br>";
	echo $pais."<br>";*/

	$rutafecha = explode('-',$fecha);
	$anio = $rutafecha[0];
	$mes = $rutafecha[1];
	$dia = $rutafecha[2];
	
	$raiz = "telefonica";
//	$ruta = "../".$raiz."/".$pais."/".$callsense."/".$anio."/".$mes."/".$dia."/".$file;

	$ruta = "monitor/IN/".$anio."/".$mes."/".$dia."/".$file;

/*	if($pais == "peru"){
		$rutadia = "../".$pais."/".$callsense;
	}else{
		$rutadia = "../".$pais."/".$callsense;
	}
*/
	echo "###".$ruta."####";

			 header ("location: ".$ruta);


/*
	if($_REQUEST['fecha'] != date("Y-m-d")){
		echo "La fecha es antigua";
 		if(file_exists($ruta)){
			 header ("location: ".$ruta);
		}else{
			$cadena = strpos($ruta,"/espania/");
			if($cadena != FALSE){
				echo "entre aqui";
				$ultruta = str_replace("/espania/","/peru/",$ruta);
			}else{
				$ultruta = str_replace("/peru/","/espania/",$ruta);
			}
			if(file_exists($ultruta)){
				//header ("location: ".$ultruta);
			}
		}
	}else if($_REQUEST['fecha'] == date("Y-m-d")){
		echo "La fecha es la actual";
		$ruta = $rutadia."/".$file;

		if(file_exists($ruta)){
			 header ("location: ".$ruta);
		}else{
			$cadena = strpos($ruta,"/peru/");
			if($cadena != FALSE){
				echo "entre aqui";
				$ultruta = str_replace("/peru/","/peru2/",$ruta);
				header ("location: ".$ultruta)
			}
		}
	}
*/
echo $ruta;
?>

