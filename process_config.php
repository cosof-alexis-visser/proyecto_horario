<?php

    $mensaje_success = "";
    $mensaje_error   = "";

     const _SYS_      = "sistema";
     const _APP_      = "app";
     const _V_        = "vista";
     const _C_        = "controlador";
     const _M_        = "modelo";

     require_once realpath(dirname(__FILE__))."/sistema/configuracion.php";
     require_once realpath(dirname(__FILE__))."/sistema/validar.php";
     require_once realpath(dirname(__FILE__))."/sistema/convertidor.php";
     require_once realpath(dirname(__FILE__))."/sistema/cargador.php";
     require_once realpath(dirname(__FILE__))."/sistema/vista.php";
     

     $v_nombre = isset($_POST["txt_nombre_vista"]) ? $_POST["txt_nombre_vista"] : "";
     $v_tipo   = isset($_POST["cbx_tipo_vista"])   ? $_POST["cbx_tipo_vista"]   : "";
     $v_header = isset($_POST["chk_header"])       ? $_POST["chk_header"]       : "";
     
     if(!empty($v_nombre) && !empty($v_tipo)){
         
         $cargar = new Cargador; //Se crear un nuevo cargador para cargar las librerías
         
         //Se prepara el listado de CSS
         $css = array(
            $cargar->css("bootstrap"),
            $cargar->css("base")
         );
         
         //Se prepara el listado de JS
         $js  = array(
            $cargar->js("jquery-3.3.1.min"),
            $cargar->js("bootstrap")  
         ); 
         
         Vista::adherir($css,"css"); //Se añaden las librerías indicadas en el arreglo $CSS 
         Vista::adherir($js,"js"); //Se añaden las librerías indicadas en el arreglo $JS
         
         //Se setean las opciones
         $arrOpciones = array(
             "tipo_vista" => $v_tipo,
             "header"     => $v_header
         );  
         
         
         $vista = new Vista($v_nombre,$arrOpciones); //Intenta crear la nueva vista en base a las opciones indicadas
         
         //Valida sí la vista seleccionada es maestra         
         if($v_tipo == "maestra"){
             if($vista->creado && file_exists(realpath(dirname(__FILE__))."/app/vista/maestras/maestra_$v_nombre.php")){
                 $mensaje_success = "La vista se ha creado con éxito"; 
             }

             if(!$vista->creado && file_exists(realpath(dirname(__FILE__))."/app/vista/maestras/maestra_$v_nombre.php")){
                 $mensaje_error = "La vista que intenta crear ya existe";
             }
         }
         
         
         //Verifica sí hay mensaje de éxito
         if($mensaje_success != ""){
             $msg = "<div class=\"alert alert-success\">$mensaje_success</div>";
         }
         
         //Verifica sí hay mensaje de error
         if($mensaje_error != ""){
             $msg = "<div class=\"alert alert-danger\">$mensaje_error</div>";
         }
         
         //Crea una vista dinámica que posteriormente se mostrará con los resultados
         $HTML = "<!doctype html>   
                 <html lang=\"es\">
                     <head>
                        <meta charset=\"utf-8\">
                        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
                        <title>PROCESS CONFIG ALVISS FRAMEWORK</title>
                        <link href=\"librerias/css/bootstrap.css\" type=\"text/css\" rel=\"stylesheet\">
                    </head>
                    <body>
                         <div class=\"container\">
                            <div class=\"row justify-content-center mt-5\">
                            $msg
                            </div>                  
                         </div> 
                    <script type=\"text/javascript\">
                        setTimeout(function(){
                         location.href = \"sys_config.php\";                         
                        },5000);                        
                    </script>
                    </body>
                  </html>";
         
         echo $HTML; //Muestra la vista
         
     }