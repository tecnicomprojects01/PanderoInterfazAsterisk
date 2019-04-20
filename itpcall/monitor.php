<?php 
require_once(dirname(__FILE__) . '/config/config.inc.php');

require_once(dirname(__FILE__) . '/config/db.inc.php');

require_once(dirname(__FILE__) . '/functions/functions.inc.php');
?>

<style type="text/css">
<!--
.Estilo1 {
	color: #000000;
	font-weight: bold;
}
.Estilo2 {color: #000000}
.links0{background-color: #FFF3B3 !important;}
-->
</style>
<link href="<?php echo base_url();?>css/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<body onload="demas()">


<?php
	$TiempoLinea=exec("uptime | awk '{print  $3 \" Dias \" $1}'");
//	echo date("H:i:s");
?>

<table width="99%" cellspacing="3" cellpading="3" border="0">
  <thead>
    <tr>
      <td valign="top" width="50%" class="cont-table">
<table>
    <caption>CARACTERISTICAS</caption>
  <thead>
  <tr>
    <th colspan=2>DATOS  DEL SERVIDOR</th>
  </tr>
  </thead>
  <tr>
    <td>Nombre del Host</td>
    <td><?php echo "HOST: <U>".exec("hostname");echo "</U>  IP:  <U>";echo exec("hostname -i");?></td>
  </tr>
  <tr>
    <td>Sistema Operativo</td>
    <td><?php echo exec("cat '/etc/redhat-release'");?> Kernel: <?php echo exec('uname -mrs');?></td>
  </tr>
  <tr>
    <td>Fecha y Hora Actual</td>
    <td><?php echo exec('date');?></td>
  </tr>
  <tr>
    <td>Tiempo en Linea</td>
    <td><?php echo $TiempoLinea;?></td>
    
  </tr>
<tr>
  <thead>
    <th colspan=2>SERVICIOS</th>
    </thead>
  </tr>
  <tr>
    <td>Servicio Apache</td>
    <td>
      <?php if(exec("pidof httpd") > 0){echo "<img src=" . base_url() ."img/ball_green.png>";}
                                       else{echo "<img src=" . base_url() ."img/ball_red.png>";}    ?>
    </td>
  </tr>
 <tr>
    <td>Servicio Asterisk</td>
    <td>
      <?php if(exec("pidof asterisk") > 0){echo "<img src=" . base_url() ."img/ball_green.png>";}
                                       else{echo "<img src=" . base_url() ."img/ball_red.png>";}    ?>
    </td>
  </tr>
</table>
      </td>
      <td valign="top" width="50%" class="cont-table">
<table>
  <caption>ESTADO DEL SISTEMA</caption>
  <thead>
<tr>
    <th colspan=5><img  src="<?php echo base_url();?>img/hdd.png" width=25 HEIGHT=20 ></img>  DISCO</th>
 </tr>
</thead>
<tr>

  <td>Sitema de Archivo</td>
  <td>Total</td>
  <td>Libre</td>
  <td>Usado</td>
  <td>Usado (%)</td>
  </tr>
<tr>
  <td>boot</td>
  <td><?php echo exec("df -h | grep /dev/mapper/centos-root | awk '{print $2}'"); ?></td>
  <td><?php echo exec("df -h | grep /dev/mapper/centos-root | awk '{print $4}'"); ?></td>
  <td><?php echo exec("df -h | grep /dev/mapper/centos-root | awk '{print $3}'"); ?></td>
  <td><?php echo exec("df -h | grep /dev/mapper/centos-root | awk '{print $5}'"); ?></td>
  </tr>
<tr>
  <td>tmpfs</td>
  <td><?php echo exec("df -h | grep tmpfs | awk '{print $2 }'"); ?></td>
  <td><?php echo exec("df -h | grep tmpfs | awk '{print $4 }'"); ?></td>
  <td><?php echo exec("df -h | grep tmpfs | awk '{print $3 }'"); ?></td>
  <td><?php echo exec("df -h | grep tmpfs | awk '{print $5 }'"); ?></td>
  </tr>
<tr>
  <td>/dev/sda1</td>
  <td><?php echo exec("df -h | grep /dev/sda1 | awk '{print $2 }'"); ?></td>
  <td><?php echo exec("df -h | grep /dev/sda1 | awk '{print $4 }'"); ?></td>
  <td><?php echo exec("df -h | grep /dev/sda1 | awk '{print $3 }'"); ?></td>
  <td><?php echo exec("df -h | grep /dev/sda1 | awk '{print $5 }'"); ?></td>
  </tr>
  <thead>
<tr>
    <th colspan=5><img  src="<?php echo base_url();?>img/ram.png" width=40 HEIGHT=15 ></iMG>  MEMORIA</th>
 </tr>
 </thead>
<tr>
  <td>Descripci&oacute;n</td>
  <td>Total</td>
  <td>Libre</td>
  <td>Usado</td>
  <td>Usado (%)</td>
  </tr>

<tr>
<?php 
  
  $Ftotal=(int)(exec("cat /proc/meminfo | grep MemTotal | awk '{print $2}'")/1024);
  $Flibre=(int)(exec("cat /proc/meminfo | grep MemFree | awk '{print $2 }'")/1024);
  $Fusado=(int)($Ftotal-$Flibre); 
  $Fconsumo=(int)($Fusado*100/$Ftotal);
?>
  <td>Memoria Fisica</td>
  <td><?php echo $Ftotal . "MB"; ?></td>
      <td><?php echo $Flibre . "MB"; ?></td>
  <td><?php echo $Fusado . "MB"; ?></td>
  <td><?php echo "$Fconsumo% "; ?></td>
  </tr>

<tr>
<?php 
  
  $Vtotal=(int)(exec("cat /proc/meminfo | grep SwapTotal | awk '{print $2}'")/1024);
  $Vlibre=(int)(exec("cat /proc/meminfo | grep SwapFree | awk '{print $2}'")/1024);
  $Vusado=(int)($Vtotal-$Vlibre); 
  $Vconsumo=(int)($Vusado*100/$Vtotal);
?>
  <td>Memoria Virtual (swat)</td>
  <td><?php echo $Vtotal . "MB"; ?></td>
      <td><?php echo $Vlibre . "MB"; ?></td>
  <td><?php echo $Vusado . "MB"; ?></td>
  <td><?php echo "$Vconsumo% "; ?></td>
  </tr>
  <thead>
<tr>
  <th colspan=5><img  src="<?php echo base_url();?>img/cpu.png" width=20 HEIGHT=20 ></img>  PROCESADOR</th>
</tr>
</thead>
<tr>
  <td>CPU (%)</td>
  <td><?php echo substr(exec(" top -b -n 1 | head -n 3 | awk '{print  $10}'"),0,-2);  ?></td>
  
  <td colspan=2>Load Average  (Carga/1 min)</td>
  <td><?php echo substr(exec("uptime | awk '{print  $11}'"),0,-1);  ?></td>
</tr>
</table>        
      </td>
    </tr>
  </thead>
</table>
