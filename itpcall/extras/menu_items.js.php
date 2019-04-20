// items structure
// each item is the array of one or more properties:
// [text, link, settings, subitems ...]
// use the builder to export errors free structure if you experience problems with the syntax

<?
$var=1;
?>

var MENU_ITEMS = [
	['Inicio', '/itperu/inicio.php', {'tw':'_top'}],
	['Gestion de Anexos', '/itperu/summod02/summod02.php', null,//
		['Crear', '/itperu/aCrear.php'],
//		['Modificar', '/itperu/aModif.php'],
//		['Modificar', '/itperu/aNuevoModif.php'],
//		['Eliminar', '/itperu/aBorra.php'],

	],
//	['Gestion de Claves', null, null,
<? // if($var==0){?>
	['Gestion de Claves', '/itperu/cNuevo.php',
//		['Crear', 'cCrear.php'],
//		['Modificar', 'cModif.php'],
//		['Borrar', 'cBorra.php'],
//		['Nuevo', 'cNuevo.php'],
//	],
//	['Gestion de Claves', 'cUltimo.php',
	],<? // } ?>
	['Gestion y Reportes', null, null,
//		['Backup', 'bGener.php'],
//		['Llamadas', '/itperu/summod05.php',{'tw':'_blank'}],
		['Colas', '/queue-stats/index.php'],
		['Llamadas', '/itperu/summod05.php'],
		['Log Llamadas', '/asterisk-stats'],
		['Monitor En Tiempo Real', '/panel/index.php'],
		['Buscador Grabaciones', '/grabacion/index.php'],
//		['IVR', '/ivr/index.php'],
//	['Reporte', 'summod05.php',{'tw':'_top'}
//		['Backup', 'bGener.php'],
//		['Reportes', 'summod05.php'],
//		['Monitoreo', 'monitoreo.php'],
	],
	['Gestion de Usuarios','/itperu/summod01/summod01.php', null],
	['Cerrar Sesion','/itperu/index.php',]

];
