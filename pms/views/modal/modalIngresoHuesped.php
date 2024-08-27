<div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosArticles" class="form-horizontal" action="javascript:saveArticles()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterArticle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button>
            <h3 class="modal-title" id="exampleModalLabel">Adicionar Articulo</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body">
            <input type="hidden" name="idhotel" id="idhotel" value="<?php echo $idhotel; ?>">
            <input type="hidden" name="idregis" id="idregis" value="">
            <div class="form-group">
              <label class="control-label col-lg-2">Titulo</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control" type="text" name="nameArticle" id="nameArticle" required>
              </div>
              <label class="control-label col-lg-2">Descripcion</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control" type="text" name='descripcion' id='descripcion' required>  
              </div>
            </div>
            <div class="form-group" >
              <label class="control-label col-lg-2" for="">Articulo</label>
              <div class="col-lg-10 col-md-10" >
                  <div class="summernote" id="summernote"></div> 
              </div>          
            </div>
            <div class="form-group" >
              <label class="control-label col-lg-2" for="">Pie de pagina</label>
              <div class="col-lg-10 col-md-10" >
                <div class="summernote" id="summernoteFooter" name="summernoteFooter"></div> 
              </div>          
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-6 col-lg-offset-3" >
                <div class="col-lg-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Regresar</button>
                </div>
                <div class="col-lg-6">
                  <button class="btn btn-primary btn-block">Guardar</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
