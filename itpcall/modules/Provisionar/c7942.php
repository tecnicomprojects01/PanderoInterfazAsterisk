 <?php
 $sql=mysql_query("SELECT anexo FROM tb_anexos WHERE idanexo=$anexo");
	$row = mysql_fetch_array($sql);
	$anex=$row[0];

	$sql2=mysql_query("SELECT valor FROM tb_anexo_parametro WHERE  idparametro=5 and idanexo=$anexo");		
	$row2 = mysql_fetch_array($sql2);
	$pswd=$row2['valor'];

	$sql2=mysql_query("SELECT valor FROM tb_anexo_parametro WHERE  idparametro=2 and idanexo=$anexo");
	$row2 = mysql_fetch_array($sql2);
	$n=$row2['valor'];
	$post=strpos($n,"<");
	$nom= substr($n,1,$post-3);
	$serv=exec("hostname -i");

	$dest2=MODULE_PATH . "/Provisionar/cisco/7942.cnf.xml";
	

		
		if($mac!=""){
			$file2=fopen("$dest2","r");
			$arch=$mac.".cnf.xml";
			$rut="/tftpboot/".$arch;
			$file3=fopen("$rut","w+");
			fclose($file3);
			while(!feof($file2)){

					$linea= trim(fgets($file2));
				if($linea=="<name>172.0.0.1</name>"){
            				$linea2="<name>".$serv."</name>";
				}elseif($linea=="<processNodeName>172.0.0.1</processNodeName>"){
					$linea2="<processNodeName>".$serv."</processNodeName>";
		        	}elseif($linea=="<phoneLabel>1000</phoneLabel>"){
					$linea2="<phoneLabel>".$anex."</phoneLabel>";
		        	}elseif($linea=="<featureLabel></featureLabel>"){
					$linea2="<featureLabel>".$nom."</featureLabel>";
		        	}elseif($linea=="<proxy>172.0.0.1</proxy>"){
					$linea2="<proxy>".$serv."</proxy>";
		        	}elseif($linea=="<name>1000</name>"){
					$linea2="<name>".$anex."</name>";
			        }elseif($linea=="<displayName>1000</displayName>"){
					$linea2="<displayName>".$anex."</displayName>";
			        }elseif($linea=="<authName>1000</authName>"){
					$linea2="<authName>".$anex."</authName>";
		        	}elseif($linea=="<authPassword>k0m4tsu12</authPassword>"){
					$linea2="<authPassword>".$pswd."</authPassword>";
		        	}elseif($linea=="<contact>1000</contact>"){
					$linea2="<contact>".$anex."</contact>";
				}elseif($linea=="<directoryURL>http://172.0.0.1/menu.xml</directoryURL>"){
					$linea2="<directoryURL>http://".$serv."/menu.xml</directoryURL>";
		        	}else{$linea2=$linea;}
			$file3=fopen("$rut","a+");	
			fputs($file3,$linea2."\n");
			fclose($file3);			
			}
	}
?>
