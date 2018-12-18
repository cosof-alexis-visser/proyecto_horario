<?php
/**
********************************************************************************************************************
* Sistema       :    PROYECTO HORARIO
*
* Descripción   :    Clase en donde se creará la instancia  con la base de datos y proporcionará los métodos para la ejecución de consultas
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    basedatos.php
*
* Creación      :    17-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/

class BaseDatos extends PDO{
    
    private static $_instancia;
    private static $_consulta;
    
    public function __construct(){
        try{            
            require_once "configuracion.php";        
            parent::__construct(_BD_MOTOR_.":host="._BD_HOST_";db_name="._BD_NAME_.";charset="._BD_CHARSET_,_BD_USER_,_BD_PASS_);
            
        }catch(PDOException $error){
            die($error->getMessage());
        }
        
    }
    
    
    /*
     *****************************************************
     * Metodo      : instanciar
     * Descripción : Crea una instancia o conexión con la base de datos sí es que no existe
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 17-12-2018
     * @return     : object
     ******************************************************
     */    
    public static function instanciar(){
        if(self::$_instancia){
            return self::$_instancia;
        }else{
            self::$_instancia = new BaseDatos();
            return self::$_instancia;
        }
    }
    
    /*
     *****************************************************
     * Metodo      : ejecutarConsulta
     * Descripción : Recibe una query y sus parametros en un arreglo y lo ejecuta en la base de datos
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 17-12-2018
     * @param      : String $query, array $params
     * @return     : object static $_instancia
     ******************************************************
     */
    public function ejecutarConsulta($query,$params = array()){
        try{
            //Validaciones
            if(!is_array($params)){
                throw new Exception("Params no es un arreglo como parámetros");
            }
            if(!is_string($query)){
               throw new Exception("Query no es una cadena"); 
            }
            if(is_null($query)){
                throw new Exception("Query es nulo"); 
            }
            
            if(!self::$_instancia){
                $this->instanciar();
            }
            
            self::$_instancia->prepare($SQL);
            
            if(count($params) > 0){
                self::$_consulta = self::$_instancia->execute($params);
            }else{
                self::$_consulta = self::$_instancia->execute();
            }
            
        }catch(Exception $error){
            die($error->getMessage());   
        }
    }
    
    /*
     *****************************************************
     * Metodo      : transaccionRealizada
     * Descripción : indica sí la consulta realizó cambio o no en la base de datos
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 18-12-2018    
     * @return     : bool 
     ******************************************************
     */    
    public function transaccionRealizada(){
		return self::$consulta->rowCount() > 0;
	}
    
     /*
     *****************************************************
     * Metodo      : getAllResultados
     * Descripción : Obtiene un listado de objetos extraidos de la base de datos
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 18-12-2018    
     * @return     : array  
     ******************************************************
     */
    public function getAllResultados(){
        $datos      = self::$consulta->fetchAll(PDO::FETCH_OBJ);
        $resultados = array();
        $i          = 0; 
        foreach($datos as $fila){
            $resultados['row_'.$i] = (object) $fila;
            $i++;
        }
        
        return $resultados;
    }
    
}