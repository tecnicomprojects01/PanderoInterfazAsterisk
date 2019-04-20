<?php
switch ($modelo) {
    case 1:
        include(MODULE_PATH . "/Provisionar/t21p.php");
        break;
    case 2:
        include(MODULE_PATH . "/Provisionar/C7911.php");
        break;
    case 3:
        echo "i es igual a 2";
        break;
}




?>