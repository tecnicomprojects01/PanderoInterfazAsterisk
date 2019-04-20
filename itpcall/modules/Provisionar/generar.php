<?php
$anexo=$_POST['txtanex'];
$user=$_POST['txtuser'];
$pswd=$_POST['txtpswd'];
//$anexo='100';
//$user='100';
//$pswd='1234';
$dir=MODULE_PATH . "/Provisionar/Telf/efnAprv.sh ".$anexo." ".$user." ".$pswd;

//echo "$dir";


//system('bash /Telf//efnAprv.sh');
//system("'Telf/efnAprv.sh '.$anexo.' '.$user.' '. $pswd");
system($dir);
?>
