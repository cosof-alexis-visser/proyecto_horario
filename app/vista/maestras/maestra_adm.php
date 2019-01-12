<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title><?php echo strtoupper(_APP_NAME_); ?></title>
		<link rel="shortcut icon" type="image/png" href="../vista/img/favicon.ico"/>
		<link href='../../librerias/css/bootstrap.css' type='text/css' rel='stylesheet'>
		<link href='../../librerias/css/base.css' type='text/css' rel='stylesheet'>
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
                         <ul class="nav flex-column">
                         <?php
                            $dir_app   = Convertidor::convertirEspaciosEnGuionBajo(_APP_NAME_);
                            $templates = scandir($_SERVER["DOCUMENT_ROOT"]."/".$dir_app."/app/"._V_."/templates");
                            for($i=2;$i<sizeof($templates);$i++){
                                $vista   = explode('_',$templates[$i]);                                
                                $controlador = $vista[2];
                                $metodo      = isset($vista[3]) ? substr($vista[3],0,stripos($vista[3],'.php')) : "";
                                $nombre_item = ucwords($vista[1]);
                                
                                echo "<li class='nav-item '><a class='nav-link' style='color:#FFF;font-size:24px' href='../../app/".$controlador."/".$metodo."' >".$nombre_item."</a></li>";
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
        <script src='../../librerias/js/jquery-3.3.1.min.js' type='text/javascript'></script>
		<script src='../../librerias/js/bootstrap.js' type='text/javascript'></script>
		<script src="https://unpkg.com/ionicons@4.5.0/dist/ionicons.js"></script>
		<script src='../../librerias/js/base.js' type='text/javascript'></script>
	</body>
</html>
