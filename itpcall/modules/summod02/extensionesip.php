<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
$sp = array(
  'UNKNOWN'	=> 'DESCONECTADO'
  ,'UNREACHABLE' => 'DESCONECTADO'
  ,'(Unspecified)' => 'NO ASIGNADO'
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet"  href="<?php echo base_url();?>css/bluetabs.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/validacion.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dropdowntabs.js"></script>
<link href="<?php echo base_url();?>css/StyleT.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
.cabe {
    position: inherit !important;
    top: inherit !important;
    left: inherit !important;
    width: 100% !important;
}
#m_anexos {display: block;}
.links{background-color: #FFF3B3 !important;}
</style>
<body>
	     
        <div class="content"> 
<?php 
        

    
        
    ?>
        
        <table>
          <caption>LISTA  DE IP - EXTENSIONES</caption>
          <thead>
          <tr>
            <th>Item</th>
            <th>Anexo</th>
            <th>Usuario</th>
            <th>IP </th>
           <!-- <th>ESTADO </th> -->
          </tr></thead>
<?php
	
	$mysql_conn = mysql_connect('192.168.1.210', 'root', 'itperu321x');
	mysql_select_db('asterisk', $mysql_conn );
/*
	$sql="SELECT a.anexo,p.valor,v.prov_mac FROM tb_anexos a INNER JOIN tb_anexo_parametro p ON a.idanexo=p.idanexo INNER JOIN tb_provision_anexo v ON v.prov_anex=a.idanexo WHERE p.idparametro=2";
	$i=1;
	$ip="";
	$lineas4="";
	$result = mysql_query($sql, $mysql_conn);
*/
$anexos = getRelAnexos();
/*
	while ($row = mysql_fetch_array($result)){
		$ip=$row['anexo'];
		$n=$row['valor'];
		$post=strpos($n,"<");
		$name= substr($n,1,$post-3);
		$mac=$row['p
*/
$i= 1;
foreach($anexos as $k) {
$query = mysql_query("SELECT p.valor from tb_anexos a inner join tb_anexo_parametro p on a.idanexo=p.idanexo where p.idparametro=2 AND a.anexo=".$k['ANEXO']);
$valor = explode(" ",mysql_fetch_object($query)->valor);

$USUARIO = $valor[0];


 $IP = (!filter_var($k['IP'], FILTER_VALIDATE_IP) === false) ? $k['IP'] : $sp[$k['NOIP']];
 $IP2=($IP!='') ? $IP : 'NO ASIGNADO';

$STATUS = ($k['STATUS'] === 'OK' ) ? $k['STATUS'] . " " . $k['LATENCIA'] : $sp[$k['NOSTATUS']];


 $background = ($IP2!='NO ASIGNADO') ? ' style="background:#00FF00!important;" ' : '';
echo "<tr ".$background.">";

echo "	<td>" . $i . "</td>
	<td>".$k['ANEXO']."</td>
	<td>" . str_replace("\"",'',$USUARIO) . "</td>
	<td>".$IP2."</td>";
/*	<td>".$STATUS."</td>";*/

echo"</tr>";
$i++;
}
?>
        </table>
        </form>
        </div>

        <div class="clearfix"></div>

    </body>
