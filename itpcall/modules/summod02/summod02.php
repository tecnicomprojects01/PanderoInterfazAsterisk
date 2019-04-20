<?php
if(!defined('MODULE_PATH')) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet"  href="<?php echo base_url();?>css/bluetabs.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/validacion.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dropdowntabs.js"></script>
<link href="<?php echo base_url();?>css/StyleT.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.cabe {
    position: inherit !important;
    top: inherit !important;
    left: inherit !important;
    width: 100% !important;
}
#m_anexos {display: block;}
.links{background-color: #FFF3B3 !important;}
</style>
<body>
	     
        <div class="content"> 
<?php 
        

    
        $obj = new conexiongestor($srv01,$usu01,$pas01,$base01);	
        #$perfil = 1;
        //page_header($obj,$_SESSION['perfil']);
        #page_header($obj,$perfil);
        unset($obj);
    ?>
        <form name="frmUsuarios" method="post" action="<?php echo base_url();?>summom02/summod02N_frm">
            <!--<center><a href="aplicar.php?mod=summod02">Aplicar</a></center>-->
        <br />
        <table>
          <caption>GESTION DE ANEXOS</caption>
          <thead>
          <tr>
            <th>Item</th>
            <th>Anexo</th>
            <th>Usuario</th>
            <th colspan="2">Administracion</th>
          </tr></thead>
         <?php	
                #include ("../includes/connect0.php");
            
                $obj = new conexiongestor($srv01,$usu01,$pas01,$base01);
                $obj->listanexo();
                $cont=0;
                
                if ($obj->cantregistros() == 0){
                    echo "<tr>";
                    echo "<td colspan='5' class='msj-error'>No existen registros</td>";
                    echo "</tr>";	
                }
                else{
                    while($row=$obj->respuesta()){
                        $item = $cont + 1;
                        if (($item) % 2 == 0){
                            $est_td = "odd";
                        }else{
                            $est_td = "";
                        }
                        echo "<tr class=\"$est_td\">";
                        echo "<td>$item</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td >$row[2]</td>";
                        echo "<td><a href='".base_url()."summod02/summod02M_frm/idanx=$row[0]&anx=$row[1]' >Modificar</a></td>";
                        echo "<td><a href='".base_url()."summod02/summod02E/idanx=$row[0]&anx=$row[1]' onclick=\"return confirm('Esta seguro de eliminar')\">Eliminar</a></td>";
                        echo "</tr>";
                        $cont ++;
                    }
                }
                //$obj->cierradb();
         ?>
        </table>
        </form>
        </div>

        <div class="clearfix"></div>

    </body>
