<?php

session_start();

const _SYS_ = "sistema";

//importe de archivos de sistema
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."configuracion.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."basedatos.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."mensaje.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."modelo.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."controlador.php";
require_once realpath(dirname(__FILE__))."/"._SYS_."/"."vista.php";

//Importe de archivos de la aplicacion
