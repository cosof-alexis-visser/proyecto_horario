<?php
/**
********************************************************************************************************************
* Sistema       :    PROYECTO HORARIO
*
* Descripción   :    Contiene métodos propios para interactuar con la base de datos
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    modelo.php
*
* Creación      :    17-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/

require_once("basedatos.php");

class Modelo extends BaseDatos{
    
    /*
     *****************************************************
     * Metodo      : insertar
     * Descripción : prepara los datos del arreglo e inserta una fila a la tabla indicada
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 17-12-2018
     ******************************************************
     */
    public function insertar($arrDatos,$_tabla){
       require_once("mensaje.php");
       try{        
            if(!is_array($arrDatos)){
               throw new Exception("Debe ingresar un arreglo de datos en el primer parámetro");  
            }
            
            if(count($arrDatos) == 0){
               throw new Exception("El primer parámetro debe ser un arreglo que contenga datos"); 
            }
           
            if(array_keys($arrDatos) === range(0,count($arrDatos) - 1)){
               throw new Exception("El primer parámetro debe ser un arreglo asociativo"); 
            }
            
            if(empty($_tabla)){
                throw new Exception("Debe definir el nombre de la tabla en el segundo parámetro");
            }
            
            if(!is_string($_tabla)){
                throw new Exception("El segundo parámetro debe ser una cadena");
            }         
           
            $claves      = array_keys($arrDatos);
            $valores     = array_values($arrDatos);        
            $str_claves  = implode(',',$claves);
            $arrValores  = array();

            foreach((array) $arrDatos as $valor){
                array_push($arrValores, '?');
            }

            $strValores  = implode(',',$arrValores);

            $query = "insert into $_tabla($str_claves) values($strValores)";
            
            $this->ejecutarConsulta($query,$valores);
           
            if($this->transaccionRealizada()){
                Mensaje::enviar("La operación se ha realizado con éxito");
            }
           
       }catch(Exception $e){
           Mensaje::enviar($e->getMessage());
       }
        
    }
    
    /*
     *****************************************************
     * Metodo      : insertarMultiple
     * Descripción : prepara los datos del arreglo e inserta multiples registros
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 18-12-2018
     ******************************************************
     */
    public function insertarMultiple($arrDatos,$_tabla){
        require_once("mensaje.php");
        try{ 
           if(!is_array($arrDatos)){
               throw new Exception("Debe ingresar un arreglo de datos en el primer parámetro");  
           } 
           
            if(count($arrDatos) == 0){
               throw new Exception("El primer parámetro debe ser un arreglo que contenga datos"); 
            }
            
            if(empty($_tabla)){
                throw new Exception("Debe definir el nombre de la tabla en el segundo parámetro");
            }
            
            if(!is_string($_tabla)){
                throw new Exception("El segundo parámetro debe ser una cadena");
            }
            
            $claves     = null;
            $str_claves = null;
            $query      = "insert into $_tabla";
            $bandera    = true;
            $contar     = 0;
            $valores    = array();
            
            foreach($arrDatos as $fila){
                
                if(!is_array($fila)){
                   throw new Exception("El primer parámetro debe ser un arreglo que contenga datos"); 
                }
                if(array_keys($fila) === range(0,count($fila) - 1)){
                   throw new Exception("El arreglo ingresado no contiene arreglos asociativos"); 
                }
                
                $tmp = implode(',',array_values($fila));
                
                array_push($valores,$tmp);
                
                $claves      = is_null($claves)     ? array_keys($fila)    : $claves;
                        
                $str_claves  = is_null($str_claves) ? implode(',',$claves) : $str_claves;
                $arrValores  = array();
                
                foreach((array) $fila as $valor){
                    array_push($arrValores, '?');
                }
                
                $strValores  = implode(',',$arrValores);
                
                if($bandera){
                    $query .= "($str_claves) values";
                    $bandera = false;
                }
                
                if($contar > 0){
                    $query .= ',';
                }else{
                    $contar++;
                }                    
                $query .= "($strValores)";
            } 
            
            $this->ejecutarConsulta($query,$valores);
            
            if($this->transaccionRealizada()){
                Mensaje::enviar("La operación se ha realizado con éxito");
            }
            
        }catch(Exception $e){
           Mensaje::enviar($e->getMessage()); 
        }    
    }    
    
    
}

    
    
//Ejemplo de insert
$arr = array(
    array(
      "tipo" => "probando1"  
    ),
    array(
      "tipo" => "probando2"  
    ),
    array(
      "tipo" => "probando3"  
    )
);

$m = new Modelo;

$m->insertarMultiple($arr,"tb_clasificaciones_insumo");

echo Mensaje::recibir();