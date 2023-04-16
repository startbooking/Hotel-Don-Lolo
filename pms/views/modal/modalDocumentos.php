<div class="modal fade bs-example-modal-lg" id="myModalDocumentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-user-plus"></i> Documentos Huesped</h4>
        <input type="hidden" name="txtIdHuespedDoc" id="txtIdHuespedDoc">

        <div class="container-fluid" ></div>
        <div class="modal-body" id="muestraImagenes" style="height: 350px;overflow: auto;">
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <a
              data-toggle="modal" 
              data-target="#myModalSubirDocumento" 
              class="btn btn-success"  
              align="right"
            >
            <i class="fa fa-upload"></i> Importar</a> 
          </div>        
        </div>
      </div>
    </div> 
  </div>
</div>

<div class="modal fade" id="myModalSubirDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 id="myModalTitle">Adicionar Documentos</h4>
        <input type="hidden" name="txtIdHuespedUpl" id="txtIdHuespedUpl">
      </div>
 
      <form method="POST" name="uploadFiles" id="uploadFiles" style='padding:0' enctype="multipart/form-data" action='javascript:subirArchivos()'>
        <div class="modal-body">
          <div class="container-fluid">
            <label>Seleccione los archivos</label>
            <input type="file" name="images[]" id="imgSelect" multiple class='form-control' accept='.jpg' style="min-height: 50px">
          </div>
          <div class="message"></div>
          <div style="margin-top:15px">
            <h4>Archivos Seleccionados</h4>
            <div class="container-fluid" id='form_fotos' style="text-align: center;padding:0;max-height: 318px;overflow: auto;"></div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row-fluid">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-success" align="right"><i class="fa fa-save"></i> Procesar</button>
          </div>
          <script>
            $("#imgSelect").change(function () {
                filePreview(this);
            });
          </script>     
        </div>
      </form>
    </div>
  </div>  
</div>

<div class="modal fade bs-example-modal-lg" id="myModalMuestraDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-user-plus"></i> Documentos Huesped</h4>
        <div class="container-fluid" ></div>
        <div class="modal-body">
          <img id="muestraDocumento" src="" alt="" style="width: 100%">
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <!-- <button class="btn btn-success" align="right"><i class="fa fa-save"></i> Procesar</button> -->
          </div>        
        </div>
      </div>
    </div> 
  </div>
</div>

