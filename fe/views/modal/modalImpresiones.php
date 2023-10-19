<div class="modal fade" id="myModalImpresion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="datosInfo" class="form-horizontal" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
            <h3 id="tituloDocumento" class="modal-title" id="exampleModalLabel">Factura</h3>
          </div>
          <div id="mensaje">
          </div>
          <div class="modal-body">
            <input type="hidden" name="reserva" id="reserva" value="">
            <input type="hidden" name="txtDocumentoNro" id="txtDocumentoNro">
            <div class="form-group">
              <object id="verImpresion" width="100%" height="450" data=""></object>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">
              <I class="fa fa-reply"></I> Regresar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>