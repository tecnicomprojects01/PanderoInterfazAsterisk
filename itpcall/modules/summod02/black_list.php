<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css.css" />

<style> 
.estilo_formulario{width:200px;  border:double;} 
</style>
</head>
<body class="body">
 
<br />
<?

$conexion = mysql_connect("localhost" , "root" , "itperu321x");
mysql_select_db("asterisk",$conexion);



if(isset($_POST['btnagregar'])){

//******registrar en la tabla tb_provisionar_anexo**********//
if($_POST['txtnum']!=""){
  $num=$_POST['txtnum'];
		
 		$strHost = "127.0.0.1";
                $strUser = "adminweb";
                $strSecret = "webmanx";
			$errno=0 ;
                     $errstr=0 ;                        
                        $oSocket = fsockopen ($strHost, 5038, $errno, $errstr, 20);                        
                        if (!$oSocket) {
                                echo "$errstr ($errno)<br>\n";
                        } else {

                     	   
                                               
                                fputs($oSocket, "Action: login\r\n");
                                fputs($oSocket, "Username: $strUser\r\n");
                                fputs($oSocket, "Secret: $strSecret\r\n\r\n");
                                
                                
                                fputs($oSocket, "Action: command\r\n");
                               fputs($oSocket, "Command: database put blacklist $num 1 \r\n\r\n");
                                 usleep(10);
                              //fputs($oSocket, "Action: command\r\n");
					//fputs($oSocket, "command: database show blacklist");
                                
		

                        }
sleep(1);
fclose($oSocket);
     		$msg="El numero $num a sido agredado a la lista ";
$archivo="A".$_POST['txtnum']."_".date("dmY");
//echo "$archivo";
$lis="INSERT INTO tb_Blacklist (`descripcion`) Values('$archivo')";
mysql_query($lis,$conexion) or die(mysql_error());

}else { $msg="Ingrese un Numero";}

	
}
if(isset($_POST['btneliminar'])){

//******registrar en la tabla tb_provisionar_anexo**********//

  		if($_POST['txtnum']!=""){

  		$num=$_POST['txtnum'];
		
		  $strHost = "127.0.0.1";
                $strUser = "adminweb";
                $strSecret = "webmanx";
                        $errno=0 ;
                        $errstr=0 ;
                        $oSocket = fsockopen ($strHost, 5038, $errno, $errstr, 20);
                        
                        if (!$oSocket) {
                                echo "$errstr ($errno)<br>\n";
                        } else {
                                                                       
                                fputs($oSocket, "Action: login\r\n");
                                fputs($oSocket, "Username: $strUser\r\n");
                                fputs($oSocket, "Secret: $strSecret\r\n\r\n");
                             
                                fputs($oSocket, "Action: command\r\n");
                               fputs($oSocket, "Command: database del blacklist $num \r\n\r\n");
                                 usleep(10);
                              //  fputs($oSocket, "Action: command\r\n");
					//fputs($oSocket, "command: database show blacklist");
                               
                       
			}
		$msg="El numero $num a sido eliminado de la lista ";

		$archivo="E".$_POST['txtnum']."_".date("dmY");
		$lis="INSERT INTO tb_Blacklist (`descripcion`) Values('$archivo')";
		mysql_query($lis,$conexion) or die(mysql_error());
	sleep(1);
	fclose($oSocket);
}else { $msg="Ingrese un Numero";}

}

?> 

<br />
<br />
<br />


<!-- Codigo de division en Izquierdo -->
<div id="left">
<form name="form1" method="post" action="<?php echo base_url();?>summod02/black_list" enctype="multipart/form-data">
<table border="1" align="center" bordercolor="#CCCCCC" class="table_cab">
<tr>
	<td width="480" colspan="3" align="center" bgcolor="#FF9900">
		<strong>  REGISTRAR EL NUMERO A LA LISTA NEGRO </strong>
	</td>

</tr>
<tr>
	<td >
		numero:
	</td>
	<td>
		<input name="txtnum" type="text" size="17" /> 
	</td>
	
<td  align="center">
		<input name="btnagregar" type="submit"  value="Agregar" />
		<input name="btneliminar" type="submit"  value="Eliminar " />

    	</td>
</tr>
<tr>
	<td colspan="3" align="center" bgcolor="#FF9900">
		<strong> REGISTRAR DESDE UN ARCHIVO</strong>
	</td>

</tr>
<tr>
<td colspan="2"  >
<form action="" method="post" enctype="multipart/form-data"> 
<input type="file" name="archivo" id="archivo"></input>
</td>
<td>
<input type="submit" name="btnsubir" value="Agregar"></input>
<input type="submit" name="btnAeliminar" value="Eliminar"></input>

</form> 
</td>
</tr>

</table>
</form>
<br/>

<?Php

/***************************************Lista para agregar al Blacklist********************************************/

