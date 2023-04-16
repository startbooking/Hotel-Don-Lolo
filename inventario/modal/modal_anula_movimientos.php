<form id="AnulaDatosMovimiento">
<div class="modal fade" id="ModalAnulaMovimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
      <h3 class="modal-title" id="exampleModalLabel">Anula Movimiento Actual</h3>
    </div>         

      <input type ="hidden" id="numero" name="numero">
      <input type ="hidden" id="almacen" name="almacen">
      <input type ="hidden" id="tipo" name="tipo">
      <input type ="hidden" id="tipomov" name="tipomov">
      <h3 class="text-center text-muted" style="color:#880505;font-weight:bold">Estas seguro?</h3>
      <p class="lead text-muted text-center" 
          style="display: block;margin:10px">Esta Acción Anulara de forma permanente el Movimiento Actual. 
        <h4 align="center">Desea continuar?</h4>    
          </p>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-md btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</form>