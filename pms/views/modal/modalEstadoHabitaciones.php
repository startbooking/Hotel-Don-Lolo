<div class="modal fade" id="myModalObservaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
          </button>
          <h3 class="modal-title" id="exampleModalLabel">Observaciones Estadia</h3>
        </div>
        <form class="form-horizontal" id="formObservacionesHab" method="POST">
          <div class="modal-body" id="modalReservasIns">
            <div class="form-group">
              <label for="llegada" class="col-sm-2 control-label">Habitacion</label>
              <div class="col-sm-2" style="padding-right: 5px">
                <input type="hidden" class="form-control" name="numeroRes" id="numeroRes" required="" value="">
                <input type="hidden" class="form-control" name="ocupada" id="ocupada" required="" value="" readonly>
                <input type="hidden" class="form-control" name="sucia" id="sucia" required="" value="" readonly>
                <input type="text" class="form-control" name="numeroHab" id="numeroHab" required="" value="" readonly>
              </div>
              <label for="salida" class="col-sm-1 control-label">Fecha</label>
              <div class="col-sm-4" style="padding-right:5px">
                <input style="padding:5px" type="text" class="form-control" name="fechaObs" id="fechaObs" required="" value="<?= date('Y-m-d H:m:i') ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="ninos" class="col-sm-2 control-label">Reportado Por</label>
              <div class="col-sm-7" style='padding-right: 5px'>
                <select name="reportadoPor" id="reportadoPor"></select>
              </div>
            </div>
            <div class="form-group">
              <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
              <div class="col-sm-10">
                <textarea style="height: 5em !important;min-height: 5em" name="reporteObs" id="reporteObs" class="form-control" rows="4"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="btn-group">
              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
              <button type="button" onclick="guardaReportaObs(this)" class="btn btn-success" align="right"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>