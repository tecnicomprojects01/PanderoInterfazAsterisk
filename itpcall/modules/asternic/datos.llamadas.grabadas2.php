<?Php 

	//include_once("conexion/Conexion.php");
	//include_once("../../../include/function/function.php");

	//$_oBD = CBaseDatos::get_instancia();
       //$_oBD->conectar();

	$cn = mysql_connect('localhost','root','itperu321x');
	if(!empty($_REQUEST['pais'])){
	   if($_REQUEST['pais'] == "espania"){
		$pais = "espania";
		//echo "España";
		mysql_select_db('bdCentralAsteriskCdr002',$cn);
	   }else if($_REQUEST['pais'] == "peru"){
		//echo "Peru";
		$pais = "peru";
		mysql_select_db('bdCentralAsteriskCdr002',$cn);
	   }
	}else{
		$pais = "peru";
		mysql_select_db('bdCentralAsteriskCdr002',$cn);
	}

	$cConsultaAgent = "select agent.iid_agent, user.iid_user, user.vnick_user, agent.vfirstname_agent, agent.vlastname_agent  from agent inner join user on agent.iid_agent = user.iid_agent ";

	$rsConsultaAgent =mysql_query($cConsultaAgent);

	$cConsultaQueue = "select * from queue";

	$rsConsultaQueue =mysql_query($cConsultaQueue);
?>
