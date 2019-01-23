var Cargar = {
    pagina : function(url,div_id,event){
       // event.preventDefault(); 
        $("#" + div_id).load(url);
              
    },
    modal : function(url,id_modal,ancho_modal){       
       if(!$("#" + id_modal).attr("data-building")){
           
           var i = 0;
           
           while(true){
               if(!$("#modal_body_"+i).attr("data-building"))break;
               i++;
           }      
           
           var modal_dialog  = $("<div/>",{
                                    "class":"modal-dialog modal-lg",
                                    "role" : "document",
                                    "style":"max-width:" + ancho_modal +"%; !important"
                               });
           var modal_content = $("<div/>",{"class":"modal-content"});
           var modal_header  = "";
           var modal_body    = $("<div/>",{"id":"modal_body_" + i,"class":"modal-body","data-building": true});
           var modal_footer  = "";

            //Construye div modal principal
            $("<div/>",{
                "class"           : "modal fade",
                "id"              : id_modal,
                "tabindex"        : "-1",
                "role"            : "dialog",
                "aria-labelledby" : id_modal,
                "aria-hidden"     : true,
                "data-building"   : true
            }).append(modal_dialog
              .append(modal_content
              .append(modal_header)
              .append(modal_body)
              .append(modal_footer)))          
              .appendTo("#cargar_modal");
       } 
        
      setTimeout(function(event){         
           Cargar.pagina(url,"modal_body_" + i);
       },100);
        
       setTimeout(function(event){
           $("#"+id_modal).modal();
       },150);       
        
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