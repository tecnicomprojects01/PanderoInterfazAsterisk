// items structure
// each item is the array of one or more properties:
// [text, link, settings, subitems ...]
// use the builder to export errors free structure if you experience problems with the syntax

var MENU_ITEMS = 
[
	['Inicio', BASE_URL, {'tw':'_top'}],
	['Anexos', null, null,
		['Nuevo Anexo', BASE_URL + 'summod02/summod02N_frm'],
		['Gestionar Anexos', BASE_URL + 'summod02/summod02'], 
		['Anexo por Lote', BASE_URL + 'summod02/anexosxlote'],
//		['Provisionar Anexo', '/itperu.v2/Provisionar/Reg_Mac.php'],
//		['Lista Negra', '/itperu.v2/summod02/black_list.php'],
	],

	['Claves', null,null,
		['Nueva Clave', BASE_URL + 'summod03/claveN_form'],
		['Gestionar Claves', BASE_URL + 'summod03/claveM_form'],
	],

	['Gestion y Reportes', null, null,
		['Reportes de Llamadas', BASE_URL + 'asterisk-stats/index'],
		['Buscador de Grabaciones',null,null,
			['Llamadas Entrantes', BASE_URL + 'grabacion/Grabacion_IN'],
			['Llamadas Salientes', BASE_URL + 'grabacion/Grabacion_OUT'],

		],
	],
//	['Call Center', '/itperu.v2/asternic/index2.php',null],
//	['Serv. Masivos',null,null,
//	['   IVR  ','/itperu.v2/IVRMasivo/index.php',{'tw':'_top'}],
//	['SMS Masivo','/itperu.v2/servicesms/smsmasivo.php'],
//	],
//	['Directorio Telefonico', null,null,
// 		['Nuevo Contacto','/itperu.v2/directorio/contactoN_form.php',null],
//		['Gestionar contacto', '/itperu.v2/directorio/contactoG.php',null],
//		['Generar contacto.XML' , '/itperu.v2/directorio/generar_contacto.php',null],	
//	],
	//['Gestion de Usuarios','/itperu.v2/summod01/summod01.php', null],
	//['Cerrar Sesion',BASE_URL + 'logout.php',]
];
