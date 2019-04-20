<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bluetabs.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/validacion.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dropdowntabs.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>style.css">
<style type="text/css">.links4{background-color: #FFF3B3 !important;}</style>
</head>
<body>
  
  <?php 

	$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
        #$perfil = 1;
        //page_header($obj,$_SESSION['perfil']);
        #page_header($obj,$perfil);
        unset($obj);

?>
  
<!-- --> 
<div class="content"> 
<form name="frmUsuarios" method="post" action="<?php echo base_url();?>summod01/summod01N_frm">
<table width="99%" cellspacing="3" cellpading="3" border="0">
	<caption>GESTION DE USUARIOS</caption>
	<thead>
		<tr>
			<td valign="top" width="50%" class="cont-table">
<table>	
  <thead>
  <tr>
    <th>Item</th>
    <th>Usuario</th>
    <th>Perfil</th>
    <th colspan="2">Administracion</th>
  </tr>
  </thead>
  <tbody>
 <?php			
		$obj = new conexiongestor($srv01,$usu01,$pas01,$base01);	
		$obj->listusuario();
		$cont=0;
		while($row=$obj->respuesta()){
			if ($row[0] != "super" && $row[1] != "Super"){
			
			$item = $cont + 1;
			if (($item) % 2 == 0){
				$est_td = "odd";
			}else{
				$est_td = "";
			}
		    echo "<tr class=\"$est_td\">";
    		echo "<td>$item</td>";
			echo "<td>$row[0]</td>";
			echo "<td>$row[1]</td>";
			echo "<td><a href='".base_url()."summod01/summod01M_frm/idus=$row[2]' Style='text-decoration:none'><input type='button' value='Modificar' class='btn-person cle-btn'/></a></td>";
			if ($row[0] == "admin" && $row[1] == "Administrador"){
				echo "<td>&nbsp;</td>";
			}
			else{
			echo "<td><a href='".base_url()."summod01/summod01E/idus=$row[2]' onclick=\"return confirm('Esta seguro de eliminar')\" Style='text-decoration:none'><input type='button' value='Eliminar' class='btn-person cle-btn' /></a></td>";
			}
			echo "</tr>";
			$cont ++;
			}
		}
 ?>
<tr align="center" valign="middle">
	<td height="34" colspan="5" valign="bottom"><input name="nuevousuario" type="submit" class="btn-person" value="Nuevo"/></td>
    </tr>
    </tbody>
</table>
			</td>
			<td valign="top" width="50%" class="cont-table">
				<div style="width:100%; display:block;"></div>
			</td>
		</tr>
	</thead>
</table>
</form>				


</div>