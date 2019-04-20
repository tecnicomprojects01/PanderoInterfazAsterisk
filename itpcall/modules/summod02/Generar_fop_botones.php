<?php
// Description: XML phonebook generator from Asterisk database for Yealink Phones

//header("Content-type: text/xml");
// extrae datos de asterisk db


$mysql_conn = mysql_connect('192.168.1.210', 'root', 'itperu321x');
mysql_select_db('asterisk', $mysql_conn );

//

$sql="SELECT anexo,valor FROM tb_anexos a INNER JOIN tb_anexo_parametro p ON a.idanexo=p.idanexo WHERE idparametro=2";

$result = mysql_query($sql, $mysql_conn);
while ($row = mysql_fetch_array($result)){
	$post=strpos($row[1],"<");
	$name= substr($row[1],1,$post-3);

	$output[]= "[SIP/".$row[0]."]";
        $output[]= "type=extension";
        $output[]= "extension=".$row[0];
	$output[]= "context=s-gerencia";
        $output[]= "label=".$name;
        $output[]= "mailbox=".$row[0]."@default";
	$output[]= "privacy=clid";
	$output[]= "cssclass=someExtraCSSClass";
	$output[]= "customastdb=CF/".$row[0];
	$output[]="";

        }
$archivo = '/usr/local/fop2/buttons.cfg'; 
$file = fopen($archivo, "wb"); 
foreach( $output as $linea ) { 
fwrite( $file, $linea.PHP_EOL ); 
}	
fclose($file);


shell_exec('bash ejecutar.sh');

?>

