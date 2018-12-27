<?php

abstract class Controlador{
    
    protected $cargar;
    
    public function __construct(){
        $this->cargar = new Cargador();
    }
}    