<?Php
header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=NOMBRE.xls");
//echo "sqlx=".$_POST['sql'];

$sql=$_REQUEST['sql'];

mysql_connect('localhost','root','itperu321x');
mysql_select_db('asterisk');
$sql=base64_decode($sql);
$res=mysql_query($sql);

?>
<style>
.titulo {
color: #FF6600;
    font-size: 110%;
    text-decoration: none;

}
.general {
color: #FFFFFF;
    font-size: 110%;
    text-decoration: none;
background-color:#98C33C;
}

</style>

<table border='1' cellSpacing=1 cellPadding=1 width=1000  align='center'>
<tr align='center'><td colspan='7' class='general'>REPORTE DE LLAMADAS</td></tr>
<tr>
<td class='titulo'>Origen</td>

<td class='titulo'>Destino</td>

<td class='titulo'>Date</td>

<td class='titulo'>Time</td>

<td class='titulo'>Duration</td>

<td class='titulo'>Status</td>

<td class='titulo'>Cola</td>
</tr>

<?

while($row=mysql_fetch_array($res)){
echo "<tr>
<td>".$row['origen']."</td>
<td>".$row['destino']."</td>
<td>".$row['recorddate']."</td>
<td>".$row['recordtime']."</td>
<td>".timeformat($row['billsec'])."</td>
<td>".$row['event']."</td>
<td>".$row['queue']."</td>
</tr>";




}


function timeformat($time){
        $horas = floor($time/3600);
        $minutos = floor(($time-($horas*3600))/60);
        $segundos = $time-($horas*3600)-($minutos*60);
        return $horas.'h:'.$minutos.'m:'.$segundos.'s';
}

?>

</table>
