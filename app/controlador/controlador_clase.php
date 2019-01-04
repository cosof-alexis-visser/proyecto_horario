<?php
class Clase extends Controlador{
    
    public function cargarCSV(){
        $archivo =  $_FILES["fl_csv"]; //Aquí se obtiene el archivo que fue subido desde el input 
    }
}