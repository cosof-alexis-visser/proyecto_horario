<?php
/**
********************************************************************************************************************
* Sistema       :    PROYECTO HORARIO
*
* Descripción   :    Configuraciones del sistema
* 
* @author       :    Jose Castillo F. - Alexis Visser
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

// BASE DE DATOS

const _BD_HOST_    = "localhost"; //Servidor en donde se aloja la base de datos
const _BD_NAME_    = ""; //Nombre que recibe la base de datos a la que se conectará
const _BD_USER_    = "root"; //Usuario mysql  que se utilizará para la conexión, este puede variar en ocasiones aunque por lo general se utiliza ROOT ya que cuenta con todos los privilegios
const _BD_PASS_    = ""; // Es la contraseña del usuario de mysql para efectuar la conexion
const _BD_CHARSET_ = "utf8"; //Es la codificación de caracteres que utilizará la base de datos para aceptar acentuación en el registro de los campos
const _BD_MOTOR_   = "mysql"; //Es el motor de base de datos que se empleará

//CUENTA ADMINISTRADORA

const _SU_USER_    = "system"; //Es el super usuario que tendrá todos los privilegios en el sistema
const _SU_PASS_    = "administrador"; //Es la contraseña del super usuario


//OTRAS CONFIGURACIONES
