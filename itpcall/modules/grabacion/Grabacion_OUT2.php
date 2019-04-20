<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bluetabs.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/calendar.css?random=20110611" media="screen" />

<link rel="stylesheet" href="<?php echo base_url();?>librerias/tinytablev3.0/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/calendar.js?random=20110612"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dropdowntabs.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
<link rel=STYLESHEET type=text/css href=<?php echo base_url();?>extras/menu.css>
  
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
<body class="body">
  
<div id="tablewrapper" >
	<!-- <div id="tableheader" > -->
<form  id='datos_busqueda' name="datos_busqueda" method="post" action="<?php echo base_url();?>grabacion/Grabacion_OUT/" >
		
   	 <!-- <div class="search"  align="center"> -->
 <table>
 	<caption>Buscar Llamadas Salientes</caption>
   <tr class="text-izq">
   <td >
                
                <select id="columns" onchange="sorter.search('query')" >
                           </select>
                <input type="text" id="query" onkeyup="sorter.search('query')"  />
       </td>
       <td>         
Fecha Desde:
<input name="fromdate" id="fromdate" value="" maxlength="10" tabindex="" size="10"/>
<input value="..." onclick="displayCalendar(document.forms[0].fromdate,'yyyy-mm-dd',this)" style="font-weight: bold;" type="button" />
</td>
<td>
Fecha Hasta:
<input name="todate" id="todate" value="" maxlength="10" tabindex="" size="10"/>
<input value="..." onclick="displayCalendar(document.forms[0].todate,'yyyy-mm-dd',this)" style="font-weight: bold;" type="button" />
</td>
<td>
Anexo:
<input type="text" name="txtanexo" id="txtanexo" size="6"/>
</td>
<td>
Numero</span>: 
<input type="text" name="txtnumero" id="txtnumero" size="6" />
</td>
<td align="center">
<input  type="submit" name="buscar" value="Buscar"/>    
	</td>
	</tr>
</table>
    <!-- </div>-->
</form> 

            
				<div align="right" style="margin-right:50px">Registros <span id="startrecord"></span>-<span id="endrecord"></span> de <span id="totalrecords"></span></div>
  <div align="right" style="margin-right:50px"><a href="javascript:sorter.reset()">Reiniciar</a></div>
        	
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


$sql= "Select * from record_call  where date(recorddate)".$param." and tipo='o' order by recorddatetime desc";
$result=mysql_query($sql);

//echo $sql;
		?>
                </p>
           <br>
            <table id="table">
            	<caption>Resultados</caption>
<thead>
				
                <tr>
			
                   	<th>ID</th>
                  	<th>ORIGEN</th>
                 	<th>DESTINO</th>
                 	<th>TIPO</th>
                  	<th>FECHA</th>
                  	<th>HORA</th>
			<th >DURACION</th>
	              <th>AUDIO</th>
       		<th>DESCARGAR ARCHIVO</th>
      		</tr>
            	</thead>
            <tbody>

<?php

while ($row=mysql_fetch_array($result)) {
	$i = $i +1; 
 	 $uniqueid = $row['recorduniqueid'];
	$sql_id ="select billsec from cdr where uniqueid = '".$uniqueid."' and lastapp = 'Dial' order by calldate desc limit 1";
	$exec_id = mysql_query($sql_id);

	$item = $cont + 1;
		if (($item) % 2 == 0){
		    $est_td = "odd";
		}else{
		    $est_td = "";
		}
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
	$path = dirname(__FILE__)."monitor/".$t."/".$annio."/".$mes."/".$dia."/".$file;
 if (file_exists("$path")) { 


?> 
         <tr>     	
			<td> <?=$i?></span> </td>
			<td> <?=$agente?> </span></td>
			<td> <?=$numero?>	</span></td>        
	              <td>
       	           <? if($t=='IN'){echo "<font color='red'>ENTRANTE </font>" ;}else{ echo "<font color='blue'>SALIENTE </font>";}
              	    ?>
                  	</td>
                  	<td><?=$fecha?></td>
 	              <td><?=$hora?>
                  		</td><td><?=$duration?>
			</td>
			
	             	<td>
<!--		<object data=\'<?=$path?>\' type='sound/gsm' autostart='false' width='200' height='20'></object> -->
			<EMBED src='<?=$path ?>' width=200 height=20 type=sound/gsm LOOP=\"FALSE\" AUTOSTART=\"false\"> 
<!-- <audio src='<?=$path ?>' type='sound/gsm' controls pause > </audio> -->
			</td>
 			<td>
                 	<? if (file_exists("$path") ){
			?>
               	<a href="<?=$path?>" target="_blank" style="text-decoration:none"><input type="button" value="Descargar"/></a>
			<?}else {echo "";}
			?>
			</td>
               </tr>
<? }
$cont ++;
 }
?>
            </tbody>
        </table>
	<div id="tablefooter">
          <div id="tablenav">
            	<div style="margin-left:150px">
                  <img src="<?php echo base_url();?>librerias/tinytablev3.0/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                  <img src="<?php echo base_url();?>librerias/tinytablev3.0/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                  <img src="<?php echo base_url();?>librerias/tinytablev3.0/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                  <img src="<?php echo base_url();?>librerias/tinytablev3.0/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
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
<script type="text/javascript" src="<?php echo base_url();?>librerias/tinytablev3.0/script.js"></script>
	
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

	reDirigir('<?php echo base_url();?>grabacion/Grabacion_OUT/'+url);
	return;
}
  </script>