<?php
if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");
/**
********************************************************************************************************************
* Sistema       :    ALVISS FRAMEWORK
*
* Clase         :    Mensaje
*
* Descripción   :    Contiene métodos para la emisión y recepción de mensajes
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    mensaje.php
*
* Creación      :    20-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/

class Mensaje{
    
    protected static $_mensaje;
    
    public static function enviar($mensaje){
        self::$_mensaje = $mensaje;
    }
    
    public static function recibir(){
        return self::$_mensaje;
    }
    
}