<?php
if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");
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
    
    private function convertAPPNAME(){         
         
         $arrAux = explode(' ',_APP_NAME_);
         $strAux = implode('_',$arrAux);
        
         return strtolower($strAux);
    }
    
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
            $ruta       = realpath(dirname(__DIR__)).'/'._APP_.'/'._C_.'/';
            $url        = $_SERVER['REQUEST_URI'];
            $url        = substr($url,1);
            $url        = substr($url,strpos($url,"/")+1);
            $params     = explode('/',$url);
            $params     = array_filter($params,'strlen');
            $parametros = array();
            
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
                
                 if(count($params) > 2){
                    for($i=2;$i<sizeof($params);$i++){
                       $parametros[] = $params[$i]; 
                    } 
                    $strParametros = implode(',',$parametros); 
                    $instancia->$metodo($strParametros); 
                 }else{
                    $instancia->$metodo(); 
                 }                
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
            
             $clase  = strtolower($nombre);
             $strDirRaiz  = $this->convertAPPNAME();
             $ruta_modelo = $_SERVER["DOCUMENT_ROOT"]."/".$strDirRaiz."/"._APP_."/"._M_."/"._M_."_".$clase.".php";
             
             if(!file_exists($ruta_modelo) and is_readable($ruta_controlador)){
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
             $strDirRaiz       = $this->convertAPPNAME();
             $ruta_controlador = $_SERVER["DOCUMENT_ROOT"]."/".$strDirRaiz."/"._APP_."/"._C_."/"._C_."_".$clase.".php";
            
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
     * Metodo      : mostrar
     * Descripción : Método encargado de instanciar una vista 
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 26-12-2018 
     * @param      : String $nombre     
     ******************************************************
     */ 
     public function vista($nombre){
        try{
             $vista            = strtolower($nombre);
             $strDirRaiz       = $this->convertAPPNAME();
             $ruta_vista       = $_SERVER["DOCUMENT_ROOT"]."/".$strDirRaiz."/"._APP_."/"._V_."/"._V_."_".$vista.".php";
            
             if(!(file_exists($ruta_vista) and is_readable($ruta_vista))){
                 throw new Exception("Es imposible cargar la vista $clase"); 
             }
             
             require_once($ruta_vista);       
            
        }catch(Exception $e){
             die($e->getMessage()); 
        }    
    }
    
    
    public function js($nombre){
        try{
             $js               = strtolower($nombre);
             $strDirRaiz       = $this->convertAPPNAME();
             $ruta_js[0]       = $_SERVER["DOCUMENT_ROOT"]."/".$strDirRaiz."/librerias/js/".$js.".js";
             $ruta_js[1]       = $_SERVER["DOCUMENT_ROOT"]."/".$strDirRaiz."/"._APP_."/"._V_."/js/".$js.".js";
             
             echo  $ruta_js[1]."\r\n";
            //echo $_SERVER["SERVER_NAME"]."\r\n";
             foreach($ruta_js AS $ruta){
                if(file_exists($ruta)){
                   return "<script src='$ruta' type='text/javascript'></script>";           
                } 
             }
             
             throw new Exception("La librería JavaScript indicada no existe");             
            
        }catch(Exception $e){
             die($e->getMessage()); 
        }
    }
    
}

    