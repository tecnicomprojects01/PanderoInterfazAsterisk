<?php
	session_start();
	if (isset($_SESSION['usuario']) && isset($_SESSION['clave'])){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="/itperu.v2/css/css.css" />
<link rel="stylesheet" type="text/css" href="/itperu.v2/css/bluetabs.css" />
<link rel="stylesheet" type="text/css" href="/itperu.v2/css/calendar.css?random=20110611" media="screen" />

<link rel="stylesheet" href="/grabacion/librerias/tinytablev3.0/style.css" />

<script type="text/javascript" src="/itperu.v2/js/calendar.js?random=20110612"></script>
<script type="text/javascript" src="/itperu.v2/js/dropdowntabs.js"></script>

<link rel="stylesheet" href="/itperu.v2/css/style.css">
<link rel=STYLESHEET type=text/css href=/itperu.v2/extras/menu.css>
  
<style type="text/css">
<!--
.Estilo1 {color: #000000}
.Estilo2 {
	font-size: 12px
}
.Estilo4 {color: #000000; font-size: 12px; }
-->
</style>

</head>
<?php


?>
<body class="body">
<br />
<?
include("../menu.php");
?>
  
  <br>

  <br>
</p>
<div id="tablewrapper" >
	<!-- <div id="tableheader" > -->
<form  id='datos_busqueda' name="datos_busqueda" method="POST" action="Cgrabacion2.php" >
		
   	 <!-- <div class="search"  align="center"> -->
 <table border="2" bgcolor="#BFCBD2" ">
   <tr>
   <td bordercolor="#000000" bgcolor="#CCCCCC">
                <span class="Estilo1">
                <select id="columns" onchange="sorter.search('query')" >
                           </select>
                <input type="text" id="query" onkeyup="sorter.search('query')" " />
                <br>
Fecha Desde:
<input name="fromdate" id="fromdate" value="" maxlength="10" tabindex="" size="10"/>
<input value="..." onclick="displayCalendar(document.forms[0].fromdate,'yyyy-mm-dd',this)" style="background-color: rgb(41, 77, 113); color: rgb(255, 255, 255); font-weight: bold;" type="button" />
Fecha Hasta: 
<input name="todate" id="todate" value="" maxlength="10" tabindex="" size="10"/>
<input value="..." onclick="displayCalendar(document.forms[0].todate,'yyyy-mm-dd',this)" style="background-color: rgb(41, 77, 113); color: rgb(255, 255, 255); font-weight: bold;" type="button" />
Anexo:
<input type="text" name="txtanexo" id="txtanexo" size="6">
Numero</span>: 
<input type="text" name="txtnumero" id="txtnumero" size="6" />

<input  type="submit" name="buscar" value="Buscar">     </td></tr>
</table>
    <!-- </div>-->
</form> 

            
				<div align="right" style="margin-right:140px">Registros <span id="startrecord"></span>-<span id="endrecord"></span> de <span id="totalrecords"></span></div>
  <div align="right" style="margin-right:140px"><a href="javascript:sorter.reset()">Reiniciar</a></div>
        	
  <p>
          <!-- </div> -->
              
              <?php
	$text= $_POST['query'];
	$fromdate= $_POST['fromdate'];
	$todate= $_POST['todate'];
	$anexo= $_POST['txtanexo'];
	$numero= $_POST['txtnumero'];

//	echo $text.' '.$fromdate.' '.$todate.' '.$anexo.' '.$numero;
		mysql_connect("localhost","root","itperu321x");
		mysql_select_db("asterisk");
                if ($fromdate == "" && $todate == ""){
                        #$param = "date(recorddate)=date(now())";
                        $param = "=date(now())";
//                       #$param = "date(calldate)=date(now()) and length(src) <= 4 and length(dst) > 4 ";
//                        #$param = "date(recorddate)='2011-06-11'";

//                        $param = "='2011-06-11'";

                }
		 elseif ($fromdate != "" && $todate != "" && $anexo == "" && $numero == "") {
                        #$param = "date(calldate) between '$fromdate' and '$todate'";
                        $param = "between '$fromdate' and '$todate'";
                }
		 elseif ($fromdate != "" && $todate != "" && $anexo != "" && $numero =="") {
                        #$param = "date(calldate) between '$fromdate' and '$todate' and recordagent ='$anexo'";
                        $param = "between '$fromdate' and '$todate' and recordagent = '$anexo'";
                }
		 elseif ($fromdate != "" && $todate != "" && $anexo == "" && $numero !="") {
                        #$param = "date(calldate) between '$fromdate' and '$todate' and recordexten like '$numero%'";
                        $param = "between '$fromdate' and '$todate' and recordexten like '$numero%'";
                }

function tiempo($tmp){
	$hor=(int)($tmp/3600);              if(strlen($hor)==1)$hor="0".$hor;
	$min=(int)(($tmp-$hor*3600)/60);    if(strlen($min)==1)$min="0".$min;
  	$seg=$tmp-$min*60-$hor*3600;        if(strlen($seg)==1)$seg="0".$seg;
	$tiempo=$hor.":".$min."'".$seg;
	return $tiempo;
}

$sql= "Select * from record_call  where date(recorddate)".$param."  order by recorddatetime desc";
$result=mysql_query($sql);

//echo $sql;
		?>
                </p>
           
            <table  width="81%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" id="table">
<thead>
				
                <tr class="cab-table">
                   <th width="4%" bordercolor="#000000" class="cab-table"><h3  class="Estilo1 Estilo2">ID</h3></th>
                  <th width="8%" bordercolor="#000000" class="cab-table"><h3 class="Estilo4">ORIGEN</h3></th>
                 <th width="7%" bordercolor="#000000" class="cab-table"><h3 class="Estilo4">DESTINO</h3></th>
                 <th width="8%" bordercolor="#000000" class="cab-table"><h3 class="Estilo4">TIPO</h3></th>
                  <th width="12%" bordercolor="#000000" class="cab-table"><h3 class="Estilo4">FECHA</h3></th>
                  <th width="10%" bordercolor="#000000" class="cab-table"><h3 class="Estilo4">HORA</h3></th>
		<th width="10%" bordercolor="#000000" class="cab-table"><h3 class="Estilo4">DURACION</h3></th>
                
                  <th width="26%" bordercolor="#000000" class="cab-table"><h3 class="Estilo4">AUDIO</h3></th>
                  <th width="12%" bordercolor="#000000" class="cab-table"><h3 class="Estilo4">DESCARGAR ARCHIVO</h3></th>
      </tr>
            </thead>
            <tbody>
<?php

while ($row=mysql_fetch_array($result)) {
	$i = $i +1; 
  $uniqueid = $row['recorduniqueid'];
	$sql_id ="select billsec from cdr where uniqueid = '".$uniqueid."' and lastapp = 'Dial' order by calldate desc limit 1";
	$exec_id = mysql_query($sql_id);
//echo $sql_id;
$duration = tiempo(0);
	while($rset_id = mysql_fetch_array($exec_id)){
		$duration = tiempo($rset_id['billsec']);
	}
//	echo $duration;
   $file = $row['recordfile'];
   $tipo = $row['tipo'];

//$t=explode('-',$file);
//$t=$t['0'];
if($tipo=='i'){
$t="IN";
}else{
$t="OUT";
}

   $fecha = $row['recorddate'];
$carpeta=explode('-',$fecha);
$annio=$carpeta['0'];
$mes=$carpeta['1'];
$dia=$carpeta['2'];

   $hora = $row['recordtime'];
   $agente = $row['recordagent'];
   $numero = $row['recordexten'];
   $tamano = $row['recordsize'];
   $fec = substr($fecha,0,4).substr($fecha,5,2).substr($fecha,8,2);
	
  
?> 

                <tr>
                    <td bordercolor="#000000"><span class="Estilo1 Estilo1">
                    <?=$i?>
                    </span></td>
		
					<td bordercolor="#000000"><span class="Estilo1 Estilo1">
				  <?=$numero?>
					</span></td>
                  
                  <td bordercolor="#000000"><span class="Estilo1 Estilo1">
                  <?=$agente?>
                  </span></td>
                  <td bordercolor="#000000" color><span class="Estilo1 Estilo1">
                  <? if($t=='IN'){echo "<font color='red'>ENTRANTE </font>" ;}else{ echo "<font color='blue'>SALIENTE </font>";}
                  ?>
                  </span></td>
                  <td bordercolor="#000000"><span class="Estilo1 Estilo1">
                  <?=$fecha?>
                  </span></td>
                  <td bordercolor="#000000"><span class="Estilo1 Estilo1">
                  <?=$hora?>
                  </span></td>
                <td bordercolor="#000000"><span class="Estilo1 Estilo1">
                  <?=$duration?>
                  </span></td>
					<?php $path = "monitor/".$t."/".$annio."/".$mes."/".$dia."/".$file;?>
<!--                            <td><a href="<?=$path?>" target="_blank"><?=$file?></a></td> -->
                            <td bordercolor="#000000">

<? if (file_exists("$path") ){
?>

<!--		<object data='<?=$path?>' type='sound/gsm' autostart='false' width='200' height='20'></object> -->
 <EMBED src='<?=$path ?>' width=200 height=20 type=sound/gsm LOOP=\"FALSE\" AUTOSTART=\"false\"> 
<!-- <audio src='<?=$path ?>' type='sound/gsm' controls pause > </audio> -->
<?}else {echo "No hay Audio disponible";}
?>
</td>
 <td bordercolor="#000000">
                 <? if (file_exists("$path") ){
?>
               <a href="<?=$path?>" target="_blank" Style="text-decoration:none"><input type="button" value="Descargar"</a>
<?}else {echo "";}
?>
		
</td>
                </tr>
<?

}
?>
            </tbody>
        </table>
<div id="tablefooter">
          <div id="tablenav">
            	<div style="margin-left:150px">
                  <img src="/grabacion/librerias/tinytablev3.0/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                  <img src="/grabacion/librerias/tinytablev3.0/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                  <img src="/grabacion/librerias/tinytablev3.0/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                  <img src="/grabacion/librerias/tinytablev3.0/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div style="margin-left:20px">
                	<select id="pagedropdown"></select> 
			</div>
                <div>
                	<!-- <a href="javascript:sorter.showall()">Ver Todos</a> -->
                </div>
         </div>
			<div id="tablelocation">
            	<div style="margin-right:20px">
                    <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                        <option value="10" >10</option>
                        <option value="20" selected="selected">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Registros por pagina</span>
                </div>
                <div style="margin-right:150px" >Pagina <span id="currentpage"></span> de <span id="totalpages"></span></div>
            </div>
  </div>
</div>
<script type="text/javascript" src="/itperu.v2/librerias/tinytablev3.0/script.js"></script>
	
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:10,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:0,
		sortdir:1,
//		sum:[3,4],
//		avg:[6,7,8,9],
		//columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	});

function buscar()
{
	url=$('datos_busqueda').serialize();

	reDirigir('/itperu.v2/grabacion/Cgrabacion2.php?'+url);
	return;
}
  </script>
<?php include("../Copyright.php"); ?>
</body>
</html>

<?php
	}
	else{ 
		header("Location: ../logout.php");
	}
?>