if(isset($_POST['btnsubir'])){
	if ($_FILES['archivo']["error"] > 0)
	  {
	  echo "Error: " . $_FILES['archivo']['error'] . "<br>";
	  }
	else
	  {
		 /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
		$archivo="ALista_".date("dmY");
		//echo "$archivo";
		$dest="registros/".$archivo;
		move_uploaded_file($_FILES['archivo']['tmp_name'],$dest);

		$file = fopen("$dest", "r");
		if (isset($file)){
		  $strHost = "127.0.0.1";
                $strUser = "adminweb";
                $strSecret = "webmanx";
                $errno=0 ;
                $errstr=0 ;
                $oSocket = fsockopen ($strHost, 5038, $errno, $errstr, 20);               
         		if (!$oSocket) {
                                echo "$errstr ($errno)<br>\n";
                      	  } else {
                                                                       
                                fputs($oSocket, "Action: login\r\n");
                                fputs($oSocket, "Username: $strUser\r\n");
                                fputs($oSocket, "Secret: $strSecret\r\n\r\n"); 
					
				$i=0;	
				while(!feof($file)) {
			       	// echo "$i : ";
					$num= trim(fgets($file));  
					if ($num!=''){                    
						$i=$i+1;	
						//echo "$num"."<br>";                             
       	                     	fputs($oSocket, "Action: command\r\n");
              	                 	fputs($oSocket, "Command: database put blacklist $num 1\r\n\r\n");
	              	              usleep(100);
              	       	       // fputs($oSocket, "Action: command\r\n");
						//   fputs($oSocket, "command: database show blacklist");                      
                      	  	}
				}
				fputs($oSocket, "Action: command\r\n");
				sleep(1);
				fclose($oSocket);
				echo "<br><br><center><h1><font color='blue'>Total de Numeros Agregados a la Lista: $i Numeros </font></h1></center><br>";
				$lis="INSERT INTO tb_Blacklist (`descripcion`) Values('$archivo')";
				mysql_query($lis,$conexion) or die(mysql_error());
			}
		}

fclose($file);
	}
}
  /**************************************fin de agregar numeros por lista******************************/

/*****************************************Lista para Eliminar  Blacklist**********************************/

if(isset($_POST['btnAeliminar'])){
	if ($_FILES['archivo']["error"] > 0)
	  {
	  echo "Error: " . $_FILES['archivo']['error'] . "<br>";
	  }
	else
	  {
	 /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
$archivo="ELista_".date("dmY");
//echo "$archivo";
$dest="registros/".$archivo;
	move_uploaded_file($_FILES['archivo']['tmp_name'],$dest);

	$file = fopen("$dest", "r");
	if (isset($file)){
		
		  $strHost = "127.0.0.1";
                $strUser = "adminweb";
                $strSecret = "webmanx";
                $errno=0 ;
                $errstr=0 ;
                $oSocket = fsockopen ($strHost, 5038, $errno, $errstr, 20);               
         		if (!$oSocket) {
                                echo "$errstr ($errno)<br>\n";
                      	  } else {
                                                                       
                                fputs($oSocket, "Action: login\r\n");
                                fputs($oSocket, "Username: $strUser\r\n");
                                fputs($oSocket, "Secret: $strSecret\r\n\r\n"); 
$i=0;	
	while(!feof($file)) {
	
        //echo "$i : ";
		$num= trim(fgets($file));                      
		//echo "$num"."<br>";   
		if ($num!=''){
		$i=$i+1;                          
                               fputs($oSocket, "Action: command\r\n");
                               fputs($oSocket, "Command: database del blacklist $num \r\n\r\n");
                              usleep(100);
                              // fputs($oSocket, "Action: command\r\n");
				//   fputs($oSocket, "command: database show blacklist");
   		} 	 	        					                           
       }
//fputs($oSocket, "Action: command\r\n");
sleep(1);
fclose($oSocket);
echo "<br><br><center><h1><font color='red'>Total de Numeros Eliminados de la lista: $i Numeros</font></h1></center>";
$lis="INSERT INTO tb_Blacklist (`descripcion`) Values('$archivo')";
mysql_query($lis,$conexion) or die(mysql_error());

		}
	}

fclose($file);

	}
}

/***********************************fin de eliminar numeros de la Blacklist************************/



if(isset($_POST['btnagregar']) ){
echo "<br><br><center><h1><font color='blue'>$msg</font></h1></center>"; 
}
if(isset($_POST['btneliminar'])) {
echo"<br><br><center><h1><font color='red'>$msg</font></h1></center>";} 
echo"<br><br><br><br><br><br><br><br><br><br><br><br><br>";
echo "<center><font color='red'><h2>Aviso:</h2></font><br>El limite de Registros a cargar por archivo es de: <strong><h2>30,000 numeros</h2></strong></center>";

?>