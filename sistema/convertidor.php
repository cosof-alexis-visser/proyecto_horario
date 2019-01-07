<?php
//if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");
/**
********************************************************************************************************************
* Sistema       :    ALVISS FRAMEWORK
*
* Clase         :    Convertidor
*
* Descripción   :    Contiene métodos para validación de formularios
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    convertidor.php
*
* Creación      :    29-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/
    

class Convertidor{
    /*
     *****************************************************
     * Metodo      : convertirEspaciosEnGuionBajo
     * Descripción : Transforma los espacios de un String en guiones bajos 
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 29-12-2018  
     * @param      : String $texto
     ******************************************************
     */
    public static function convertirEspaciosEnGuionBajo($texto){
        if(!is_string($texto)){
            die("El parámetro ingresado no es un string");
        }
        $texto  = trim($texto);
        $arrTxt = explode(' ',$texto);
        $strTxt = implode('_',$arrTxt);
        
        return strtolower($strTxt);
    }
    
    
    
}