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
        if(!is_array($arrDatos)){
           die("Debe ingresar un arreglo de datos en el primer parámetro");  
        }

        if(count($arrDatos) == 0){
           die("El primer parámetro debe ser un arreglo que contenga datos"); 
        }

        if(array_keys($arrDatos) === range(0,count($arrDatos) - 1)){
           die("El primer parámetro debe ser un arreglo asociativo"); 
        }

        if(empty($_tabla)){
            die("Debe definir el nombre de la tabla en el segundo parámetro");
        }

        if(!is_string($_tabla)){
            die("El segundo parámetro debe ser una cadena");
        }         

        $claves      = array_keys($arrDatos);
        $valores     = array_values($arrDatos);        
        $str_claves  = implode(',',$claves);
        $arrValores  = array();

        foreach($arrDatos as $valor){
            array_push($arrValores, '?');
        }

        $strValores  = implode(',',$arrValores);

        $query = "insert into $_tabla($str_claves) values($strValores)";

        $this->ejecutarConsulta($query,$valores);

        if($this->transaccionRealizada()){
            Mensaje::enviar("La operación se ha realizado con éxito");
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
                   
        $inicio     = microtime(true);
        $claves     = null;
        $str_claves = null;
        $query      = "insert into $_tabla";
        $bandera    = true;
        $contar     = 0;            
        $valores    = array();

        foreach($arrDatos as $fila){

            if(!is_array($fila)){
               die("El primer parámetro debe ser un arreglo que contenga datos"); 
            }
            if(array_keys($fila) === range(0,count($fila) - 1)){
               die("El arreglo ingresado no contiene arreglos asociativos"); 
            }



            $claves      = is_null($claves)     ? array_keys($fila)    : $claves;

            $str_claves  = is_null($str_claves) ? implode(',',$claves) : $str_claves;
            $arrValores  = array();

            foreach((array) $fila as $valor){
                array_push($arrValores, '?');
                $valores[] = $valor;
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

        $final  = microtime(true);
        $tiempo = round($final - $inicio,2); 

        if($this->transaccionRealizada()){
            return array(
                "duracion"           => $tiempo.' seg',
                "cantidad_procesado" => count($arrDatos)
            );
        }else{
            return false;
        }          
    }  
    
     /*
     *****************************************************
     * Metodo      : obtenerPor
     * Descripción : obtiene todos los registros filtrados por algún campo
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 21-12-2018
     ******************************************************
     */
    public function obtenerPor($arrCampo,$_tabla,$_ordenar_por = null,$_orden_desc = false){        
        
        if(empty($_tabla)){
           die("Debe indicar la tabla desde donde desea obtener los datos");
        }

        if(!is_array($arrCampo)){
           die("El primer parámetro debe ser un arreglo de datos"); 
        }

        if(count($arrCampo) > 1 and count($arrCampo) == 0){
            die("El primer parámetro debe contener una celda");
        }

        if(array_keys($arrCampo) === range(0,count($arrCampo) - 1)){
           die("El primer parámetro debe ser un arreglo asociativo"); 
        }

        $_key  = array_keys($arrCampo);


        $query = "select * from $_tabla where $_key = ?";

        if(!is_null($_ordenar_por)){
            $query .= " order by $_ordenar_por";
        }

        if($_orden_desc){
            $query .= " desc";
        }
        $param = array_values($arrCampo);

        $this->ejecutarConsulta($query);

        if($this->transaccionRealizada()){                           
          return  $this->getAllResultados();                       
        }else{
           return null; 
        }            
        
    }
    
    /*
     *****************************************************
     * Metodo      : obtenerTodos
     * Descripción : obtiene todos los registros de la tabla señalada
     * @author     : Alexis Visser <alex_vaiser@hotmail.com>
     * creado      : 21-12-2018
     ******************************************************
     */
    public function obtenerTodos($_tabla,$_ordenar_por = null,$_orden_desc = false){        
        
        if(empty($_tabla)){
            die("Debe indicar la tabla desde donde obtener los datos");
        }          

        $query = "select * from $_tabla";

        if(!is_null($_ordenar_por)){
            $query .= " order by $_ordenar_por";
        }

        if($_orden_desc){
            $query .= " desc";
        }            

        $this->ejecutarConsulta($query);

        if($this->transaccionRealizada()){
           return $this->getAllResultados(); 
        }else{
           return null; 
        }            
        
    }
    
    public function vaciar($_tabla){
        try{
           if(empty($_tabla)){
                throw new Exception("Debe indicar la tabla desde donde obtener los datos");
            } 
            
            $query = "SET FOREIGN_KEY_CHECKS = 0; TRUNCATE table $_tabla; SET FOREIGN_KEY_CHECKS = 1;";
            
            $this->ejecutarConsulta($query);
            
            if($this->transaccionRealizada()){
                Mensaje::enviar("La transacción se ha realizado con éxito");
            }
        }catch(Exception $e){
             Mensaje::enviar($e->getMessage()); 
        }
    }
    
    
    
    
    
    
    
}                         