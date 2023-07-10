<form id="eliminarDatosProducto">
<div class="modal fade" id="dataDeleteProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
    </div>         

      <input type="hidden" id="id_prod" name="id_prod">
      <input type="hidden" id="cod_prod" name="cod_prod">
      <h3 class="text-center text-muted" style="color:#880505;font-weight:bold">Estas seguro?</h3>
      <p class="lead text-muted text-center" 
          style="display: block;margin:10px">Esta acción eliminará de forma permanente los Datos del Producto. 
        <h4 align="center">Desea continuar?</h4>    
          </p>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-lg btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</form>