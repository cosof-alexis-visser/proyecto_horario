<?php
if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");

abstract class Vista{
   
    protected static $_arrVar;
    
    
   public static function asignar($variable=null,$valor=null){
       self::$_arrVar[$variable] = $valor;       
   }
   
   public static function getVar($variable){
       return self::$_arrVar[$variable];      
   }    
}