<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}

function cdrpage_getpost_ifset($test_vars)
{
	if (!is_array($test_vars)) {
		$test_vars = array($test_vars);
	}
	foreach($test_vars as $test_var) { 
		if (isset($_POST[$test_var])) { 
			global $$test_var;
			$$test_var = $_POST[$test_var]; 
		} elseif (isset($_GET[$test_var])) {
			global $$test_var; 
			$$test_var = $_GET[$test_var];
		}
	}
}


cdrpage_getpost_ifset(array('s', 't'));


$array = array ("INICIO", "REPORTE CDR", "COMPARACION  DE LLAMADAS", "TRAFICO MENSUAL","CARGA DIARIA");
$s = $s ? $s : 0;
$section="section$s$t";

//$racine=$_SERVER['PHP_SELF'];
$racine=URL_PATH . 'asterisk-stats/index';
$update = "03 March 2005";

?>
<link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
<link rel=STYLESHEET type=text/css href=<?php echo base_url();?>css/css.css>
</head>
<body class="body">

<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo base_url();?>modules/asterisk-stats/encrypt.js"></SCRIPT>
		<style type="text/css" media="screen">
			@import url("<?php echo base_url();?>modules/asterisk-stats/css/layout.css");
			@import url("<?php echo base_url();?>modules/asterisk-stats/css/content.css");
			@import url("<?php echo base_url();?>modules/asterisk-stats/css/docbook.css");
		</style>
		<meta name="MSSmartTagsPreventParsing" content="TRUE">

	
	
		<!-- header BEGIN -->
		<div id="fedora-header1">
			
			<div id="fedora-header-logo1">
				 <!--<table border="0" cellpadding="0" cellspacing="0"><tr><td><img src="images/asterisk.gif"  alt="CDR (Call Detail Records)"></td><td>
				 <H1><font color=#990000>&nbsp;&nbsp;&nbsp;CDR (Call Detail Records)</font></H1></td></tr></table>-->
			</div>

		</div>
		<div id="fedora-nav"></div>
		<!-- header END -->
		
		<!-- leftside BEGIN -->
		<div id="fedora-side-left">
		<div id="fedora-side-nav-label">Site Navigation:</div>	<ul id="fedora-side-nav">
		<? 
			$nkey=array_keys($array);
    		$i=0;
    		while($i<sizeof($nkey)){
			
				$op_strong = (($i==$s) && (!is_string($t))) ? '<strong>' : '';
				$cl_strong = (($i==$s) && (!is_string($t))) ? '</strong>' : '';
									
        		if(is_array($array[$nkey[$i]])){
					
					
					
					echo "\n\t<li>$op_strong<a href=\"$racine/s=$i\">".$nkey[$i]."</a>$cl_strong";
									
					$j=0;
					while($j<sizeof($array[$nkey[$i]] )){
						$op_strong = (($i==$s) && (isset($t)) && ($j==intval($t))) ? '<strong>' : '';
						$cl_strong = (($i==$s) && (isset($t))&& ($j==intval($t))) ? '</strong>' : '';						
						echo "<ul>";						
						echo "\n\t<li>$op_strong<a href=\"$racine/s=$i&t=$j\">".$array[$nkey[$i]][$j]."</a>$cl_strong";
						echo "</ul>";
						$j++;						
					}
						
        		}else{					
					echo "\n\t<li>$op_strong<a href=\"$racine/s=$i\">".$array[$nkey[$i]]."</a>$cl_strong";
				}
				echo "</li>\n";
        		
        		$i++;
    		}
			
		?>

			</ul>
			
		
			
		</div>

		<!-- leftside END -->

		<!-- content BEGIN -->
		<div id="fedora-middle-two">
			<div class="fedora-corner-tr">&nbsp;</div>
			<div class="fedora-corner-tl">&nbsp;</div>
			<div id="fedora-content">



<?if ($section=="section0"){?>

<h1>

<center><IMG SRC="<?php echo base_url();?>modules/asterisk-stats/images/asterisk.gif"></center>
 <center>ASTERISK : ANALIZADOR CDR</center>
</h1>
						<h2>Recopilacion de Datos de Llamadas</h2>
						<p>Independientemente de su tamano, la mayoría de telefonos PBX (central telefónica publica) y PMS (sistemas de gestión de la propiedad)  tienen un <b>Registro Deatallado de llamadas (CDR)</b>.
						Generalmente estos se crean al finalizar una llamada pero en algunos sistemas de telefonia estos estan disponibles durante la llamada.
						<b>Algunos de los detalles incluido en el Resgistro de Llmadas son los siguientes: Tiempo, Fecha, Duracion de Llamada, Numero Marcado,
						 Identificacion de llamada, Extension, Línea/troncal, Costo, Estado completo de la llamada.</b><br>

<?}elseif ($section=="section1"){?>

	<?require_once(MODULE_PATH . "/asterisk-stats/call-log.php");?>


<?}elseif ($section=="section2"){?>

	<?require_once(MODULE_PATH . "/asterisk-stats/call-comp.php");?>


<?}elseif ($section=="section3"){?>

	<?require_once(MODULE_PATH . "/asterisk-stats/call-last-month.php");?>

<?}elseif ($section=="section4"){?>

	<?require_once(MODULE_PATH . "/asterisk-stats/call-daily-load.php");?>


<?}elseif ($section=="section5"){?>
		<h1>Contact</h1>        		
        <table width="90%">
          
		  <tr> 
            <td>
				<h3>IT PERU Telecom;d <br> <i>Jesus Maria - Lima - Peru</i></h3>				
				<br>
				<a href='http://www.itperu.com/soporteitp/upload/'>Click para soporte IT PERU</a>
				
            </td>
          </tr>          
          
        </table>
		<br><br><em><strong>Last update:</strong></em> <?=$update?><br>


<?}else{?>
	<h1>Coming soon ...</h1>
   
<?}?>

		
		<br><br><br><br><br><br>
		</div>

			<div class="fedora-corner-br">&nbsp;</div>
			<div class="fedora-corner-bl">&nbsp;</div>
		</div>
		<!-- content END -->
		
		<!-- footer BEGIN -->
		<div id="fedora-footer">

			<br>			
		</div>
		<!-- footer END -->
	</body>
</html>
