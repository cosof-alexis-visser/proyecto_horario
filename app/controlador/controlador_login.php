<?php

class Login extends Controlador{
    
    protected $_modeloUsuario;
    
    public function __construct(){
        parent::__construct();
        $this->_modeloUsuario = $this->cargar->modelo("sala");
    }
    
    public function index(){
        echo "hola mundo";
    }
}