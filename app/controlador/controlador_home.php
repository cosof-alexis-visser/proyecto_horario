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
        $css = array(
           $this->cargar->css("bootstrap"),
           $this->cargar->css("base")    
        );
        $js = array(
           $this->cargar->js("jquery-3.3.1.min"),
           $this->cargar->js("bootstrap")
        );
        
        Vista::adherir($css,"css"); 
        Vista::adherir($js,"js");         
        
        $this->cargar->vista("maestra");
    }
}