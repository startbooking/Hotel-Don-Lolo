<div class="modal fade" id="myModalVerObservaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaAbonos()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Observaciones a la Reserva</h3>
          </div>
          <div class="modal-body">
            <div id="observacionesHuesped" style="margin :-20px 0 -30px 0;font-size: 12px"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<div class="modal fade" id="myModalAdicionaObservaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:adicionaObservacion()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <input type="hidden" name="reservaObs" id="reservaObs">
            <input type="hidden" name="observaAnt" id="observaAnt">
            <h3 class="modal-title" id="exampleModalLabel">Observaciones a la Reserva</h3>
          </div>
          <div class="modal-body">
            <div class="panel panel-success">
              <div class="panel-heading" style="padding:5px;">
                <div class="container-fluid" style="padding:0px;">
                  <div class="form-group">
                    <label for="apellidos" class="col-sm-2 control-label">Habitacion</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="habitacionObs" id="habitacionObs" placeholder="" value="" readonly>
                    </div>
                    <label for="apellidos" class="col-sm-2 control-label">Huesped </label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="huespedObs" name="huespedObs" placeholder="" value="" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="llegada" class="col-sm-2 control-label">Llegada</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="llegadaObs" id="llegadaObs" readonly="" value=""> 
                    </div>
                    <label for="noches" class="col-sm-1 control-label">Noches</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="nochesObs" id="nochesObs" readonly="" value=''>
                    </div>
                    <label for="salida" class="col-sm-1 control-label">Salida</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="salidaObs" id="salidaObs" readonly="" value="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-body" style="padding:5px">
                <div class="container-fluid" style="padding:0 10px">
                  <h5 style="margin:10px;font-weight: 600;font-size: 14px;font-family: 'Ubuntu'">Observaciones</h5>
                  <div class="col-md-12" style="padding:0px;">
                    <textarea style="text-transform: uppercase;" id="adicionaObs" name="adicionaObs" value=""></textarea>
                  </div>
                </div>          
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
