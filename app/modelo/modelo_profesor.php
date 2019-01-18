<?php







class DAOProfesor extends Modelo{
    
    protected $_tabla = "tb_profesores";
    
    public function addProfesores($profesores){
        
        return $this->insertarMultiple($profesores,$this->_tabla);
        
    }
}