<?php
function conectarse()
{
  global $srv01, $usu01, $pas01, $base01; 
	if (!($link=mysql_connect($srv01,$usu01,$pas01)))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }
   if (!mysql_select_db($base01,$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}