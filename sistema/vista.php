<?php
if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");
/**
********************************************************************************************************************
* Sistema       :    ALVISS FRAMEWORK
*
* Clase         :    Vista
*
* Descripción   :    Contiene métodos para con las vistas
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    vista.php
*
* Creación      :    29-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/

abstract class Vista{
   
   protected static $_arrVar;
    
  /*
  *****************************************************
  * Metodo      : adherir
  * Descripción : convierte al atributo $_arrVar en un arreglo y le asigna el contenido  del parametro valor
  * @author     : Alexis Visser <alex_vaiser@hotmail.com>
  * creado      : 29-12-2018
  * @param      : $valor, $variable 
  ******************************************************
  */    
   public static function adherir($valor=null,$variable=null){
       if(is_null($variable)){
           self::$_arrVar[]          = $valor;
       }else{
           self::$_arrVar[$variable] = $valor; 
       }
   }
   
  /*
   *****************************************************
   * Metodo      : getVar
   * Descripción : obtiene los datos almacenados en el arreglo
   * @author     : Alexis Visser <alex_vaiser@hotmail.com>
   * creado      : 29-12-2018
   * @param      : $variable
   * @return     : Array
   ******************************************************
   */ 
   public static function getVar($variable=null){
       if(is_null($variable)){
          return self::$_arrVar;
       }else{
          return self::$_arrVar[$variable]; 
       }             
   }    
}