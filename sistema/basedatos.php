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
    
    public function __construct(){
        try{
            
            require_once "configuracion.php";        
            parent::__construct(_BD_MOTOR_.":host="._BD_HOST_";db_name="._BD_NAME_.";charset="._BD_CHARSET_,_BD_USER_,_BD_PASS_);
            
        }catch(PDOException $error){
            die($error->getMessage());
        }
        
    }
    
    public static instanciar(){
        if(self::$_instancia){
            return self::$_instancia;
        }else{
            self::$_instancia = new BaseDatos();
            return self::$_instancia;
        }
    }
    
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
            
        }catch(Exception $error){
            die($error->getMessage());   
        }
    }
}