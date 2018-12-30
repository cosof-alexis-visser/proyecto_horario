<?php
if(!defined("_APP_NAME_")) die("No ha definido el nombre de la aplicación");
/**
********************************************************************************************************************
* Sistema       :    ALVISS FRAMEWORK
*
* Clase         :    Modelo
*
* Descripción   :    Contiene métodos predeterminados DML para la manipulacón de base de datos
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

abstract class Modelo extends BaseDatos{
    
    /*
     *****************************************************
     * Metodo      : insertar
     * Descripción : prepara los datos del arreglo e inserta una fila a la tabla indicada
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 17-12-2018
     ******************************************************
     */
    public function insertar($arrDatos,$_tabla){      
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
    
     /*
     *****************************************************
     * Metodo      : obtenerTodos
     * Descripción : obtiene todos los registros de una tabla
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 21-12-2018
     ******************************************************
     */
    public function obtenerTodos($_tabla,$_ordenar_por = null,$_orden_desc = false){        
        try{
            if(empty($_tabla)){
                throw new Exception("Debe indicar la tabla desde donde obtener los datos");
            }
            
            $query = "select * from $_tabla";
            
            if(!is_null($_ordenar_por)){
                $query .= " order by $_ordenar_por";
            }
            
            if($_orden_desc){
                $query .= " $_orden_desc";
            }
            
            $this->ejecutarConsulta($query);
            
            if($this->transaccionRealizada()){
               $obj = $this->getAllResultados();    
               return  (object) $obj; 
            }else{
               return null; 
            }            
        }catch(Exception $e){
            Mensaje::enviar($e->getMessage()); 
        }
    }
    
    /*
     *****************************************************
     * Metodo      : obtenerPorId
     * Descripción : obtiene todos los registros de una tabla
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 21-12-2018
     ******************************************************
     */
    public function obtenerPorId($_tabla,$_id){        
        try{
            if(empty($_tabla)){
                throw new Exception("Debe indicar la tabla desde donde obtener los datos");
            }
            
            if(empty($_id)){
                throw new Exception("Debe indicar el id para obtener los datos");
            }
            
            $query = "select * from $_tabla where id = ?";
            
            $param = array($_id);
            
            $this->ejecutarConsulta($query,$param);
            
            if($this->transaccionRealizada()){
               $obj = $this->getAllResultados();    
               return  (object) $obj->fila_0; 
            }else{
               return null; 
            }            
        }catch(Exception $e){
            Mensaje::enviar($e->getMessage()); 
        }
    }
}                         