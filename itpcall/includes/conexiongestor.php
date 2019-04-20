<?php
class conexiongestor{
	private $servidor;
	private $base;
	private $usuario;
	private $password;
	
	private $sentencia;
	private $resultado;
	private $enlace;
			
	function __construct($servidor,$usuario,$password,$base){
		$this->servidor = $servidor;
		$this->usuario = $usuario;
		$this->password = $password;
		$this->base = $base;
		$this->conectar();
		/*
		$this->servidor = "localhost";
		$this->usuario = "root";
		$this->password = "";
		$this->base = "db_pbx";
		*/
	}
	
	private function conectar(){
		if ($enlace=mysql_connect($this->servidor,$this->usuario,$this->password)){
			if (mysql_select_db($this->base,$enlace)){
				$this->enlace=$enlace;
				//echo "Conexion OK ".$this->base;
			}else{
				echo mysql_error()." ".mysql_errno()." Error en la conexion a la Base de Datos ".$this->base;
				exit();
			}
		}else{
			echo "Error en la conexion, al Servidor de Base de Datos";
			exit();
		}
	}

	public function findusuario($usuario,$clave,$perfil){
			$sql = "SELECT usuario,clave,perfil,extension FROM tb_usuarios INNER JOIN tb_perfiles 
USING(idperfil) 
WHERE tb_usuarios.flag=1 and usuario='".$usuario."' AND clave='".$clave."' AND idperfil='".$perfil."'";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function insertusuario($id,$usuario,$clave,$flag,$idperfil,$idlocal){
		$sql = "INSERT INTO tb_usuarios(idusuario,usuario,clave,flag,idperfil,idlocal) VALUES ($id,'$usuario','$clave','$flag','$idperfil','$idlocal')";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function updateusuario($idus,$clave,$idperfil,$extension){
		if ($clave != ""){
			$sql = "UPDATE tb_usuarios SET clave='$clave' WHERE idusuario='$idus'";	
		}
		else if ($idperfil != 0){
			$sql = "UPDATE tb_usuarios SET idperfil='$idperfil' WHERE idusuario='$idus'";	
		}	
		else if ($extension != ""){
			$sql = "UPDATE tb_usuarios SET extension='$extension' WHERE idusuario='$idus'";
		}		
		else if ($clave != "" && $idperfil != "" && $extension != ""){
			$sql = "UPDATE tb_usuarios SET clave='$clave', idperfil='$idperfil', extension='$extension' 
WHERE idusuario='$idus'";
		}		
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function deleteusuario($idus){
		$sql = "UPDATE tb_usuarios SET flag=0 WHERE idusuario='$idus'";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function insert_correovoz($id,$nom,$clave,$mail,$adj,$flag,$idanexo){
		$sql = "insert into tb_correodevoz (idcorreovoz,nombre,clave,mail,adjunto,flag,idanexo) values ($id,'$nom','$clave','$mail','$adj',$flag,$idanexo)";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}

	//insert_usuario($id,$acc,$usnm,$sec,$clid,$ctx,$mbox,$setv)
	
	public function insert_agente($idagente,$numero,$nombre,$cola){
		$sql = "insert into tb_agente(agent_id,agent_numero,agent_nombre,agent_cola) values ($idagente,'$numero','$nombre','$cola')";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}


	public function insert_anexo($idanexo,$anexo,$flag,$idlocal){
		$sql = "insert into tb_anexos(idanexo,anexo,flag,idlocal) values ($idanexo,'$anexo',$flag,$idlocal)";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function insert_valor_param($idanx,$valor){
		$sql = "update tb_parametros set valor='$valor'";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function insert_anexo_param($idanexo,$idparam,$valor,$orden){
		$sql = "insert into tb_anexo_parametro(idanexo,idparametro,valor,orden) values ($idanexo,$idparam,'$valor',$orden)";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	/* tb_desvio */
	public function insert_desvio($anexo,$nanexo,$ntiempo,$ntipo,$banexo,$btiempo,$btipo,$aanexo,$atiempo,$atipo,$chanexo,$chtiempo,$chtipo){
		$sql = "insert into tb_desvio(des_anexo,des_na,des_ntiempo,des_ntipo,des_ba,des_btiempo,des_btipo,des_aa,des_atiempo,des_atipo,des_cha,des_chtiempo,des_chtipo) values ('$anexo',$nanexo,$ntiempo,'$ntipo',$banexo,$btiempo,'$btipo',$aanexo,$atiempo,'$atipo',$chanexo,$chtiempo,'$chtipo')";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}


	// tb_monitoreo
	
	#insert into tb_monitoreo(anx_estado,lla_tiempo,lla_canal,lla_destino,anx_numero,flag,anx_ip,anx_nombre)
	#VALUES (anx_estado,lla_tiempo,lla_canal,lla_destino,anx_numero,flag,anx_ip,anx_nombre)
	
	public function insert_monitoreo($anx_est,$lla_tmp,$lla_cnl,$lla_dst,$anx_nro,$flag,$anx_ip,$anx_nom){
		//$sql = "insert into tb_monitoreo(anx_numero,anx_nombre,flag) values ('$num','$nom',$flag)";
		$sql = "insert into tb_monitoreo(anx_estado,lla_tiempo,lla_canal,lla_destino,anx_numero,flag,anx_ip,anx_nombre) values
		('$anx_est','$lla_tmp','$lla_cnl','$lla_dst','$anx_nro',$flag,'$anx_ip','$anx_nom')";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	/*
	function lista(){
			$sql = "SELECT anexo,GROUP_CONCAT(IF(parametro='callerid',valor,null)) as usuario,GROUP_CONCAT(IF(parametro='context',valor,null)) as contexto FROM tb_anexos INNER JOIN tb_anexo_parametro USING(idanexo) INNER JOIN tb_parametros USING(idparametro) WHERE parametro in ('callerid','context') GROUP BY anexo";								            $this->sentencia = mysql_query($sql,$this->enlace);
	}
	*/
	
	public function buscar_anexo($anexo){
		$sql = "select idanexo,anexo from tb_anexos where anexo='$anexo'";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	public function buscar_agente($agente){
		$sql = "select agent_id,agent_numero from tb_agente where agent_numero='$agente'";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	

	
	#select modulo from tb_perfiles as p 
	#inner join tb_perfil_modulo as pm USING(idperfil) 
	#inner join tb_modulos as m USING(idmodulo) 
	#where p.idperfil=1 and m.flag=1;

	public function selectmodulo($perfil){
		#$sql = "select modulo from tb_perfiles inner join tb_perfil_modulo USING(idperfil) inner join tb_modulos USING(idmodulo) where idperfil='".$perfil."'";
		$sql = "select modulo from tb_perfiles as p inner join tb_perfil_modulo as pm USING(idperfil) inner join tb_modulos as m USING(idmodulo) where m.flag=1 and p.idperfil='".$perfil."'";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function listusuario(){
		$sql="select usuario,perfil,idusuario,extension from tb_usuarios inner join tb_perfiles 
using(idperfil) where tb_usuarios.flag=1";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function listanexo(){
		$sql = "SELECT idanexo,anexo,GROUP_CONCAT(if(parametro='callerid',valor,null)) as usuario,GROUP_CONCAT(IF(parametro='context',valor,null)) as contexto,GROUP_CONCAT(if(parametro='record',valor,null)) as grabar FROM tb_anexos INNER JOIN tb_anexo_parametro USING(idanexo) INNER JOIN tb_parametros USING(idparametro) WHERE parametro in ('callerid','context','record') and tb_anexos.flag= 1 GROUP BY anexo";								
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	public function listagente(){
		$sql = "SELECT agent_id,agent_numero,agent_cola,agent_nombre FROM tb_agente ORDER BY agent_cola";								
		$this->sentencia = mysql_query($sql,$this->enlace);
	}

public function listaparametroanexo(){
		$sql = "SELECT ap.idanexo,anexo,parametro,valor,orden FROM tb_anexos a INNER JOIN tb_anexo_parametro ap ON a.idanexo=ap.idanexo INNER JOIN tb_parametros p ON ap.idparametro=p.idparametro ORDER BY  ap.idanexo,ap.orden";								
		$this->sentencia = mysql_query($sql,$this->enlace);	
	}

	public function listamodalidad(){
		$sql = "SELECT mod_id,mod_nombre,mod_audio FROM tb_mod_ivr";								
		$this->sentencia = mysql_query($sql,$this->enlace);	
	}

	public function listacontexto(){
		$sql = "SELECT idnivel,nivel,descripcion FROM tb_anexos_niveles";								
		$this->sentencia = mysql_query($sql,$this->enlace);	
	}

	public function listacontacto(){
		$sql = "SELECT id,nombre,fijo,celular1,celular2,email FROM tb_directory";								
		$this->sentencia = mysql_query($sql,$this->enlace);	
	}
	public function listaclientes(){
		$sql = "SELECT cli_id,cli_nombres,cli_telsunat,cli_fijo,cli_rpc,cli_rpm,cli_nextel,cli_claro,cli_movistar,cli_otro,agent_nombre FROM tb_clientes c INNER JOIN tb_agente a ON c.cli_id_agente=a.agent_id";								
		$this->sentencia = mysql_query($sql,$this->enlace);	
	}

	public function selectusuariop($idus){
		$sql="select usuario,clave,perfil,extension from tb_usuarios inner join tb_perfiles using(idperfil) 
where tb_usuarios.flag=1 and idusuario='".$idus."'";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function delete_anexo($idanx){
		$sql = "UPDATE tb_anexos SET flag = 0 WHERE idanexo='$idanx'";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	// Parametros del anexo
	public function select_param(){
		$sql = "select idparametro,parametro from tb_parametros where tb_parametros.flag=1";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
	public function select_anexo($idanexo){
		$sql = "select idanexo,parametro,valor from tb_anexos inner join tb_anexo_parametro using(idanexo) inner join tb_parametros using(idparametro) where idanexo=$idanexo";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	public function select_contexto($idcon){
		$sql = "SELECT idnivel,nivel,descripcion,tipo FROM tb_anexos_niveles WHERE idnivel=$idcon";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	public function select_contacto($idcon){
		$sql = "SELECT id,nombre,fijo,celular1,celular2,email FROM tb_directory WHERE id=$idcon";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	public function select_contacto_call($idcon){
		$sql = "SELECT cli_id,cli_nombres,cli_telsunat,cli_fijo,cli_rpc,cli_rpm,cli_nextel,cli_claro,cli_movistar,cli_otro,cli_id_agente,agent_nombre FROM tb_clientes c INNER JOIN tb_agente a ON c.cli_id_agente=a.agent_id WHERE cli_id=$idcon";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}

	public function select_modalidad($idcon){
		$sql = "SELECT mod_id,Mod_nombre,Mod_audio FROM tb_mod_ivr WHERE mod_id=$idcon";
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
public function listacorreovoz(){
		$sql = "select anexo,clave,nombre,mail,adjunto from tb_correodevoz c inner join tb_anexos a ON c.idanexo=a.idanexo";
		$this->sentencia = mysql_query($sql,$this->enlace);		
	}

	//public function select_correovoz($idanexo){
	//	$sql = "select clave,mail,adjunto from tb_correodevoz where idanexo=$idanexo";
	//	$this->sentencia = mysql_query($sql,$this->enlace);		
	//}
	
	public function buscar_correovoz($sql){
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	public function buscar_desvio($sql){
		$this->sentencia = mysql_query($sql,$this->enlace);
	}
	
		
	public function update_anexo($sql){
		$this->sentencia = mysql_query($sql,$this->enlace);		
	}
	public function update_contexto($sql){
		$this->sentencia = mysql_query($sql,$this->enlace);		
	}
		
	public function update_voicemail($sql){
		$this->sentencia = mysql_query($sql,$this->enlace);		
	}

	# Insert, Select, Update, Delete	
	public function mantenimiento($sql){
		$this->sentencia = mysql_query($sql,$this->enlace);		
	}
	
	/*
	public function buscar_anexo($sql){
		$this->sentencia = mysql_query($sql,$this->enlace);		
	}
	*/
	
	public function respuesta(){
		$this->resultado=mysql_fetch_array($this->sentencia);
		return $this->resultado;
	}
	
	public function respuesta1(){
		$this->resultado=mysql_fetch_row($this->sentencia);
		return $this->resultado;
	}
	
	public function cantregistros(){
		$this->resultado=@mysql_num_rows($this->sentencia);
		return $this->resultado;
	}
		
	public function liberarmemoria(){
		mysql_free_result($this->sentencia);
	}
	
	public function cierradb(){
		mysql_close($this->enlace);
	}
}
?>
