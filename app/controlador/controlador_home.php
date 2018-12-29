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
        Vista::setVar("css1",$this->cargar->css("bootstrap")); // A la variable "css1" Le asigno la carga del archivo css Bootstrap que posteriormente será leída por la vista maestra
        Vista::setVar("css2",$this->cargar->css("base")); // A la variable "css1" Le asigno la carga del archivo css Bootstrap que posteriormente será leída por la vista maestra
        Vista::setVar("js1",$this->cargar->js("jquery-3.3.1.min")); // A la variable "js1" Le asigno la carga del plugin js Jquery que posteriormente será leída por la vista maestra
        Vista::setVar("js2",$this->cargar->js("bootstrap"));  // A la variable "js2" Le asigno la carga del plugin js Bootstrap que posteriormente será leída por la vista maestra
        
        $this->cargar->vista("maestra");//Cargo la vista maestra en la pantalla cuando este método sea llamado
    }
}