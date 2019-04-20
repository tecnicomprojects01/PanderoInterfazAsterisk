<?

session_start();
$perfil=$_SESSION['perfil'];
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


$array = array ("INICIO", "ATENDIDAS", "SIN ATENDER", "DISTRIBUCION","GRABACION","REALTIME");
$s = $s ? $s : 0;
$section="section$s$t";

$racine=$PHP_SELF;
$update = "03 March 2005";

$paypal="NOK"; //OK || NOK
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

	<head>		
		<title>IT PERU - CALL CENTER</title>
		<meta http-equiv="Content-Type" content="text/html">
		<link rel="stylesheet" type="text/css" media="print" href="/css/print.css">

</head>
<body class="body">
<br />
<?


include("../menu.php");
?>

<SCRIPT LANGUAGE="JavaScript" SRC="./encrypt.js"></SCRIPT>

	<!--//css para menu vertical de asternic-->

	<style type="text/css" media="screen">
			@import url("css/layout.css");
			@import url("css/content.css");
			@import url("css/docbook.css");
		</style>
		<meta name="MSSmartTagsPreventParsing" content="TRUE">
	


	
	
		
		
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
					
					
					
					echo "\n\t<li>$op_strong<a href=\"$racine?s=$i\">".$nkey[$i]."</a>$cl_strong";
									
					$j=0;
					while($j<sizeof($array[$nkey[$i]] )){
						$op_strong = (($i==$s) && (isset($t)) && ($j==intval($t))) ? '<strong>' : '';
						$cl_strong = (($i==$s) && (isset($t))&& ($j==intval($t))) ? '</strong>' : '';						
						echo "<ul>";						
						echo "\n\t<li>$op_strong<a href=\"$racine?s=$i&t=$j\">".$array[$nkey[$i]][$j]."</a>$cl_strong";
						echo "</ul>";
						$j++;						
					}
						
        		}else{					
					echo "\n\t<li>$op_strong<a href=\"$racine?s=$i\">".$array[$nkey[$i]]."</a>$cl_strong";
				}
				echo "</li>\n";
        		
        		$i++;
    		}
			
		?>

			</ul>
			
		<? if ($paypal=="OK"){?>
		<center>
			<br><br>
<!--
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="info@areski.net">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="tax" value="0">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>-->
</center>
			<? } ?>
			
		</div>

		<!-- leftside END -->

		<!-- content BEGIN -->
		<div id="fedora-middle-two">
			<div class="fedora-corner-tr">&nbsp;</div>
			<div class="fedora-corner-tl">&nbsp;</div>
			<div id="fedora-content">

<?if ($section=="section0"){?>
<h1>
	<?require("index.php");?>
</h1>
<?}elseif ($section=="section1"){?>
	<?require("answered.php");?>
<?}elseif ($section=="section2"){?>
	<?require("unanswered.php");?>
<?}elseif ($section=="section3"){?>
	<?require("distribution.php");?>
<?}elseif ($section=="section4"){?>
	<?require("grabacion.php");?>
<?}elseif ($section=="section5"){?>
	<?require("realtime.php");?>
<?}elseif ($section=="section5"){?>
		<h1>Contact</h1>        		
        <table width="90%">

		  <tr> 
            <td>
				<h3>Lima<br> <i>Jesus maria</i></h3>				
				<br>
				<a href='http://www.itperu.com/soporteitp/upload/'>Soporte tecnico</a>
				
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
