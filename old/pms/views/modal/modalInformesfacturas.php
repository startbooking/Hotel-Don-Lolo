<div class="modal fade" id="myModalVerFactura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:anulaFactura()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
            <h3 class="modal-title" id="exampleModalLabel">Factura</h3>
          </div>
          <div id="mensaje">
          </div> 
          <div class="modal-body">
            <input type="hidden" name="reserva" id="reserva" value="">
            <input type="hidden" name="txtFacturaNro" id="txtFacturaNro" value="">
            <div class="form-group">
              <object id="verFacturaModal" width="100%" height="450" data=""></object> 
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><I class="fa fa-reply"></I> Regresar</button>
          </div>
        </div>
      </div>
    </div> 
  </form>
</div>

<div class="modal fade" id="myModalVerCargosFactura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:anulaFactura()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
            <h3 class="modal-title" id="exampleModalLabel">Factura</h3>
          </div>
          <div id="mensaje">
          </div> 
          <div class="modal-body">
            <input type="hidden" name="reserva" id="reserva" value="">
            <input type="hidden" name="txtFacturaNro" id="txtFacturaNro" value="">
            <div class="form-group" id='verCargosFactura'>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><I class="fa fa-reply"></I> Regresar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
