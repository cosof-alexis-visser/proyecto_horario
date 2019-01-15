<div class="container">
   <h1 class="mt-2">Administrar Profesores</h1>
  
   <div class="form-row justify-content-md-center mt-5">
       <div class="col-md-8">      
          <div class="custom-file">
            <label class="custom-file-label" for="adjuntarCSV">
            <input type="file" class="custom-file-input" id="adjuntarCSV" aria-describedby="adjuntarCSV">
            <input class="custom-file-label w-100"  id="nombre_archivo" value="Cargar datos del profesor">
            </label>          
          </div>
       </div>
   </div>
   <div class="form-row justify-content-md-center mt-2">
       <div class="col-md-8">
           <button class="btn btn-primary w-100">Cargar CSV</button>
       </div>
   </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#adjuntarCSV').on("change",function(){  
          if($(this)[0].files[0]){    
            $('#nombre_archivo').val($(this)[0].files[0]["name"]);
          }
        })
    })
</script>
