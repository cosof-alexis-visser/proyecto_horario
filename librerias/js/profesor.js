



$(document).ready(function(e){    
    $('#adjuntarCSV').on("change",function(){  
       if($(this)[0].files[0]){    
         $('#nombre_archivo').val($(this)[0].files[0]["name"]);
       }
    }) 
    
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
                alert(response.totalArchivo)
                $("#btn_cargar_csv").attr("disabled",false);
                
                if($("#mensaje").hasClass("alert-success")){
                    $("#mensaje").removeClass("alert-success");
                }
                
                if($("#mensaje").hasClass("alert-danger")){
                    $("#mensaje").removeClass("alert-danger");
                }
                
                if(response.correcto){
                    
                    $("#mensaje").addClass("alert-success").html(response.msgCorrecto).show("fast");
                    $("#c_prof_total").val(response.totalArchivo);
                    $("#c_prof_reg").val(response.cantidad_procesado);
                    console.log(response);
                }
                if(response.error){
                    $("#mensaje").addClass("alert-danger").html(response.msgError).show("fast");
                }
            }
            
        })       
    })
 })