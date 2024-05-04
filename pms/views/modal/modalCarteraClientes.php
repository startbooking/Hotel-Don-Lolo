<div class="modal fade" id="dataEstadoCartera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="carteraCliente" action="">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title" id="exampleModalLabel"> Estado Cartera Cliente</h3>
          <input type="hidden" name="idusrdel" id="idusrdel">
          <button class="btn btn-info pull-right" onclick="exportTableToExcel('datosClienteCartera')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
        </div>
        <div class="modal-body" id="datosClienteCartera">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
        </div>
      </div>
    </div>
  </form>
</div>