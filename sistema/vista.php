<?php
/**
********************************************************************************************************************
* Sistema       :    ALVISS FRAMEWORK
*
* Clase         :    Vista
*
* Descripción   :    Contiene métodos para con las vistas
* 
* @author       :    Alexis Visser
*
* @version      :    1.0
*
* @name         :    vista.php
*
* Creación      :    29-12-2018
* 
* Plataforma    :    PHP
*
********************************************************************************************************************
**/

class Vista{
   
   protected static $_arrVar;    
   public $creado;
    
   public function __construct($nombre = null,$opciones = array()){
       try{
           /*
            **************************************************************************
            * tipo_vista = debería ser maestra o template
            * header     = debería ser true o false
            * menu       = debería incluir un arreglo con las páginas que se deberían visualizar
            * footer     = debería ser un true o false
            **************************************************************************
            */
           $paramdef   = array('tipo_vista','header','menu','footer');
           $parametros = array_keys($opciones);
           
           if(!in_array('tipo_vista',$paramdef)){
               $opciones['tipo_vista'] = null;
           }
           if(!in_array('header',$paramdef)){
               $opciones['header'] = false;
           }
           
           
           
          if($opciones['tipo_vista'] == "maestra"){              
              $raiz        = Convertidor::convertirEspaciosEnGuionBajo(_APP_NAME_);            
              $ruta        = $_SERVER["DOCUMENT_ROOT"]."/$raiz/"._APP_."/"._V_."/maestras/";              
              $bandera     = true;
              
              if(!file_exists($ruta)){
                 mkdir($ruta);
              }
              
              if(is_null($nombre)){
                  throw new Exception("Debe asignar un nombre a la vista");
              }
              
              $ruta_archivo = $ruta."maestra_$nombre.php";
              
              if(!file_exists($ruta_archivo)){
                  
                  $archivo = fopen($ruta_archivo,"w+");
                  
                  $estructura_base  = "<!doctype html>\r\n";
                  $estructura_base .= "<html lang=\"es\">\r\n";
                  $estructura_base .= "\t<head>\r\n";
                  $estructura_base .= "\t\t<meta charset=\"utf-8\">\r\n";
                  $estructura_base .= "\t\t<meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">\r\n";
                  $estructura_base .= "\t\t<title><?php echo strtoupper(_APP_NAME_); ?></title>\r\n";
                  $estructura_base .= "\t\t<link rel=\"shortcut icon\" type=\"image/png\" href=\"../vista/img/favicon.ico\"/>\r\n";
                  
                  if(count(Vista::cargar("css")) > 0){
                     foreach(Vista::cargar("css") as $css){
                        $estructura_base .= "\t\t$css\r\n";
                     } 
                  }                  
                  
                  $estructura_base .= "\t</head>\r\n";
                  $estructura_base .= "\t<body>\r\n";
                  
                  if($opciones['header']){
                     $estructura_base .= "\t\t<header class=\"enc-fondo enc-alt-anch\">\r\n";
                     $estructura_base .= "\t\t\t\t<div class=\"row\">\r\n";
                     for($i=0;$i<3;$i++){                          
                         $estructura_base .= "\t\t\t\t\t\t<div class=\"col-md-4\">\r\n";
                         $estructura_base .= "\t\t\t\t\t\t</div>\r\n";
                     }                      
                     $estructura_base .= "\t\t\t\t</div>\r\n";
                     $estructura_base .= "\t\t</header>\r\n";
                  }
                  
                  
                  
                  if(count(Vista::cargar("js")) > 0){
                     foreach(Vista::cargar("js") as $js){
                        $estructura_base .= "\t\t$js\r\n";
                     } 
                  }
                  
                  $estructura_base .= "\t</body>\r\n";
                  $estructura_base .= "</html>\r\n";
              
                  fputs($archivo,$estructura_base);
              
                  fclose($archivo);
                  
                  $this->creado = true;
                  
              }else{
                  
                  $this->creado = false; 
                  
              }             
          } 
       }catch(Exception $e){
           die($e->getMessage());
       }
   }
    
  /*
  *****************************************************
  * Metodo      : adherir
  * Descripción : convierte al atributo $_arrVar en un arreglo y le asigna el contenido  del parametro valor
  * @author     : Alexis Visser <alex_vaiser@hotmail.com>
  * creado      : 29-12-2018
  * @param      : $valor, $variable 
  ******************************************************
  */    
   public static function adherir($valor=null,$variable=null){
       if(is_null($variable)){
           self::$_arrVar[]          = $valor;
       }else{
           self::$_arrVar[$variable] = $valor; 
       }
   }
   
  /*
   *****************************************************
   * Metodo      : cargar
   * Descripción : obtiene los datos almacenados en el arreglo
   * @author     : Alexis Visser <alex_vaiser@hotmail.com>
   * creado      : 29-12-2018
   * @param      : $variable
   * @return     : Array
   ******************************************************
   */ 
   public static function cargar($variable=null){
       if(is_null($variable)){
          return self::$_arrVar;
       }else{
          return self::$_arrVar[$variable]; 
       }             
   } 
    
    
    public static function crear($objetoHTML,$params){
        try{
            
        }catch(Exception $e){
            die($e->getMessage());
        }
    }    
}