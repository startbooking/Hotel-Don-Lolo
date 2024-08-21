<div class="panel panel-success">
  <div class="panel-heading"></div>
  <div class="panel-body">
    <input type="hidden" name="txtIdReservaCam" id="txtIdReservaCam" value="">
    <div class="form-group">
      <label class="control-label col-lg-3">Tipo Habitacion</label>
      <div class="col-lg-4 col-md-4">
        <input class="form-control padInput" type="text" name="txtTipoHabCam" id="txtTipoHabCam" readonly>
      </div>
      <label class="control-label col-lg-2">Numero</label>
      <div class="col-lg-2 col-md-2">
        <input class="form-control padInput" type="text" name='txtNumeroHabCam' id='txtNumeroHabCam' readonly>    
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-3">Tipo Habitacion</label>
      <div class="col-sm-4">
        <select name="tipohabi" id="tipohabi" required onblur="seleccionaHabitacion()">
          <option value="">Seleccione el Tipo de Habitacion</option>
          <?php 
            $tipos = $hotel->getTipoHabitacion();
            foreach ($tipos as $tipo) {
            ?>
            <option value="<?=$tipo['tipo_habi']?>"><?=$tipo['des_habi']?></option>
            <?php 
            }
          ?>
        </select>
      </div>
      <label for="nrohabitacion" class="col-sm-2 control-label">Nro Habitacion</label>
      <div class="col-sm-2">
        <div id="habitaciones">
          <input type="text" class="form-control" id="" required="" value="" min=0>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-3" for="">Motivo</label>
      <div class="col-lg-8 col-md-8" >
        <select name="motivoCambio" id="motivoCambio" required>
          <option value="">Motivo Cambio</option>
          <?php 
          $motivos = $hotel->getMotivoCancelacion(2);
          foreach ($motivos as $motivo) { ?>
            <option value="<?=$motivo['id_cancela']?>"><?=$motivo['descripcion_motivo']?></option>}
             option 
            <?php  
          }
          ?>
        </select>
      </div>
    </div>            
    <div class="form-group">
      <label class="control-label col-lg-3" for="" style="margin-top:10px">Bloquear Habitacion</label>
      <div class="col-lg-8 col-md-8" >
          <div class="col-sm-4" style="padding:0">
            <div class="col-sm-6" style="height: 25px">
              <div class="form-check form-check-inline">
                <input style="margin-top:10px" class="form-check-input" type="radio" name="habitacionOption" id="inlineRadio1" value="1" onclick="selDormitorio(this.value)" checked="">
                <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Si</label>
              </div>                     
            </div>
            <div class="col-sm-6" style="height: 25px">
              <div class="form-check form-check-inline">
                <input style="margin-top:10px" class="form-check-input" type="radio" name="habitacionOption" id="inlineRadio2" value="2" onclick="selDormitorio(this.value)">
                <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">No</label>
              </div>
            </div>
          </div>

      </div>
    </div>            
  </div>
  <div class="panel-footer">
    <div class="btn-group" style="width: 60%;">
      <button style="width: 50%" type="button" class="btn btn-warning" data-dismiss="modal">Regresar</button>
      <button style="width: 50%" class="btn btn-success" align="right">Procesar</button>
    </div>               
  </div>
  
</div>
