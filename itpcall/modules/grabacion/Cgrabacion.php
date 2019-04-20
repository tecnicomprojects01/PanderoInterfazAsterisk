
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form name="form1" method="post" action="Cgrabacion.php">
<table with="300" border="1" align="center" cellpadding="5" cellspacing="0">
<tr>
	<td width="296"><div align="center"> listado de llamadas</div>
	
	</td>
</tr>
<tr>
<td><div align="center">
<input name="enviar" type="submit" id="enviar" value="enviar">

</div></td>
</tr>
</table>
</form>
<?php 
if($enviar){
	mysql_connect("localhost","root","itperu321x");
	mysql_select_db("asterisk");
	$filas=mysql_query("SELECT recordfile, recorddate, recordtime, recordagent, recordsize, recordexten, tipo FROM record_call");
	$cur=mysql_query($filas);
?>
<table>	
	<tr>
    <td>    </td>
     <td>    </td>
      <td>    </td> 
      <td>    </td>
       <td>    </td>
        <td>    </td>
         <td>    </td>
          <td>    </td>
    </tr>
<?php
	while($row=mysql_fetch_array($cur)){
	$i=$i+1;
	$a=	$row['recordagent'];
	$b=	$row['recordexten'];
	$c=	$row['recorddate'];
	$d=	$row['recordtime'];
	$e=	$row['recordsize'];
	$f=	$row['recordtipo'];
	$g=	$row['recordfile'];
?>
    <tr>
      <td><? =$i ?></td>
	  <td><? =$a ?></td>
      <td><? =$b ?></td>
      <td><? =$c ?></td>
      <td><? =$d ?></td>
      <td><? =$e ?></td>
      <td><? =$f ?></td>
      <td><? =$g ?></td>
    </tr>
<?	
		}
		mysql_close($enlace);
}
	
?>
</table>
</body>
</html>