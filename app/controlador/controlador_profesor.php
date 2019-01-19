<?php

class Profesor extends Controlador{
    
    protected $_DAOProfesor;
    
    
    public function __construct(){
        parent::__construct(); //Construye un controlador padre 
        
        $this->_DAOProfesor = $this->cargar->modelo("DAOprofesor");
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
    
    public function listar(){
        $javascript = array(
            $this->cargar->js("profesor")
        );
        foreach($javascript as $js){
            echo $js;
        }
        $this->cargar->vista("05_school_profesores-registrados_profesor_listar");
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
            $linea       = 0;
            $item        = 0;
            $extensiones = array("csv");
            $profesores  = array();
            $mensajes    = array(
                "No contiene código",
                "No contiene rut",
                "No contiene Nombres",
                "No contiene apellidos",
                "No contiene a lo menos 1 correo"
            );
            
           
            if(!in_array($extension,$extensiones)){
               $error    = true;
               $msgError = "La extensión del archivo debe ser csv";    
            }
            
            if(!$error){
                
                $archivo    = fopen($archivo["tmp_name"],'r'); //Abre el archivo en modo sólo lectura                          
                
                while(($datos = fgetcsv($archivo,100000,';')) == true){
                    
                    $bandera = true;
                    
                    //Valida que los datos obtenidos sean mayor o igual a 8 celdas (codigo,rut,nombres,apellidos,correo1,correo2,fono1,fono2)
                    if(sizeof($datos) >= 8){                        
                        //Valida que a lo menos las primeras 5 celdas contengan información
                        for($i=0;$i<5;$i++){
                           if(empty($datos[$i])){
                               $item++;
                               $errorLinea[$item][] = ($linea + 1);
                               $errorLinea[$item][] = $mensajes[$i];
                               $bandera = false;
                               break;
                           } 
                        }                  
                       
                        //Sí bandera es True entonces se crea el arreglo profesor y se asigna a una de las celdas del arreglo profesores
                        if($bandera){
                            $profesor["cod_profesor"] = $datos[0];                
                            $profesor["rut"]          = $datos[1];
                            $profesor["nombres"]      = $datos[2];
                            $profesor["apellidos"]    = $datos[3];
                            $profesor["correo1"]      = $datos[4];
                            $profesor["correo2"]      = $datos[5];
                            $profesor["fono1"]        = $datos[6];
                            $profesor["fono2"]        = $datos[7];                
                            $profesores[]             = $profesor;
                        }                        
                    } 
                    
                    $linea++;
                }
                
                $agregados = $this->_DAOProfesor->addProfesores($profesores);
                
                if($agregados !== false){
                    $correcto    = true;
                    $msgCorrecto = "Registros realizados con éxito";
                    foreach($agregados as $k=>$v){
                        $salida[$k] = $v;
                    }                    
                }
            }           
            
        }else{
            $error    = true;
            $msgError = "Debe cargar un archivo csv";
        }
        
        $salida["error"]        = $error;
        $salida["correcto"]     = $correcto;
        $salida["msgError"]     = $msgError;
        $salida["msgCorrecto"]  = $msgCorrecto;
        
        if(isset($errorLinea)){
            $salida["arrErrores"]   = $errorLinea;
            $salida["cantError"]    = count($errorLinea);
            $salida["totalArchivo"] = count($errorLinea) + count($profesores);
        }     
                  
        $json   = json_encode($salida);
        echo $json;
    }
}