<?php







class DAOClase extends Modelo{
    protected $_tabla;
    protected $_primaria;
    
    public function __construct(){
        $this->_tabla    = "tclase";
        $this->_primaria = "id";
    }
    
    public function agregar($params){        
        try{
            
        }catch(Exception $e){
            Mensaje::enviar($e->getMessage());
        }
    }
}