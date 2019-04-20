// items structure
// each item is the array of one or more properties:
// [text, link, settings, subitems ...]
// use the builder to export errors free structure if you experience problems with the syntax

var MENU_ITEMS = 
[
	['Inicio', BASE_URL, {'tw':'_top'}],
////	['Stats', BASE_URL + '../stats/'],
	['Anexos', null, null,
		['Nuevo Anexo', BASE_URL + 'summod02/summod02N_frm'],
		['Gestionar Anexos', BASE_URL + 'summod02/summod02'], 
		['Anexo por Lote', BASE_URL + 'summod02/anexosxlote'],
		['Relacion de IP-Anexos', BASE_URL + 'summod02/extensionesip'],
//		['Provisionar Anexo', BASE_URL + 'Provisionar/provisionar'],
		['Reconstruir Prov.', BASE_URL + 'modules/Provisionar/fast/regenerar.php'],
		['Lista Negra', BASE_URL + 'Blacklist/black_list'],
		

	],

	['Claves', null,null,
		['Nueva Clave', BASE_URL + 'summod03/claveN_form'],
		['Gestionar Claves', BASE_URL + 'summod03/claveM_form'],
	],

	['Reportes', null, null,
//		['Backup', 'bGener.php'],
		//['Reportes de Llamadas', BASE_URL + 'asterisk-stats/index'],
		['Buscador de Grabaciones',null,null,
			['Llamadas Entrantes', BASE_URL + 'grabacion/Grabacion_IN'],
			['Llamadas Salientes', BASE_URL + 'grabacion/Grabacion_OUT'],
		],
	/*['Resumen de LLamadas',null,null,
			['Resumen general', BASE_URL + 'llamadas/resumen_llamadas'],
			['Resumen por Anexos', BASE_URL + 'llamadas/resumen_anexos'],
			['Resumen por Codigo', BASE_URL + 'llamadas/resumen_codigo'],	
		],*/
		['Reporte CDR', BASE_URL + 'asterisk-stats/index/s=1'],
		['Comparacion de Llamadas', BASE_URL + 'asterisk-stats/index/s=2'],
		['Trafico Mensual', BASE_URL + 'asterisk-stats/index/s=3'],
		['Carga Diaria', BASE_URL + 'asterisk-stats/index/s=4'],
	],
	
	
	['Usuarios',BASE_URL + 'summod01/summod01', null],
	['Actualizar', BASE_URL + 'mantenimiento/soporte',null],

	//['Cerrar Sesion',BASE_URL + 'logout.php',]
];
