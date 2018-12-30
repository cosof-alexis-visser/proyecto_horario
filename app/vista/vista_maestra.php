<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title><?php echo strtoupper(_APP_NAME_); ?></title>
        <!-- Importación Librerías Base CSS -->
        <?php 
           foreach(Vista::getVar("css") AS $css){
              echo $css; 
           }           
        ?>   
    </head>
    <body>
        <div class="container-fluid">
            <header class="header">
               <div class="row">
                   <div class="col-md-12">
                       <span class="font-color2"><?php echo strtoupper(_APP_NAME_); ?></span>
                   </div>
               </div>
            </header>
            <main>
               <div class="row">
                   <div class="col-md-2">
                       Probando
                   </div>
                   <div class="col-md-10">
                       
                   </div>
               </div> 
            </main>
            <footer>
                
            </footer>
        </div>        
        <!-- Importación Librerías Base Javascript -->
        <?php 
            foreach(Vista::getVar("js") AS $js){
                echo $js;
            }
        ?>
    </body>
</html>