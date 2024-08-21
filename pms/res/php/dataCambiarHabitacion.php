<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $id      = $_POST['id'];

  $reserva    = $hotel->getBuscaReserva($id);
  $huesped    = $hotel->getBuscaIdHuesped($reserva[0]['id_huesped']);
  $cia        = $hotel->getBuscaCia($reserva[0]['id_compania']);
  $tipohab    = $reserva[0]['tipo_habitacion'];
  $tipos      = $hotel->getTipoHabitacion();
  $destipohab = $hotel->getNombreTipoHabitacion2($reserva[0]['tipo_habitacion']); 
  $motivos    = $hotel->getMotivoCancelacion(2);

 ?>

<div class="modal-body modalReservas">
  <input type="hidden" name="txtIdReservaCam" id="txtIdReservaCam" value="<?=$id?>">
  <input type="hidden" value="<?=$reserva[0]['fecha_llegada']?>" id="llegada">
  <input type="hidden" value="<?=$reserva[0]['fecha_salida']?>" id="salida">
  <div class="form-group">
    <label for="tipohabi" class="col-sm-2 control-label">Tipo Hab.</label>
    <div class="col-sm-5">
      <select name="txtTipoHabCam" id="txtTipoHabCam" readonly disabled>
        <option value=""><?=$destipohab?></option>
      </select>
    </div>
    <label class="control-label col-md-2">Numero</label>
    <div class="col-lg-3 col-md-3">
      <input class="form-control padInput" type="text" name='txtNumeroHabCam' id='txtNumeroHabCam' readonly value="<?=$reserva[0]['num_habitacion']?>">    
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2">Nuevo Tipo Hab.</label>
    <div class="col-sm-5">
      <select name="tipohabi" id="tipohabi" required onblur="habitacionesDisponibles()">
        <option value="">Seleccione el Tipo de Habitacion</option>
        <?php 
          foreach ($tipos as $tipo) { ?>
            <option value="<?=$tipo['id']?>"
            <?php 
            if($reserva[0]['tipo_habitacion']==$tipo['id']){?>
              <?php 
            }
            ?>
            ><?=$tipo['descripcion_habitacion']?></option>
          <?php 
          }
        ?>
      </select>
    </div>
    <label for="nrohabitacion" class="col-sm-2 control-label">Nro Habitacion</label>
    <div class="col-sm-3">
      <select name="nrohabitacion" id="nrohabitacion">
        <option value="">Seleccione la Habitacion</option>
      </select>                        
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2" for="">Motivo</label>
    <div class="col-lg-10 col-md-10" >
      <select name="motivoCambio" id="motivoCambio" required>
        <option value="">Motivo Cambio</option>
        <?php 
        foreach ($motivos as $motivo) { ?>
          <option value="<?=$motivo['id_cancela']?>"><?=$motivo['descripcion_motivo']?></option>
          <?php  
        }
        ?>
      </select>
    </div>
  </div>    
    <div class="form-group">
    <label class="control-label col-md-2" for="">Observaciones</label>
    <div class="col-lg-10 col-md-10" >
      <textarea class="form-control" name="observaCambio" id="observaCambio" rows="4"></textarea>
    </div>
  </div>            
        
  <div class="form-group">
    <label class="control-label col-md-3" for="" style="margin-top:10px">Bloquear Habitacion</label>
    <div class="col-lg-8 col-md-8" >
      <div class="col-sm-4" style="padding:0">
        <div class="col-sm-6" style="height: 25px">
          <div class="form-check form-check-inline">
            <input style="margin-top:10px" class="form-check-input" type="radio" name="habitacionOption" id="inlineRadio1" value="1" onclick="selDormitorio(this.value)" checked="">
            <label style="margin-top:-17px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Si</label>
          </div>                     
        </div>
        <div class="col-sm-6" style="height: 25px">
          <div class="form-check form-check-inline">
            <input style="margin-top:10px" class="form-check-input" type="radio" name="habitacionOption" id="inlineRadio2" value="2" onclick="selDormitorio(this.value)">
            <label style="margin-top:-17px;margin-left:25px" class="form-check-label" for="inlineRadio2">No</label>
          </div>
        </div>
      </div>
    </div>
  </div>            
</div>