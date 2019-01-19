<div class="container">
   <h3 class="mt-2">Administración de Profesores</h3>
   <hr>
   <div class="alert" id="mensaje" style="display:none"></div>
   <div class="row">
       <div class="col-md-12">
           <button  id="btn_ver_docentes" class="btn btn-primary">
               <ion-icon name="eye"></ion-icon>
               Ver Docentes Registrados
           </button>
       </div>
   </div>
   <div class="row">
       <div class="col-md-12">
           <form id="form_load_CSV" method="post" enctype="multipart/form-data">
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
   <br><br>   
   <div class="row">
       <div class="col-md-12">
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <h4>Resultados:</h4>
                    <table border='0' cellspadding='0' cellspacing='0'>
                        <thead>
                            <tr>
                                <td width="20%" style="padding:10px" class="border"><label class=" col-form-label">Cantidad de profesores total:</label></td>
                                <td width="30%" style="padding:10px" class="border"><input type="text" id="c_prof_total" value="0" class="form-control-plaintext"></td>
                                <td width="20%" style="padding:10px" class="border"><label class=" col-form-label">Cantidad de profesores registrados:</label></td>
                                <td width="30%" style="padding:10px" class="border"><input type="text" id="c_prof_reg" value="0" class="form-control-plaintext"></td>                            
                            </tr>
                            <tr>
                                <td style="padding:10px" class="border"><label class="col-form-label">Demora de la operación:</label></td>
                                <td style="padding:10px" class="border"><input type="text" id="op_demora" value="0" class="form-control-plaintext"></td>
                                <td style="padding:10px" class="border"><label class=" col-form-label">Cantidad de errores detectados:</label></td>
                                <td style="padding:10px" class="border"><input type="text" id="c_error" value="0" class="form-control-plaintext"></td>                            
                            </tr>
                            <tr>
                                <td colspan="4" height="30px"></td>
                            </tr>
                            <tr>                                
                                <td colspan="4" align="center" style="padding:10px"><strong>Errores encontrados</strong></td>
                            </tr>
                            <tr>
                                <td style="padding:10px;text-align:center" class="border">Linea</td>
                                <td colspan="3" style="padding:10px" class="border">Detalle</td>
                            </tr>
                        </thead>
                        <tbody class="border" id="lista_errores">                           
                            <tr>
                                <td colspan="4" align="center" style="padding:10px">Sin información</td>
                            </tr>
                        </tbody>
                    </table>                    
                </div>
            </div>
       </div>
   </div>
</div>