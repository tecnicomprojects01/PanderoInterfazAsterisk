<?Php 
	include_once("conexion/Conexion.php");
	include_once("include/function/function.php");

	$_oBD = CBaseDatos::get_instancia();
    $_oBD->conectar();

    $objFunciones = new CFunction();

$where = "";
$desde = "";
$hasta = "";

if(!empty($_REQUEST['desde'])){
	$desde = $objFunciones->formatDateMysql($_REQUEST['desde'],1);
}else{
	$desde = date('Y-m-d');
}

if(!empty($_REQUEST['hasta'])){
	$hasta = $objFunciones->formatDateMysql($_REQUEST['hasta'],1);
}else{
	$hasta = date('Y-m-d');
}

if(!empty($_REQUEST['tdesde'])){
	$tdesde = $_REQUEST['tdesde'];
}else{
	$tdesde = "00:00:00";
}

if(!empty($_REQUEST['thasta'])){
	$thasta = $_REQUEST['thasta'];
}else{
	$thasta = "23:59:59";
}

if(!empty($_REQUEST['cola'])){
	$cola = ($_REQUEST['cola']==0 ? "%%" : $_REQUEST['cola']);
}else{
	$cola = "%%";
}

if(!empty($_REQUEST['agente'])){
	$agente = ($_REQUEST['agente']==0 ? "%%" : $_REQUEST['agente']);
}else{
	$agente = "%%";
}

if(!empty($_REQUEST['chkent']) || !empty($_REQUEST['chksal'])){		
	if($_REQUEST['chkent']==0 && $_REQUEST['chksal']==0){ $callsense = ""; }
	if($_REQUEST['chkent']==1 && $_REQUEST['chksal']==1){ $callsense = "%%"; }
	if($_REQUEST['chkent']==1 && $_REQUEST['chksal']==0){ $callsense = "in"; }
	if($_REQUEST['chkent']==0 && $_REQUEST['chksal']==1){ $callsense = "out"; }

	//$callsense = $_REQUEST['chkent']." && ".$_REQUEST['chksal'];
	//echo $callsense;

}else{
	$callsense = '%%';	
}

if(!empty($_REQUEST['estado'])){
	$estado = ($_REQUEST['estado']==0 ? "%%" : $_REQUEST['estado']);
	switch($estado){
		case 1: $estado = "ANSWERED"; break;
		case 2: $estado = "NO ANSWER"; break;
		case 3: $estado = "BUSY"; break;
	}
}else{
	$estado = "%%";
}


//echo "Agente seleccionado => ".$_POST['agente'];

//$where = " where agent.iid_agent like '".$agente."' and date(event_log.ddate_eventlog) between date('".$desde."') and date('".$hasta."')";
$where = " where queue.iid_queue like '".$cola."' AND agent.iid_agent like '".$agente."' and event_log.vcallsense_eventlog like '".$callsense."' and event_log.vstatus_eventlog like '".$estado."' and date(event_log.ddate_eventlog) between '".$desde." ".$tdesde."' and '".$hasta." ".$thasta."'";

$cSql = "select 	queue.vnombre_queue,
					queue.vdescription_queue,
					agent.vfirstname_agent,
					agent.vlastname_agent,	
					event_log.ddate_eventlog,
					event_log.dtime_eventlog,	
					event_log.vuser_eventlog,
					event_log.vexten_eventlog,
					event_log.vfilename_eventlog,
					event_log.vorigin_eventlog,
					event_log.vdestination_eventlog,
					event_log.vdurationtot_eventlog as duraciontotal,					
					event_log.vduration_eventlog as duracion,
					event_log.vcallsense_eventlog,
					event_log.vstatus_eventlog
		from 	event_log 
		inner join user 
		on event_log.vuser_eventlog = user.vnick_user
		inner join agent
		on user.iid_agent = agent.iid_agent
		inner join user_queue
		on user.iid_user = user_queue.iid_user
		inner join queue
		on user_queue.iid_queue = queue.iid_queue ".$where;

//echo $cSql;

/*$cSql = "select '' as vnombre_queue,
					'' as vdescription_queue,
					'' as vfirstname_agent,
					'' as vlastname_agent,	
					'' as ddate_eventlog,
					'' as dtime_eventlog,	
					'' as vuser_eventlog,
					'' as vexten_eventlog,
					event_log.vfilename_eventlog,
					'' as vorigin_eventlog,
					'' as vdestination_eventlog,
					'' as duraciontotal,
					'' as duracion

		from 	event_log limit 10 "; */

$rsGrabacionLlamadaAgente = mysql_query($cSql);


function timeformat($time){
        $horas = floor($time/3600);
        $minutos = floor(($time-($horas*3600))/60);
        $segundos = $time-($horas*3600)-($minutos*60);
        return $horas.'h:'.$minutos.'m:'.$segundos.'s';
}

?>