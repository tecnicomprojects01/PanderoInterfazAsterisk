<?Php
$aleatorio = rand(0,100000);

$id = ($aleatorio>0 && $aleatorio<10 ? "00000".$aleatorio : $aleatorio);
$id = ($aleatorio>9 && $aleatorio<100 ? "0000".$aleatorio : $aleatorio);
$id = ($aleatorio>99 && $aleatorio<1000 ? "000".$aleatorio : $aleatorio);
$id = ($aleatorio>999 && $aleatorio<10000 ? "00".$aleatorio : $aleatorio);
$id = ($aleatorio>9990 && $aleatorio<100000 ? "0".$aleatorio : $aleatorio);

$fecha = date('Ymd');

$directorio = "grabaciones-".$fecha."-".$id;

/*mkdir("/var/www/tcomunica/apps/reportes/form/descargas/".$directorio."/",0777);
chmod("/var/www/tcomunica/apps/reportes/form/descargas/".$directorio."/", 0777);*/

mkdir($directorio."/",0777);
//chmod("/var/www/tcomunica/apps/reportes/form/descargas/".$directorio."/", 0777);


$cadfile = $_POST['cadfile'];

$arraudios = explode(",", $cadfile);

for($x=0;$x<count($arraudios);$x++){

$posini = strrpos($arraudios[$x],"/")+1;	

$fileaudio = substr($arraudios[$x], $posini, strlen($arraudios[$x]) - ($posini) );

  //copy($arraudios[$x],"/var/www/tcomunica/apps/reportes/form/descargas/".$directorio."/".$fileaudio);  
  copy($arraudios[$x],"descargas/".$directorio."/".$fileaudio);  
}


    $zip = new ZipArchive();  
    if ($zip->open("descargas/".$directorio.".zip", ZIPARCHIVE::CREATE)==TRUE) {  
      comprimirDirectorio("descargas/".$directorio, $zip);  
    }  

    function comprimirDirectorio($dir, $zip) {  
       if (is_dir($dir)){   
          foreach (scandir($dir) as $item) {   
             if ($item == '.' || $item == '..') continue;  
             comprimirDirectorio($dir . "/" . $item, $zip);  
          }  
       }else{  
          $zip->addFile($dir);  
       }  
    }  

echo "<a href='apps/reportes/form/descargas/".$directorio.".zip' target='_blank'>".$directorio."</a>";
?>