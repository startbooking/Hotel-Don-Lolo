<div class="modal fade" id="myModalAnularSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:anulaSalida()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Anular Salida</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body modalReservas">
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Reserva</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="idregis" id="txtIdReservaAnu" value="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Habit.</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name='txtNumeroHab' id='txtNumeroHabAnu' readonly="">    
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Huesped</label>
              <div class="col-lg-10 col-md-10">
                <input class="form-control padInput" type="text" name="txtNombreCompleto" id='txtNombreCompleto' readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Fecha Llegada</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtLlegada" id='txtLlegadaAnu' value='0' readonly="">
              </div>
              <label class="control-label col-lg-1 col-md-1">Noc</label>
              <div class="col-lg-1 col-md-1">
                <input class="form-control padInput" style="margin:0;padding:5px" type="text" name="txtNoches" id="txtNochesAnu" value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Fecha Salida</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtSalida" id='txtSalidaAnu' value='1' readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Hombres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtHombres" id='txtHombresAnu' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Mujeres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtMujeres" id='txtMujeresAnu' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Niños</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtNinos" id='txtNinosAnu' value='0' readonly="">
              </div>
            </div>
            <div class="form-group" >
              <label class="control-label col-lg-2 col-md-2" for="">Comentarios</label>
              <div class="col-lg-10 col-md-10" >
                <textarea class="form-control padInput" id="areaComentariosAnu" name="areaComentarios" readonly="" style="height: 5em !important;min-height: 5em"></textarea>  
              </div>          
            </div> 
            <div class="form-group">
              <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
              <div class="col-sm-3">
                <input class="form-control padInput" type="text" name="txtTarifaAnu" id="txtTarifaAnu" readonly="">
              </div>
              <label for="archivo" class="col-sm-3 control-label">Valor</label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtValorTarifaAnu" id="txtValorTarifaAnu" value=0 >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button style="width: 25%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button style="width: 25%" class="btn btn-primary" id="btnSaveRoom"><i class="fa fa-save"></i> Procesar</button>
            
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
