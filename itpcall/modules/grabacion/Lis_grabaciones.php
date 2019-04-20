<?php require_once('../Connections/conexion_db.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$maxRows_prueba = 10;
$pageNum_prueba = 0;
if (isset($_GET['pageNum_prueba'])) {
  $pageNum_prueba = $_GET['pageNum_prueba'];
}
$startRow_prueba = $pageNum_prueba * $maxRows_prueba;

$fechaini_prueba = "-1";
if (isset($_POST['recorddate'])) {
  $fechaini_prueba = $_POST['recorddate'];
}
$fechafin_prueba = "-1";
if (isset($_POST['recorddtade2'])) {
  $fechafin_prueba = $_POST['recorddtade2'];
}
mysql_select_db($database_conexion_db, $conexion_db);
$query_prueba = sprintf("SELECT recordfile, recorddate, recordtime, recordagent, recordsize, recordexten, recorddatetime, tipo FROM record_call WHERE recorddate >= %s AND recorddate<=%s", GetSQLValueString($fechaini_prueba, "date"),GetSQLValueString($fechafin_prueba, "date"));
$query_limit_prueba = sprintf("%s LIMIT %d, %d", $query_prueba, $startRow_prueba, $maxRows_prueba);
$prueba = mysql_query($query_limit_prueba, $conexion_db) or die(mysql_error());
$row_prueba = mysql_fetch_assoc($prueba);

if (isset($_GET['totalRows_prueba'])) {
  $totalRows_prueba = $_GET['totalRows_prueba'];
} else {
  $all_prueba = mysql_query($query_prueba);
  $totalRows_prueba = mysql_num_rows($all_prueba);
}
$totalPages_prueba = ceil($totalRows_prueba/$maxRows_prueba)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" href="/librerias/tinytablev3.0/style.css" />

<!--datos agregados despues-->


<link rel="stylesheet" type="text/css" media="all" href="/librerias/jscalendar-1.0/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="/librerias/jscalendar-1.0/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="/librerias/jscalendar-1.0/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="/librerias/jscalendar-1.0/calendar-setup.js"></script>
  
  
  <!--termino de agregacioenes-->
</head>

<body>
	




<form name="lista" action="" method="post">
<!-- <table width="100%"><tr><td>  -->
              <select id="columns" onchange="sorter.search('query')"><option value="-1">Todos</option><option value="0">ID</option><option value="1">NUMERO</option><option value="2">AGENTE</option><option value="3">FECHA</option><option value="4">HORA</option><option value="5">DURACION</option><option value="6">ARCHIVO</option></select>
                <input id="query" onkeyup="sorter.search('query')" type="text">
<br>
Fecha Desde:
<input name="recorddate" id="fromdate" value="" maxlength="10" tabindex="" size="10">
<input value="..." onclick="displayCalendar(document.forms[0].fromdate,'yyyy-mm-dd',this)" style="background-color: rgb(41, 77, 113); color: rgb(255, 255, 255); font-weight: bold;" type="button">
Fecha Hasta: 
<input name="recorddate2" id="todate" value="" maxlength="10" tabindex="" size="10">
<input value="..." onclick="displayCalendar(document.forms[0].todate,'yyyy-mm-dd',this)" style="background-color: rgb(41, 77, 113); color: rgb(255, 255, 255); font-weight: bold;" type="button">
Anexo:
<input name="txtanexo" id="txtanexo" size="6" type="text">
Numero: 
<input name="txtnumero" id="txtnumero" size="6" type="text">

<input name="buscar" value="Buscar" type="submit">

</form>
<!--</td></tr>
</table>-->
            
<p>&nbsp;</p>
<table border="1">
  <tr>
    <td>recordfile</td>
    <td>recorddate</td>
    <td>recordtime</td>
    <td>recordagent</td>
    <td>recordsize</td>
    <td>recordexten</td>
    <td>recorddatetime</td>
    <td>tipo</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_prueba['recordfile']; ?></td>
      <td><?php echo $row_prueba['recorddate']; ?></td>
      <td><?php echo $row_prueba['recordtime']; ?></td>
      <td><?php echo $row_prueba['recordagent']; ?></td>
      <td><?php echo $row_prueba['recordsize']; ?></td>
      <td><?php echo $row_prueba['recordexten']; ?></td>
      <td><?php echo $row_prueba['recorddatetime']; ?></td>
      <td><?php echo $row_prueba['tipo']; ?></td>
    </tr>
    <?php } while ($row_prueba = mysql_fetch_assoc($prueba)); ?>
</table>

<p> Total de :<?php echo $totalRows_prueba, $all_prueba,$totalPages_prueba ?></p>
</body>
</html>
<?php
mysql_free_result($prueba);
?>
