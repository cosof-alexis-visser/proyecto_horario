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
    
    private $_conexion;
    private $_consulta;
    
    public function __construct(){
        try{            
            require_once "configuracion.php";            
            parent::__construct(_BD_MOTOR_.":host="._BD_HOST_.";dbname="._BD_NAME_.";charset="._BD_CHARSET_,_BD_USER_,_BD_PASS_);            
        }catch(PDOException $error){
            die($error->getMessage());
        }
        
    }    
    
    /*
     *****************************************************
     * Metodo      : conectar
     * Descripción : Crea una conexión con la base de datos sí es que no existe
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 17-12-2018
     ******************************************************
     */    
    protected function conectar(){
        if(!$this->_conexion){            
           $this->_conexion = new BaseDatos; 
        }
    }    
    
    /*
     *****************************************************
     * Metodo      : conectado
     * Descripción : Verifica la existencia de una conexion
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 18-12-2018
     * @return     : boolean 
     ******************************************************
     */
    public function conectado(){
        if($this->_conexion){
           return true; 
        }
        return false;
    }
    
    /*
     *****************************************************
     * Metodo      : ejecutarConsulta
     * Descripción : Recibe una query y sus parametros en un arreglo y lo ejecuta en la base de datos
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 17-12-2018
     * @param      : String $query, array $params
     ******************************************************
     */
    public function ejecutarConsulta($query,$params = array()){
        try{            
            if(!is_array($params)){
                throw new Exception("Params no es un arreglo");
            }
            if(!is_string($query)){
               throw new Exception("Query no es una cadena"); 
            }
            if(is_null($query)){
                throw new Exception("Query es nulo"); 
            }    
            
            if(!$this->conectado()){
                $this->conectar();
            }
            
            $this->_consulta = $this->_conexion->prepare($query);
            
            if(count($params) > 0){
                $this->_consulta->execute($params);
            }else{
                $this->_consulta->execute();
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
     * @return     : boolean 
     ******************************************************
     */    
    public function transaccionRealizada(){
		return $this->_consulta->rowCount() > 0;
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
        $datos      = $this->_consulta->fetchAll(PDO::FETCH_OBJ);
        $resultados = array();
        $i          = 0; 
        foreach($datos as $fila){
            $resultados['fila_'.$i] = (object) $fila;
            $i++;
        }
        
        return (object)$resultados;
    }
    
}