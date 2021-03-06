<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title><?php echo strtoupper(_APP_NAME_); ?></title>
		<link rel="shortcut icon" type="image/png" href="../vista/img/favicon.ico"/>			
		<?php 
            //die(print_r(Vista::cargar("css"),true));
            foreach(Vista::cargar("css") as $css){
                echo $css;
            }
        ?> 
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" type="text/css">     
	</head>
	<body>
        <div class="contenedor">	    
            <header class="bg-color-light-grey">
                <div class="container-fluid h-100">
                   <div class="row h-100">
                       <div class="col-md-8 h-100 d-flex align-items-center">
                           <img src="../../app/vista/img/favicon.ico" alt="Logo" style="max-width:100px">
                           <h3 class="pl-3"><?php echo ucwords(strtolower(_APP_NAME_)); ?></h3>
                       </div>
                       <div class="col-md-4 h-100">                          
                          <span class="d-flex justify-content-md-end m-2 font-weight-bold"> 
                              Alexis Visser                              
                              <button type="button" id="btn_cerrar_sesion" name="btn_cerrar_sesion" class="btn btn-sm btn-danger ml-2">Cerrar Sesión</button> 
                          </span>
                       </div>
                   </div> 
                </div>
            </header>
            <main>
               <div class="container-fluid h-100">
                   <div class="row h-100">
                      <div class="col-md-2 d-none d-md-block h-100 bg-color-dark-grey">
                         <ul class="nav flex-column w-100">
                         <?php
                             foreach(Cargador::menu("templates") as $paginas){
                                  echo $paginas;
                             }                                                  
                         ?> 
                         </ul>
                      </div>
                      <div id="templates" name="templates" class="col-md-10 col-12 h-100 bg-color-white">
                          
                      </div> 
                   </div>
               </div> 
            </main>
            <footer class="bg-color-green">
                
            </footer>
        </div>
        <!-------------------------------------------------------- Aqui se carga el modal solicitado -------------------------------------------------------------------> 
        <div id="cargar_modal">
            
        </div>           
        <?php
            foreach(Vista::cargar("js") as $js){
                echo $js;
            }
        ?>       
        <script src="https://unpkg.com/ionicons@4.5.0/dist/ionicons.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>  
	</body>
</html>
