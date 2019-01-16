<?php

class Profesor extends Controlador{
    
    public function __construct(){
        parent::__construct(); //Construye un controlador padre       
    }    
    
    public function index(){ 
        $javascript = array(
            $this->cargar->js("profesor")
        );
        
        foreach($javascript as $js){
            echo $js;
        }
        
        $this->cargar->vista("03_school_profesores_profesor_");
    }
    
    public function cargarCSV(){
        $error       = false;
        $correcto    = false;
        $msgCorrecto = "";
        $msgError    = "";
        
        if(isset($_FILES["archivo"])){            
            $archivo     = $_FILES["archivo"];
            $extension   = explode('.',$archivo["name"]);
            $extension   = $extension[sizeof($extension)-1]; //detecta la última celda del arreglo y entrega la información de la extensión
            $extensiones = array("csv");
        
            if(!in_array($extension,$extensiones)){
               $error    = true;
               $msgError = "La extensión del archivo debe ser csv";    
            }             
            
            $archivo    = fopen($archivo["tmp_name"],'r'); //Abre el archivo en modo sólo lectura
            $profesores = array();            
            
            while(($datos = fgetcsv($archivo,100000,';')) == true){
                
                $profesor["codigo"]    = $datos[0];                
                $profesor["rut"]       = $datos[1];
                $profesor["nombres"]   = $datos[2];
                $profesor["apellidos"] = $datos[3];
                $profesor["correo1"]   = $datos[4];
                $profesor["correo2"]   = $datos[5];
                $profesor["fono1"]     = $datos[6];
                $profesor["fono2"]     = $datos[7];
                
                if(!empty($profesor["codigo"])){
                    $profesores[] = $profesor;
                }
            }
            
        }else{
            $error    = true;
            $msgError = "Debe cargar un archivo csv";
        }
        
        $salida = array("error"=>$error,"success"=>$correcto,"msgError"=>$msgError,"msgSuccess"=>$msgCorrecto);
        $json   = json_encode($salida);
        echo $json;
    }
}