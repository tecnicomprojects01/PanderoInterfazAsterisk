<?php 
session_start();

define('MODULE_PATH', realpath('./modules/'));

require_once(dirname(__FILE__) . '/config/config.inc.php');

require_once(dirname(__FILE__) . '/functions/functions.inc.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css">
<title>Error</title>
</head>

<body>
<?php
	echo "<center><br><br>";
	echo "<span class=\"msg\"><b>Error: Ingrese correctamente sus datos</b> <br><br>";
	echo "<a href=\"".base_url()."\">Acceso de usuario</a></span>";
	echo "</center>";
?>
</body>
</html>
