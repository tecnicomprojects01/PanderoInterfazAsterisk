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

	$dest2=MODULE_PATH . "/Provisionar/yealink/t21p.cfg";
	

		
		if($mac!=""){
			$file2=fopen("$dest2","r");
			$arch=$mac.".cfg";
			$rut="/tftpboot/".$arch;
			$file3=fopen("$rut","w+");
			fclose($file3);

			$servf="172.16.1.200";

			while(!feof($file2)){

					$linea= trim(fgets($file2));
				if($linea=="remote_phonebook.data.1.url ="){
            				$linea2=$linea."http://".$servf."/phonebook.xml";
				}elseif($linea=="local_time.ntp_server1 ="){
					$linea2=$linea." 192.168.1.119";
		        	}elseif($linea=="auto_provision.server.url ="){
					$linea2=$linea." tftp://".$servf;
				}elseif($linea=="account.1.label ="){
					$linea2=$linea." ".$nom;
		        	}elseif($linea=="account.1.display_name ="){
					$linea2=$linea." ".$nom;
		        	}elseif($linea=="account.1.auth_name ="){
					$linea2=$linea." ".$anex;
		        	}elseif($linea=="account.1.user_name ="){
					$linea2=$linea.$anex;
			        }elseif($linea=="account.1.password ="){
					$linea2=$linea.$pswd;
			        }elseif($linea=="account.1.outbound_host ="){
					$linea2=$linea." ".$servf;
		        	}elseif($linea=="account.1.sip_server.1.address ="){
					$linea2=$linea." ".$servf;
		        	}elseif($linea=="TimeServer2 ="){
					$linea2=$linea." ".$servf;
		        	}elseif($linea=="push_xml.server ="){
					$linea2=$linea." ".$servf;
		        	}else{$linea2=$linea;}
			$file3=fopen("$rut","a+");	
			fputs($file3,$linea2."\n");
			fclose($file3);			
			
			}
			
	}
?>
