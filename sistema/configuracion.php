<?php
/**
********************************************************************************************************************
* Sistema       :    PROYECTO HORARIO
*
* Descripción   :    Configuraciones del sistema
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    configuracion.php
*
* Creación      :    17-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/



const _AMBIENT_ = 'DEV'; //Mediante esta constante se define el tipo de ambiente con el que se trabajará "DESARROLLO", "PRUEBAS", "PRODUCTIVO"

// BASE DE DATOS
if(_AMBIENT_ == 'DEV'){
   define("_BD_HOST_","localhost"); //Servidor en donde se aloja la base de datos
   define("_BD_NAME_","bd_valppo"); //Nombre que recibe la base de datos a la que se conectará
   define("_BD_USER_","root"); //Usuario mysql  que se utilizará para la conexión, este puede variar en ocasiones aunque por lo general se utiliza ROOT ya que cuenta con todos los privilegios
   define("_BD_PASS_",""); // Es la contraseña del usuario de mysql para efectuar la conexion
   define("_BD_CHARSET_","utf8"); //Es la codificación de caracteres que utilizará la base de datos para aceptar acentuación en el registro de los campos
   define("_BD_MOTOR_","mysql"); //Es el motor de base de datos que se empleará
}

if(_AMBIENT_ == 'TEST'){
   define("_BD_HOST_","10.10.4.61"); //Servidor en donde se aloja la base de datos
   define("_BD_NAME_","bd_valppo"); //Nombre que recibe la base de datos a la que se conectará
   define("_BD_USER_","valppobd"); //Usuario mysql  que se utilizará para la conexión, este puede variar en ocasiones aunque por lo general se utiliza ROOT ya que cuenta con todos los privilegios
   define("_BD_PASS_","aplicacion3"); // Es la contraseña del usuario de mysql para efectuar la conexion
   define("_BD_CHARSET_","utf8"); //Es la codificación de caracteres que utilizará la base de datos para aceptar acentuación en el registro de los campos
   define("_BD_MOTOR_","mysql"); //Es el motor de base de datos que se empleará   
}

if(_AMBIENT_ == 'PROD'){
   define("_BD_HOST_","10.10.4.36"); //Servidor en donde se aloja la base de datos
   define("_BD_NAME_","bd_valppo"); //Nombre que recibe la base de datos a la que se conectará
   define("_BD_USER_","valppobd"); //Usuario mysql  que se utilizará para la conexión, este puede variar en ocasiones aunque por lo general se utiliza ROOT ya que cuenta con todos los privilegios
   define("_BD_PASS_","aplicacion3"); // Es la contraseña del usuario de mysql para efectuar la conexion
   define("_BD_CHARSET_","utf8"); //Es la codificación de caracteres que utilizará la base de datos para aceptar acentuación en el registro de los campos
   define("_BD_MOTOR_","mysql"); //Es el motor de base de datos que se empleará 
}

//CUENTA ADMINISTRADORA
const _SU_USER_    = "system"; //Es el super usuario que tendrá todos los privilegios en el sistema
const _SU_PASS_    = "administrador"; //Es la contraseña del super usuario


//OTRAS CONFIGURACIONES
const _APP_NAME_   = "valppo"; //Se define el nombre de la aplicación. Ésta debe ser la misma que la de la carpeta raíz (No importa que tenga espacios)