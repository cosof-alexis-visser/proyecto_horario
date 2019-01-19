var Cargar = {
    pagina : function(url,div_id){
        event.preventDefault();
        $("#" + div_id).load(url);
    },
    modal : function(url,id_modal){
       var modal_dialog  = $("<div/>",{
                                "class":"modal-dialog",
                                "role" : "document"
                           });
       var modal_content = $("<div/>",{"class" :  "modal-content"});
       var modal_header  = "";
       var modal_body    = "";
       var modal_footer  = "";
        
        //Construye div modal principal
        $("<div/>",{
            "class"           : "modal fade",
            "id"              : id_modal,
            "tabindex"        : "-1",
            "role"            : "dialog",
            "aria-labelledby" : id_modal,
            "aria-hidden"     : true
        }).append(modal_dialog
          .append(modal_content
          .append(modal_header)
          .append(modal_body)
          .append(modal_footer)))          
          .appendTo("#cargar_modal");
        
        
        
        /*<div class="modal fade" id="form_obs2" tabindex="-1" role="dialog" aria-labelledby="form_obs" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div id="enc_modal" class="modal-header">
                        <h5 class="modal-title" id="tituloMensaje">RETIRO DE INSUMOS</h5>               
                    </div>
                    <div class="modal-body">
                        <form>
                            <label for="txt_observacion2" class="">Observación</label>
                            <textarea id="txt_observacion2" class="form-control" rows="5"></textarea>
                        </form>
                    </div>
                    <div class="modal-footer">  
                        <button type="button" id="enviar_obs2" class="btn" data-dismiss="modal">Enviar</button>
                        <button type="button" id="omitir_obs2" class="btn" data-dismiss="modal">Omitir</button>                             
                    </div>
                </div>
            </div>        
        </div>*/
    }
}

$(document).ready(function(e){    
    $(".nav-link").on("click",function(e){
        e.preventDefault();        
        Cargar.pagina($(this).attr("href"),"templates");
        $(".nav-link").parent().each(function(k,v){            
            $("#"+v.id).removeClass("active"); 
        }) 
        $(this).parent().addClass("active");         
    })    
})