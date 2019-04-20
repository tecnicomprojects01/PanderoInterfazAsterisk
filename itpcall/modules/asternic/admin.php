<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

	<link type="text/css" href="ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-1.3.2.js"></script>
	<script type="text/javascript" src="ui.core.js"></script>
	<script type="text/javascript" src="ui.datepicker.js"></script>
	<link type="text/css" href="demos.css" rel="stylesheet" />

	<link href="library/css/style.css" media="all" type="text/css" rel="stylesheet">	
	<link type="text/css" href="library/jquery/css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	<!--<script type="text/javascript" src="library/jquery/js/jquery-1.3.2.min.js"></script>-->
	<!--<script type="text/javascript" src="library/jquery/js/jquery-ui-1.7.2.custom.min.js"></script>-->
	<script type="text/javascript" src="include/js/function.js" language="JavaScript"></script>
	<script type="text/javascript" src="include/js/monitoreo.js" language="JavaScript"></script>	
	<script type="text/javascript" src="library/js/jquery/jquery.ui.datepicker.js" language="JavaScript"></script>	
</head>
<body>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	</script>



<!--<div class="demo">

<p>Date: <input id="datepicker" type="text"></p>

</div>--><!-- End demo -->
	<?Php			
		include_once("llamadas.grabadas.php");		
	?>
</body>
</html>