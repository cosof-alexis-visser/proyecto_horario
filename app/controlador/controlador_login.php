<?php
/**
********************************************************************************************************************
* Sistema       :    PROYECTO HORARIO
*
* Descripción   :    Controlador encargado de direccionar y validar una sesión iniciada de un usuario
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    controlador_login.php
*
* Creación      :    27-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/
class Login extends Controlador{
    
    protected $_modeloUsuario;
    
    public function __construct(){
        parent::__construct(); //Construyo un objeto padre
        
        //$this->_modeloUsuario = $this->cargar->modelo("usuario"); //Construyo un usuario
        
    }
    
    public function index(){
        echo "hola mundo";
    }
}