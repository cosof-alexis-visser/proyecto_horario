<?php

session_start();

const _SYS_      = "sistema";
const _APP_      = "app";
const _V_        = "vista";
const _C_        = "controlador";
const _M_        = "modelo";


//importe de archivos de sistema
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."configuracion.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."convertidor.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."validar.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."cargador.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."basedatos.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."mensaje.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."modelo.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."controlador.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."vista.php";            

$base =  substr(dirname(__FILE__),-strripos(dirname(__FILE__),'\\')-1);
$app  =  Convertidor::convertirEspaciosEnGuionBajo(_APP_NAME_);


if($base != $app){
    die("La aplicación debe recibir el mismo nombre que el directorio base");
}


$redireccionador = new Cargador;
$redireccionador->autoloader();
