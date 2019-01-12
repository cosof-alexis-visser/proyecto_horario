var Cargar = {
    pagina : function(url,div_id){
        event.preventDefault();
        $("#" + div_id).load(url);
    }
}

$(document).ready(function(e){    
    $(".nav-link").on("click",function(e){
        e.preventDefault();        
        Cargar.pagina($(this).attr("href"),"templates");
    })    
})