<?php
if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");
/**
********************************************************************************************************************
* Sistema       :    ALVISS FRAMEWORK
*
* Clase         :    Controlador
*
* Descripción   :    Contiene métodos para la interaccón entre el modelo y la vista
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    controlador.php
*
* Creación      :    17-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/
abstract class Controlador{
    
    protected $cargar;
    
    public function __construct(){
        $this->cargar = new Cargador();
    }
}    