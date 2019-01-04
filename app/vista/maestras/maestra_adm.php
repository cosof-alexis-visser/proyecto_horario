<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title><?php echo strtoupper(_APP_NAME_); ?></title>
		<link rel="shortcut icon" type="image/png" href="../vista/img/favicon.ico"/>
		<?php
				foreach(Vista::cargar("css") as $css){
						 echo $css; 
				} 
		?> 
	</head>
	<body>
	    <header class="enc-fondo enc-alt-anch">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 p-2">                        
                        <img src="../vista/img/favicon.ico" width="100px" height="100px" class="float-left">
                        <span>	                
                            <h2 class="pt-4 ml-3 float-left"><?php echo strtoupper(_APP_NAME_); ?></h2>
                        </span>
                    </div>
                </div>
	        </div>
	    </header>
		<?php
				foreach(Vista::cargar("js") as $js){
						 echo $js; 
				} 
		?> 
	</body>
</html>
