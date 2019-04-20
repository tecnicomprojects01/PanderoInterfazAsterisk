<?Php 
/**
* Autor : Carlos ALberto Sacaca Bernachea
* Fecha : 31/05/2012 11:37
*/
class CBaseDatos //Tipo Singleton
{
    //objeto resource que indicara si se ha conectado
    private $_oLinkId;
    private $_sServidor;
    private $_sNombreBD;
    private $_sUsuario;
    private $_sClave;
    private $_sMensaje;
 
    //Almacenara un objeto de tipo CBaseDatos
    private static $_oSelf = null;
 
    private function __construct()
    {
	echo "%%%%%%".$this->_sServidor;
        $this->_sServidor = "192.168.99.20";
        $this->_sNombreBD = "asteriskcdr";
        $this->_sUsuario = "pquispe";
        $this->_sClave = "swlagiu5";
        $this->_sMensaje = "";
    }
 
    /**
    * Este es el pseudo constructor singleton
    * Comprueba si la variable privada $_oSelf tiene un objeto
    * de esta misma clase, sino lo tiene lo crea y lo guarda
    */
    public static function get_instancia($servidor, $basedatos, $user, $clave)
    {
        //Si no hay instancia de CBaseDatos
        //en la variable estatica $_oSelf
        if( !self::$_oSelf instanceof self )
        {
            //Se crea un objeto de CBaseDatos guardandolo
            //en la varialbe estatica
            //new self ejecuta __construct()
            self::$_oSelf = new self;
        }
        //Se devuelve el objeto creado
        return self::$_oSelf;
    }
 
    /**
    * Realiza la conexion y devuelve el resultado
    * @return true si hubo exito en la conexion
    */
    public function conectar($servidor, $basedatos, $user, $clave)
    {

	echo "######".$servidor."<br>";
	echo "######".$basedatos."<br>";
	echo "######".$user."<br>";
	echo "######".$clave."<br>";

        //VERIFICAMOS LA CONEXION CON MYSQL
        //rCon es tipo resource si tiene exito y guarda un "link identifier"
        //sino guarda un false
        $oMysqlConnect = mysql_connect
        (   "192.168.99.20",
	     "pquispe",
	     "swlagiu5"
        );
 
        //si no es tipo resource es q no ha tenido exito la conexion
        if(!is_resource($oMysqlConnect))
        {
            $this->_sMensaje = "ERROR: No se puede conectar a la base de datos..! ".$this->_sNombreBD;
            //Lanza la excepcion y se sale del procedimiento
            throw new Exception($this->_sMensaje);
            die;
        }
 
        //Guardamos el id del recurso conectado
        $this->_oLinkId = $oMysqlConnect;
 
        //VERIFICAMOS QUE EXISTA LA BASE DE DATOS EN EL MOTOR
        $bExisteBD  =  mysql_select_db($this->_sNombreBD, $oMysqlConnect);
        //si no se pudo encontrar esa BD lanza un error
        if(!$bExisteBD)
        {
            $this->_sMensaje = "ERROR: No se puede usar la base de datos..! ".$this->_sNombreBD;
            //Lanza la excepcion y se sale del procedimiento
            throw new Exception($this->_sMensaje);
            die;
        }
        else //Si se conectÓ
        {
            $this->_sMensaje = "SE CONECTO CON EXITO";
            //mysql_set_charset('utf8',$this->_oLinkId);
        }
 
        return true;
    }
 
    private function get_servidor()
    {
        return $this->_sServidor;
    }
 
    public function get_usuario()
    {
        return $this->_sUsuario;
    }
 
    private function get_clave()
    {
        return $this->_sClave;
    }
 
    public function get_mensaje()
    {
        return $this->_sMensaje;
    }
 
    public function get_nombre_bd()
    {
        return $this->_sNombreBD;
    }
 
    public function get_link_id()
    {
        return $this->_oLinkId;
    }
}
?>