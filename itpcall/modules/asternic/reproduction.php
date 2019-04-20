<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script type="text/javascript" src="jquery.min.js"></script> 
<script type="text/javascript" src="jquery.media.js"></script> 
<script type="text/javascript" src="player.swf"></script>
<script type="text/javascript">
	$(function(){
		$('.media').media({width:300,height:50});
	})
</script> 
<body>
<?Php 
	$file = $_REQUEST['rutaaudio'];	
	$fecha = $_REQUEST['fecha'];
	$pais = $_REQUEST['pais'];	
	$callsense = strtolower($_REQUEST['callsense']);

	$rutafecha = explode('-',$fecha);
	$anio = $rutafecha[0];
	$mes = $rutafecha[1];
	$dia = $rutafecha[2];

	$raiz = "IN";
	$ruta = $raiz."/".$anio."/".$mes."/".$dia."/".$file;








?>
<div id="wropper" style="text-align:center">
<img src="reproduccion.jpg" width="130px" alt="Smiley face" align="middle">
<a class="media1" href="<?Php echo $ruta; ?>"><?Php echo $ruta;?>Escuchar</a>
<!--<a class="media" href="audio.gsm"></a>-->
</div>
</body>
</html>
