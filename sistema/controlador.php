<?php
if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");

abstract class Controlador{
    
    protected $cargar;
    
    public function __construct(){
        $this->cargar = new Cargador();
    }
}    