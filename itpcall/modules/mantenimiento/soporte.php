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
<link rel="stylesheet" href="<?php echo base_url();?>style.css">
<style type="text/css">
.links5{background-color: #FFF3B3 !important;}
#m_soporte {display: block;height: 12px;}
</style>
</head>
<body onload="demas()">

<?

if(isset($_POST['btnrasterisk'])){

		
 		$strHost = "127.0.0.1";
                $strUser = "adminweb";
                $strSecret = "webmanx";
			$errno=0 ;
                     $errstr=0 ;                        
                        $oSocket = fsockopen ($strHost, 5038, $errno, $errstr, 20);                        
                        if (!$oSocket) {
                                echo "$errstr ($errno)<br>\n";
                        } else {
                  	                                         
                                fputs($oSocket, "Action: login\r\n");
                                fputs($oSocket, "Username: $strUser\r\n");
                                fputs($oSocket, "Secret: $strSecret\r\n\r\n");
                                
                                
                                fputs($oSocket, "Action: command\r\n");
                               fputs($oSocket, "Command: core restart now \r\n\r\n");
                                 usleep(10);
                              
                                
		

                        }
sleep(1);
fclose($oSocket);
}
if(isset($_POST['btnrservidor'])){
	shell_exec('shutdown -r now');

}
if(isset($_POST['btnaservidor'])){
	exec('shutdown -h now');
}

?>



<div class="content"> 
        <form name="frmanexos" method="post" action="<?php echo base_url();?>mantenimiento/soporte">
<table width="99%" cellspacing="3" cellpading="3" border="0">
  <caption>Servidor</caption>
  <thead>
    <tr>
      <td valign="top" width="50%">
<table>            
          <thead>         
            <th>Servicio</th>
            <th>Accion</th>
          </tr></thead>
        <tr>
  <td>Reiniciar Asterisk</td>

  <td><button type="submit" name="btnrasterisk" value="Reiniciar" onclick="return confirm('Esta seguro de reiniciar el servicio del Asterisk')"><input type="image" src='<?php echo base_url();?>img/mant/asterisk.png' width='25' height='25'   title='Esta es mi im�gen' alt="Reinicar Asterisk" /> </button>
</td>
  

  </tr>
 

        </table>
      </td>
      <td valign="top" width="50%">
        <div style="width:100%; display:block;"></div>
      </td>
    </tr>
  </thead>
</table>        
           
        </form>
</div>
