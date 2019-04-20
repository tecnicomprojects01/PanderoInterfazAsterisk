<?php
// Description: XML phonebook generator from Asterisk database for Yealink Phones

//header("Content-type: text/xml");
// extrae datos de asterisk db
$mysql_conn = mysql_connect('192.168.1.210', 'root', 'itperu321x');
mysql_select_db('asterisk', $mysql_conn );

//
$xml_output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xml_output .= "<YealinkIPPhoneDirectory clearlight=\"true\">\n";
$xml_output .= "<Title>Phonelist</Title>\n";
$xml_output .= "<Prompt>Prompt</Prompt>\n";

$sql="SELECT anexo,valor FROM tb_anexos a INNER JOIN tb_anexo_parametro p ON a.idanexo=p.idanexo WHERE idparametro=2";
//
$result = mysql_query($sql, $mysql_conn);
while ($row = mysql_fetch_array($result)){
	$post=strpos($row[1],"<");
	$name= substr($row[1],1,$post-3);
	$xml_output .= "\t\t<DirectoryEntry>\n";
        $xml_output .= "\t\t<Name>" .$name. "</Name>\n";
        $xml_output .= "\t\t<Telephone>" . $row[0] . "</Telephone>\n";
        $xml_output .= "\t\t</DirectoryEntry>\n";         
        }
$xml_output .= "</YealinkIPPhoneDirectory>";
//
$fp = fopen('/var/www/html/phonebook.xml','wb');
fwrite($fp, $xml_output);
fclose($fp);
//echo $xml_output;


?>

