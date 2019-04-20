<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />

<link rel="stylesheet" href="<?php echo base_url();?>style.css">

<body onload="anexos()">
<style> 
.estilo_formulario{width:200px;  border:double;} 
.links{background-color: #FFF3B3 !important;}
</style> 
<?

$conexion = mysql_connect($srv01 , $usu01 , $pas01);
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
$archivo=$_POST['txtnum'];
//echo "$archivo";
$lis="INSERT INTO tb_Blacklist (`descripcion`) Values('$archivo')";
mysql_query($lis,$conexion) or die(mysql_error());

}else { $msg="Ingrese un Numero";}

	
}


//******Eliminar el Numero de la lista Negra**********//
$idcon = (isset($_GET["idcon"])) ? $_GET["idcon"] : '';
if($idcon !=""){

  		$num=$_GET['idcon'];
		
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
                         	 sleep(1);
				fclose($oSocket);     
                       
			}
		$msg="El numero $num a sido eliminado de la lista ";
		$lis="delete from tb_Blacklist where descripcion='".$num."'";
		mysql_query($lis,$conexion) or die(mysql_error());

}



/*****************************************Lista para Eliminar  Blacklist**********************************/

if(isset($_POST['btnAeliminar'])){
$num = $_GET['id'];


	if ($_FILES['archivo']["error"] > 0)
	  {
	  echo "Error: " . $_FILES['archivo']['error'] . "<br>";
	  }
	else
	  {
	 /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
$archivo="ELista_".date("dmY");
//echo "$archivo";
$dest=dirname(__FILE__) .'/registros/'.$archivo;
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
		$lis="delete from tb_Blacklist where descripcion='".$num."'";
		mysql_query($lis,$conexion) or die(mysql_error());

   		} 	 	        					                       
       }
//fputs($oSocket, "Action: command\r\n");
sleep(1);
fclose($oSocket);
$msg="Total de Numeros Eliminados de la lista: $i Numeros</font></h1></center>";

		}
	}

fclose($file);

	}
}


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
		$dest=dirname(__FILE__) .'/registros/'.$archivo;
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

				$lis="INSERT INTO tb_Blacklist (`descripcion`) Values('$num')";
				mysql_query($lis,$conexion) or die(mysql_error());
                      	  	}
				}
				fputs($oSocket, "Action: command\r\n");
				sleep(1);
				fclose($oSocket);
				$msg="Total de Numeros Agregados a la Lista: $i Numeros ";
				
			}
		}

fclose($file);
	}
}
  /**************************************fin de agregar numeros por lista******************************/


/***********************************fin de eliminar numeros de la Blacklist************************/

?>

<table width="99%" cellspacing="3" cellpading="3" border="0">
	<thead>
		<tr>
			<td valign="top" width="50%" class="cont-table">
<form name="form1" method="post" action="<?php echo base_url();?>Blacklist/black_list" enctype="multipart/form-data">
<table>
	<caption>REGISTRAR EL NUMERO A LA LISTA NEGRA</caption>

<tr>
	<td>
		N&uacute;mero:
	</td>
	<td>
		<input name="txtnum" type="text" size="17" /> 
	</td>
	
	<td>
		<input name="btnagregar" type="submit" class="btn-person" value="Agregar" />
	</td>
</tr>
</table>
<table>
<thead>
<tr>
	<th colspan="3">
		REGISTRAR DESDE UN ARCHIVO
	</th>
</tr>
</thead>
<tr>
<td colspan="2">
<form action="" method="post" enctype="multipart/form-data"> 
<input type="file" name="archivo" id="archivo"></input>
</td>
<td>
<input type="submit" name="btnsubir" class="btn-person" value="Agregar"></input>
<input type="submit" name="btnAeliminar" class="btn-person" value="Eliminar"></input>

</form> 
</td>
</tr>

<tr>
<td colspan="3">
<?
if(isset($_POST['btnagregar']) ){
echo "<font color='blue'>$msg</font></center>"; 
}
if(isset($_POST['btnsubir']) ){
echo "<font color='blue'>$msg</font></center>"; 
}
if(isset($_POST['btnAeliminar']) ){
echo "<font color='red'>$msg</font></center>"; 
}

if(isset($_GET['idcon'])) {
echo"<center><font color='red'>$msg</font></center>";} 
?>

<center><font color='red'><h2>Aviso:</h2></font><br/>El limite de Registros a cargar por archivo es de: <strong><h2>30,000 numeros</h2></strong></center>

</td></tr>


</table>

</form>
			</td>
			<td valign="top" width="50%" class="cont-table">
				<table>	
	<caption>LISTADO DE NUMEROS EN LA LISTA NEGRA</caption>		
<thead>
<tr>
	<th>N°</th>	
	<th>NUMERO</th>
	<th>ADMINISTRACION</th>	
</tr>
</thead>
<? 
$sql2=mysql_query("SELECT * FROM tb_Blacklist order by descripcion");
while($row2 = mysql_fetch_array($sql2)) {
$d=$row2['id'];
$m=$row2['descripcion'];
$u+=1;

$item = $cont + 1;
if (($item) % 2 == 0){
    $est_td = "odd";
}else{
    $est_td = "";
}
echo "<tr class=\"$est_td\">";
?>
	<td><font size="2"><?php echo "$u"; ?></font></td>
	<td><font size="2"><?php echo "$m"; ?></font></td>
<?
	echo "<td color='#000000' class=\"$est_td\"><a href='".base_url()."Blacklist/black_list/idcon=$row2[1]' onclick=\"return confirm('Esta seguro de eliminar')\">Eliminar</a></td>";
?>

</tr>
<? 
$cont ++;
}
?>

</table>
			</td>
		</tr>
	</thead>
</table>

 <div class="clearfix"></div>