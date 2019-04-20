<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>

 <?php
$file  = trim($_GET['archivo']); 
$nom  = trim($_GET['nombre']); 
header("Content-Description: Descargar imagen");
 header("Content-Disposition: attachment; filename=$nom");
 header("Content-Type: audio/wav");
 header("Content-Length: " . filesize($file));
 header("Content-Transfer-Encoding: binary");
 readfile($file);
 
?> 
</body>
</html>
