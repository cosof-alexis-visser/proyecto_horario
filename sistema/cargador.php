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
    
    /*
     *****************************************************
     * Metodo      : autoloader
     * Descripción : Método encargado de comunicar el controlador con la vista al momento de ingresar una url en el navegador
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 26-12-2018     
     ******************************************************
     */ 
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
                 $metodo = (String) $params[1];
                 $instancia->$metodo();
            }else{

            }
        }catch(Exception $e){
            die($e->getMessage());
        }      
    }    
    
     /*
     *****************************************************
     * Metodo      : modelo
     * Descripción : Método encargado de instanciar un modelo 
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 26-12-2018 
     * @param      : String $nombre
     * @return     : Object 
     ******************************************************
     */ 
    public function modelo($nombre){
        try{
             $clase       = strtolower($nombre);
             $ruta_modelo = substr(realpath(dirname(__FILE__)),0,strpos(realpath(dirname(__FILE__)),"/sistema"))."\\"._APP_."\\"._M_."\\"._M_."_".$clase.".php";
             echo $ruta_modelo;
             if(!file_exists($ruta_modelo)){
                 throw new Exception("Es imposible encontrar el modelo $clase"); 
             }
    
            require_once($ruta_modelo); 
            $strClass = ucwords($clase);
            $clase    = $strClass;
            
            if(!class_exists($strClass)){
                throw new Exception("El modelo $clase no se encuentra declarado");
            }    
            
            return new $clase();
            
        }catch(Exception $e){
             die($e->getMessage()); 
        }    
    }
    
    /*
     *****************************************************
     * Metodo      : controlador
     * Descripción : Método encargado de instanciar un controlador 
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 26-12-2018 
     * @param      : String $nombre
     * @return     : Object 
     ******************************************************
     */ 
     public function controlador($nombre){
        try{
             $clase            = strtolower($nombre);
             $ruta_controlador = realpath(dirname(__FILE__))."/"._APP_."/"._C_."/"._C_."_".$clase.".php";
             if(!(file_exists($ruta_controlador) and is_readable($ruta_controlador))){
                 throw new Exception("Es imposible encontrar el controlador $clase"); 
             }
             
            $strClass = ucwords($clase);
            $clase    = $strClass;
            
            if(!class_exists($strClass)){
                throw new Exception("El controlador $clase no se encuentra declarado");
            }    
            
            return new $clase();
            
        }catch(Exception $e){
             die($e->getMessage()); 
        }    
    }
    
    /*
     *****************************************************
     * Metodo      : vista
     * Descripción : Método encargado de instanciar una vista 
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 26-12-2018 
     * @param      : String $nombre
     * @return     : Object 
     ******************************************************
     */ 
     public function vista($nombre){
        try{
             $clase            = strtolower($nombre);
             $ruta_controlador = realpath(dirname(__FILE__))."/"._APP_."/"._V_."/"._V_."_".$clase.".php";
             if(!(file_exists($ruta_controlador) and is_readable($ruta_controlador))){
                 throw new Exception("Es imposible encontrar el controlador $clase"); 
             }
             
            $strClass = ucwords($clase);
            $clase    = $strClass;
            
            if(!class_exists($strClass)){
                throw new Exception("El controlador $clase no se encuentra declarado");
            }    
            
            return new $clase();
            
        }catch(Exception $e){
             die($e->getMessage()); 
        }    
    }
    
}

    