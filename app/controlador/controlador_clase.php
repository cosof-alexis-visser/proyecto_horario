<?php
class Clase extends Controlador{
    
    public function index(){
        $this->cargar->vista("02_clases_clase_");
    }
    
    public function cargarCSV(){
        $archivo =  $_FILES["fl_csv"]; //Aquí se obtiene el archivo que fue subido desde el input 
    }
}