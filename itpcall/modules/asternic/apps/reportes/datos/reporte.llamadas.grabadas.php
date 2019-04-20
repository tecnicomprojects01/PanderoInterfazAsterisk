<?Php 

	include_once("conexion/Conexion.php");
	//include_once("../../../include/function/function.php");

	$_oBD = CBaseDatos::get_instancia();
    $_oBD->conectar();

$cConsultaAgent = "select agent.iid_agent, user.iid_user, user.vnick_user, agent.vfirstname_agent, agent.vlastname_agent  from agent inner join user on agent.iid_agent = user.iid_agent ";

$rsConsultaAgent =mysql_query($cConsultaAgent);

	$cConsultaQueue = "select * from queue";

	$rsConsultaQueue =mysql_query($cConsultaQueue);
?>