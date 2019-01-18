<div class="container">
   <h3 class="mt-2">Administración de Profesores</h3>
   <hr>
   <div class="alert" id="mensaje" style="display:none"></div>
   <div class="row">
       <div class="col-md-12">
           <form id="form_load_CSV" action="" method="post" enctype="multipart/form-data">
               <div class="form-row justify-content-md-center mt-5">
                   <div class="col-md-8">      
                      <div class="custom-file">
                        <label class="custom-file-label" for="adjuntarCSV">
                        <input type="file" class="custom-file-input" id="adjuntarCSV" name="adjuntarCSV" aria-describedby="adjuntarCSV">
                        <input class="custom-file-label w-100"  id="nombre_archivo" value="Cargar datos del profesor">
                        </label>          
                      </div>
                   </div>
               </div>
               <div class="form-row justify-content-md-center mt-2">
                   <div class="col-md-8">
                       <button id="btn_cargar_csv" class="btn btn-primary w-100">Cargar CSV</button>
                   </div>
               </div>
           </form>
       </div>
   </div>
   <hr>
   <div class="row">
       <div class="col-md-10">
            <div class="row justify-content-md-center">
                <div class="col-md-12 border">
                    <h4>Reporte:</h4>
                    <form class="form-inline">
                        <div class="form-group row">                            
                            <label class="col-md-4 col-form-label">Cantidad de profesores total:</label>
                            <div class="col-md-8">                        
                                <input type="text" id="c_prof_total" value="" class="form-control-plaintext"> 
                            </div>
                        </div>
                        <div class="form-group row">                            
                            <label class="col-md-4 col-form-label">Cantidad de profesores registrados:</label>   
                            <div class="col-md-8">                     
                                <input type="text" id="c_prof_reg" value="" class="form-control-plaintext"> 
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
       </div>
   </div>
</div>