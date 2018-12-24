<?php

/**
********************************************************************************************************************
* Sistema       :    PROYECTO HORARIO
*
* Descripción   :    Contiene metodo de autocarga que servirá para la comunicación de controlador con la vista y modelo
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    cargador.php
*
* Creación      :    23-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/

class Cargador{  
    
    public function autoloader(){
        try{
            $ruta   = realpath(dirname(__DIR__)).'/'._APP_.'/'._C_.'/';
            $url    = $_SERVER['REQUEST_URI'];
            $url    = substr($url,1);
            $url    = substr($url,strpos($url,"/")+1);
            $params = explode('/',$url);
            $params = array_filter($params,'strlen');

            if(count($params) > 0){ 
                 if(!isset($params[0])){
                     throw new Exception("Debe indicar un controlador en la ruta");
                 }
                 if(!isset($params[1])){
                     throw new Exception("Debe indicar un metodo en la ruta");
                 }
                 
                 $ruta = $ruta._C_.'_'.$params[0].".php";
                 if(!file_exists($ruta)){
                     throw new Exception("Controlador no existe");
                 }
                  require_once($ruta);
                 
                 $strClass  = ucwords($params[0]);
                 $clase     = $strClass;
                
                 if(!class_exists($strClass)){
                     throw new Exception("Clase no definida");
                 }
                
                 $instancia = new $clase();                
                 
                 if(!method_exists($instancia,$params[1])){
                    throw new Exception("Método no definido en el controlador");   
                 }
                 echo "<pre>".print_r($params,true)."</pre>";
            }else{

            }
        }catch(Exception $e){
            die($e->getMessage());
        }      
    }
    
    public function cargar($clase){
        
    }
    
}

    