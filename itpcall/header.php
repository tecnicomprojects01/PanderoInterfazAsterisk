<html>
<head>

<link type="image/x-icon" href="<?php echo base_url();?>logo_itperu.ico" rel="shortcut icon"/>
<title>Asterisk - Administracion</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" href="<?php echo base_url();?>style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>extras/menu.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/tab.css" />


<script type="text/javascript">
	var BASE_URL = '<?php echo base_url();?>';
</script>
<script type="text/javascript" src='<?php echo base_url();?>extras/menu.js'></script>
<script type="text/javascript" src="<?php echo base_url();?>extras/menu_items<?php echo makeMenu($perfil);?>.js"></script>
<script type="text/javascript" src='<?php echo base_url();?>extras/menu_tpl.js'></script>
</head>
<body class="body" >
<script type="text/javascript" src="<?php echo base_url();?>librerias/windows_js_1.3/javascripts/prototype.js"></script>
<!--img align='left' src='<?php echo base_url();?>img/logo_itcorp.png' width=160 height='60' />
<br-->
<div id="header">
	<a href="<?php echo base_url();?>logout.php" />Cerrar Sesion</a>
</div>
<script type="text/javascript">
	new menu (MENU_ITEMS, MENU_TPL);

</script>
