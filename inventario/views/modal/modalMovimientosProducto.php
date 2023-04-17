<div class="modal fade" id="myModalMostrarProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataActualizaProducto" class="form-horizontal" action="javascript:actualizaProducto()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modificar Producto</h4>
        </div>
        <div class="modal-body" id='productosMov'>
          <div id="datos_ajax"></div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
