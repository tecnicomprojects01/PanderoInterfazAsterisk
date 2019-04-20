
<?php
switch ($modelo) {
    case 1:
        include(MODULE_PATH . "/Provisionar/t21p.php");
        break;
    case 2:
        include(MODULE_PATH . "/Provisionar/c7942.php");
        break;
    case 3:
        include(MODULE_PATH . "/Provisionar/c7911.php");
        break;
    case 4:
        include(MODULE_PATH . "/Provisionar/t2xp.php");
        break;
    case 5:
        include(MODULE_PATH . "/Provisionar/t2xp.php");
        break;
    case 6:
        include(MODULE_PATH . "/Provisionar/t21p.php");
        break;


}


			$sql="UPDATE tb_provision_anexo set prov_gen='".$arch."' where prov_mac='".$mac."'";

			mysql_query($sql);

?>
