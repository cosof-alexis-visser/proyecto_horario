<?php
/**
********************************************************************************************************************
* Sistema       :    PROYECTO HORARIO
*
* Descripción   :    Controlador encargado de mostrar pantalla de entrada de sesión al usuario, combina varias plantillas para mostrar la vista inicial
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    controlador_home.php
*
* Creación      :    27-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/

class Home extends Controlador{  
    
    public function __construct(){
        parent::__construct(); //Construye un controlador padre       
    }
    
    public function index(){
        $this->cargar->vista("adm");
    }
}