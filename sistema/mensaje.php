<?php
/**
********************************************************************************************************************
* Sistema       :    PROYECTO HORARIO
*
* Descripción   :    Contiene métodos estaticos para emitir los mensajes de éxito y fallido
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