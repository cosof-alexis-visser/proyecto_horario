<?php
if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");
/**
********************************************************************************************************************
* Sistema       :    ALVISS FRAMEWORK
*
* Clase         :    Cargador
*
* Descripción   :    Contiene métodos para cargar vistas,controladores,modelos, js, css 
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
            $ruta       = realpath(dirname(__DIR__)).'/'._APP_.'/'._C_.'/';
            $url        = $_SERVER['REQUEST_URI'];
            $url        = substr($url,1);
            $url        = substr($url,strpos($url,"/")+1);
            $params     = explode('/',$url);
            //$params     = array_filter($params_sep,'strlen');
            $parametros = array();
            
            if(count($params) > 0){ 
                 ///echo $params[2];
                 if(!isset($params[1])){
                     throw new Exception("Debe indicar un controlador en la ruta");
                 }
                 
                 if(isset($params[2]) && empty($params[2])){
                     $params[2] = "index";                       
                 }
                
                 if(count($params) == 2){
                     throw new Exception("Debe ingresar una ruta válida");
                 }                
                 
                 $ruta = $ruta._C_.'_'.$params[1].".php";
                
                 if(!file_exists($ruta)){
                     throw new Exception("Controlador no existe");
                 }
                  require_once($ruta);
                 
                 $strClass  = ucwords($params[1]);
                 $clase     = $strClass;
                 // echo $clase;
                 if(!class_exists($strClass)){
                     throw new Exception("Clase no definida");
                 }
                
                 $instancia = new $clase();                
                 
                 if(!method_exists($instancia,$params[2])){
                    throw new Exception("Método no definido en el controlador");   
                 }
                 $metodo = (String) $params[2];
                
                 if(count($params) > 2){
                    for($i=3;$i<sizeof($params);$i++){
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
             $strDirRaiz  = Convertidor::convertirEspaciosEnGuionBajo(_APP_NAME_);
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
             $strDirRaiz       = Convertidor::convertirEspaciosEnGuionBajo(_APP_NAME_);
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
     * Metodo      : vista
     * Descripción : Método encargado de cargar una vista 
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 26-12-2018 
     * @param      : String $nombre     
     ******************************************************
     */ 
     public function vista($nombre){
        try{            
            
             $vista            = strtolower($nombre);
             $strDirRaiz       = Convertidor::convertirEspaciosEnGuionBajo(_APP_NAME_);
             $ruta_vista       = $_SERVER["DOCUMENT_ROOT"]."/".$strDirRaiz."/"._APP_."/"._V_."/maestras/maestra_".$vista.".php";
            
             if(!(file_exists($ruta_vista) and is_readable($ruta_vista))){
                 throw new Exception("Es imposible cargar la vista $vista"); 
             }
             
             require_once($ruta_vista);       
            
        }catch(Exception $e){
             die($e->getMessage()); 
        }    
    }    
    
     /*
     *****************************************************
     * Metodo      : js
     * Descripción : Método encargado de cargar una librería o archivo JavaScript
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 26-12-2018 
     * @param      : String $nombre     
     ******************************************************
     */
    public function js($nombre){
        try{             
            
             $js               = strtolower($nombre);
             $strDirRaiz       = Convertidor::convertirEspaciosEnGuionBajo(_APP_NAME_);
             $protocolo        = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
             $ruta_base        = $_SERVER["DOCUMENT_ROOT"]."/".$strDirRaiz."/";
             $op               = 0;
             $ruta_js[0]       = $ruta_base."librerias/js/".$js.".js";
             $ruta_js[1]       = $ruta_base."app/vista/js/".$js.".js";             
            
             foreach($ruta_js AS $ruta){
                $op++;                
                if(Validar::existeURL($ruta)){
                   $ruta = $op == 1 ? "../../".substr($ruta,strlen($ruta_base),strlen($ruta)) : "../../".substr($ruta,strlen($ruta_base),strlen($ruta));
                   return "<script src='$ruta' type='text/javascript'></script>";           
                } 
             }
             
             throw new Exception("La librería JavaScript indicada no existe");             
            
        }catch(Exception $e){
             die($e->getMessage()); 
        }
     }
      /*
     *****************************************************
     * Metodo      : css
     * Descripción : Método encargado de cargar una librería o archivo CSS (CASCADE STYLE SHEET)
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 26-12-2018 
     * @param      : String $nombre     
     ******************************************************
     */
     public function css($nombre){
        try{            
            
             $css              = strtolower($nombre);
             $strDirRaiz       = Convertidor::convertirEspaciosEnGuionBajo(_APP_NAME_);
             $protocolo        = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
             $ruta_base        = $_SERVER["DOCUMENT_ROOT"]."/".$strDirRaiz."/";
             $op               = 0;
             $ruta_css[0]      = $ruta_base."librerias/css/".$css.".css";
             $ruta_css[1]      = $ruta_base."app/vista/css/".$css.".css";             
             
             foreach($ruta_css AS $ruta){
                $op++;
                if(Validar::existeURL($ruta)){                   
                   $ruta = $op == 1 ? "../../".substr($ruta,strlen($ruta_base),strlen($ruta)) : "../../".substr($ruta,strlen($ruta_base),strlen($ruta));   
                   return "<link href='$ruta' type='text/css' rel='stylesheet'>";           
                }                
             }
             
             throw new Exception("La librería CSS indicada no existe");             
            
        }catch(Exception $e){
             die($e->getMessage()); 
        }
    }
    
}

    