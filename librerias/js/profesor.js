$(document).ready(function(e){ 
    //Controla la información que se despliega en el input file de la carga de CSV
    $('#adjuntarCSV').on("change",function(){  
       if($(this)[0].files[0]){    
         $('#nombre_archivo').val($(this)[0].files[0]["name"]);
       }
    });    
    
    //Envía los datos para ser procesados cuando se presiona el botón cargar CSV
    $("#form_load_CSV").on("submit",function(e){
        e.preventDefault();
        
        $("#btn_cargar_csv").attr("disabled",true);
        
        setTimeout(function(){
            if(!$("#mensaje").css("display","none")){                   
                $("#mensaje").hide('slow');
            }
        },5000);        
        
        archivo = $("#adjuntarCSV")[0].files[0];        
        form    = new FormData();
        form.append("archivo",archivo);
        
        $.ajax({
            type:"post",
            contentType:false,
            dataType:'json',
            processData:false,
            cache:false,
            data: form,
            url:'../../app/profesor/cargarCSV',
            error:function(){
                
                $("#btn_cargar_csv").attr("disabled",false);
                
                if($("#mensaje").hasClass("alert-success")){                   
                    $("#mensaje").removeClass("alert-success");
                }
                
                if(!$("#mensaje").hasClass("alert-danger")){                   
                    $("#mensaje").addClass("alert-danger");
                }                
                
                $("#mensaje").html("Error de comunicación con el servidor. Favor ponerse en contacto con soporte").show("fast");
            },
            success:function(response){                
                $("#btn_cargar_csv").attr("disabled",false);
                
                if($("#mensaje").hasClass("alert-success")){
                    $("#mensaje").removeClass("alert-success");
                }
                
                if($("#mensaje").hasClass("alert-danger")){
                    $("#mensaje").removeClass("alert-danger");
                }
                
                if(response.correcto){
                    $("#form_load_CSV")[0].reset();
                    $("#mensaje").addClass("alert-success").html(response.msgCorrecto).show("fast");
                    $("#c_prof_total").val(response.totalArchivo);
                    $("#c_prof_reg").val(response.cantidad_procesado);
                    $("#op_demora").val(response.duracion);
                    $("#c_error").val(response.cantError);
                    $("#lista_errores").html("");
                    $.each(response.arrErrores,function(k,v){                        
                        $("<tr/>").append($("<td/>",{'html':v[0],'style':'padding:10px;color:#F00;text-align:center'})).append($("<td/>",{'html':v[1],'colspan':3,'style':'padding:10px;color:#F00'})).appendTo("#lista_errores");
                    })
                }
                if(response.error){
                    $("#mensaje").addClass("alert-danger").html(response.msgError).show("fast");
                }
            }
            
        })       
    });
    
    //Construye la tabla con los datos del profesor que posteriormente será consultada
    $("#btn_ver_docentes").on("click",function(e){
        e.preventDefault();
        Cargar.modal("../../app/profesor/ver","profesores",90);
        setTimeout(function(){
            $.post("../../app/profesor/listarTodos",{},function(response){
             var columnas = [{
                        title: "Código"
                      }, {
                        title: "RUT"
                      }, {
                        title: "Nombre"
                      }, {
                        title: "Apellidos"
                      }, {
                        title: "Correo 1"
                      }, {
                        title: "Correo 2"
                      }, {
                        title: "Fono 1"
                      }, {
                        title: "Fono 2"
                      }];    
               $("#listado_profesores").DataTable({
                   data    : response,
                   columns : columnas
               })
                /*$.each(response,function(k,v){
                   console.log(v.nombres) 
                })//alert(response);
                ;*/
            },'json')
        },200)
    })
    
 })