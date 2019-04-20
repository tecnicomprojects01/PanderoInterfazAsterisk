<html>
<body>
<?Php
$id=$_POST['txtid'];
$del=$_POST['mac'];
echo $del;
echo "$id<br>";
if(isset($_POST['btneliminar'])){
		$id=$_POST['txtid'];
		$conexion = mysql_connect($srv01 , $usu01 , $pas01);
		mysql_select_db("asterisk",$conexion);


		if($del=='all'){
			$sql="select prov_mac from tb_provision_anexo";
			$res=mysql_query($sql,$conexion) or die(mysql_error());
			while($dato=mysql_fetch_array($res)){
				$rut="/tftpboot/".$dato['prov_mac'].".cfg";
				if(file_exists("$rut")){
				unlink($rut);
				echo "borrado<br>";
				}
			}
		}else {
			$sql="select prov_mac from tb_provision_anexo where prov_id='$id'";
			$res=mysql_query($sql,$conexion) or die(mysql_error());
			$dato=mysql_fetch_row($res);	
			$rut="/tftpboot/".$dato[0].".cfg";
			if(file_exists("$rut")){
			unlink($rut);
			}

		}	
		if($del=='all'){
		$sql="select * from tb_provision_anexo";	
		$result="truncate tb_provision_anexo";
		}else {
			$result="DELETE FROM tb_provision_anexo where prov_id='$id'";	
		}
		mysql_query($result,$conexion) or die(mysql_error());
		



//******registrar en el archivo lista**********//
		$conexion1 = mysql_connect($srv01 , $usu01 , $pas01);
		mysql_select_db("asterisk",$conexion1);
		$sql1=mysql_query("SELECT prov_mac FROM tb_provision_anexo order by prov_anex");
		while($row1 = mysql_fetch_array($sql1)) {  
				$lineas[] = $row1['prov_mac']; 
		}
				$archivo = MODULE_PATH . '/Provisionar/yealink/lista'; 
				$file = fopen($archivo, "w"); 
			       foreach( $lineas as $linea ) { 
				fwrite( $file, $linea."\n" ); 
				}	
				fclose($file);
				
			
				
}



header ("Location: ".base_url()."Provisionar/Reg_Mac");

?>
</body>
</html>