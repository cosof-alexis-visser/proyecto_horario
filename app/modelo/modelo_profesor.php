<?php
/**
********************************************************************************************************************
* Sistema       :    VALPPO
*
* Clase         :    DAOProfesor
*
* Descripción   :    Contiene métodos para interactuar con la tabla tb_profesores
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    modelo_profesor.php
*
* Creación      :    16-01-2019
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/

class DAOProfesor extends Modelo{
    
    protected $_tabla = "tb_profesores";
    
    public function addProfesores($profesores){  
        //Elimina todo el contenido de la tabla profesores; no considera las relaciones con otras tablas
        $this->vaciar($this->_tabla);        
        /*
         * Registra el contenido del arreglo profesores en la tabla de profesores
         * Retorna un arreglo con información del procesamiento sí el registro se realizó con éxito
         * Retorna un FALSE sí la transacción no fue exitosa o salta alguna Excepción
         */
        return $this->insertarMultiple($profesores,$this->_tabla);
    }
}