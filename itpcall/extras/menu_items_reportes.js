// items structure
// each item is the array of one or more properties:
// [text, link, settings, subitems ...]
// use the builder to export errors free structure if you experience problems with the syntax

var MENU_ITEMS = 
[
	['Inicio', BASE_URL, {'tw':'_top'}],
	['Reporte CDR', BASE_URL + 'asterisk-stats/index/s=1'],
	['Grabaciones',null,null,
		['Llamadas Entrantes', BASE_URL + 'grabacion/Grabacion_IN'],
		['Llamadas Salientes', BASE_URL + 'grabacion/Grabacion_OUT'],
	],
	
//	['Call Center', '/itperu.v2/asternic/index2.php',null],
	//['Cerrar Sesion',BASE_URL + 'logout.php',],
];
