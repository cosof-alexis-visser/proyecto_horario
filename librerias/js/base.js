var Cargar = {
    pagina : function(url,div_id){        
        $("#" + div_id).load(url);
    }
}

$(document).ready(function(e){ 
    $("#item_menu_01").addClass("active");
    setTimeout(function(){$("#item_menu_01").children().trigger("click")},100);    
    
    $(".nav-link").on("click",function(e){
        e.preventDefault();        
        Cargar.pagina($(this).attr("href"),"templates");
        $(".nav-link").parent().each(function(k,v){           
            $("#"+v.id).removeClass("active");
        })
        $(this).parent().addClass("active");
        //$(this).trigger("click");
    })    
})