<?php
if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");
/**
********************************************************************************************************************
* Sistema       :    ALVISS FRAMEWORK
*
* Clase         :    Validar
*
* Descripción   :    Contiene métodos para validación de formularios
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    validar.php
*
* Creación      :    29-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/
class Validar{
    /*
     *****************************************************
     * Metodo      : existeUrl
     * Descripción : Método encargado de verificar sí existe una ruta
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 26-12-2018 
     * @param      : String $nombre     
     ******************************************************
     */
    public static function existeURL($url){
       $archivo = @fopen($url, "r");
       if ($archivo == false){
            return false;       
       }
       fclose($archivo);
       return true;
    }
}