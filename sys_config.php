<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>SYS CONFIG ALVISS FRAMEWORK</title>
		<link href="librerias/css/bootstrap.css" type="text/css" rel="stylesheet">
    </head>
    <body>
         <div class="container">
             <h1>Configuraciones del sistema</h1>
             <hr class="mt-4 mb-4">             
             <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <h3>Creación de vistas</h3>
                    <p>En este apartado se crean las vistas con las estructuras básicas del html.<br>
                       Incluye las librerías Bootstrap 4 y Jquery 3.3.1 para las vistas maestras</p>
                    <form id="form_vista" action="process_config.php" method="post">
                        <input type="hidden" id="accion" value="vista">            
                        <div class="form-row mt-1">
                            <label for="txt_nombre_vista" class="col-md-2">Nombre: <span class="text-danger">(*)</span></label>
                            <div class="col-md-10">
                                <input type="text" id="txt_nombre_vista" name="txt_nombre_vista" placeholder="Ingrese el nombre de la vista" class="form-control"> 
                                <span class="msg-error d-none"></span>                               
                            </div>
                            
                        </div>
                        <div class="form-row mt-1">
                            <label for="cbx_tipo_vista" class="col-md-2">Tipo: <span class="text-danger">(*)</span></label>
                            <div class="col-md-10">
                                <select id="cbx_tipo_vista" name="cbx_tipo_vista" class="form-control">
                                    <option value="">seleccione</option>
                                    <option value="maestra">maestra</option>
                                    <option value="template">template</option>
                                </select>
                                <span class="msg-error d-none"></span>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="true" id="chk_header" name="chk_header">
                                <label class="form-check-label" for="chk_header">Agregar encabezado</label>
                            </div>
                        </div>
                        <div class="form-row justify-content-end">
                            <button class="btn btn-primary mt-2">Crear</button>
                        </div>
                    </form>
                    <script type="text/javascript" src="librerias/js/jquery-3.3.1.min.js"></script>
                    <script type="text/javascript">
                        
                        function validarCompleto(obj,mensaje){
                            if($(obj).val() == ""){
                               $(obj).addClass('border border-danger'); 
                               $(obj).parent().find("span.msg-error").removeClass("d-none").addClass("text-danger").html(mensaje);
                               return false;
                            }
                            $(obj).removeClass('border border-danger'); 
                            $(obj).parent().find("span.msg-error").addClass("d-none").removeClass("text-danger").html();
                            return true;
                        }
                        
                        $(document).ready(function(e){
                            $("#form_vista").on("submit",function(e){
                                e.preventDefault();
                                if(validarCompleto("#txt_nombre_vista","Debe completar este campo") &&
                                   validarCompleto("#cbx_tipo_vista","Debe completar este campo")){
                                   setTimeout(function(){$("#form_vista")[0].submit()},100);
                                }
                            })
                            
                        })
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>
    