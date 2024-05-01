

<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $id         = $_POST['id'];

  $detalles = $hotel->getInformacionMantenimiento($id);
  $nroHab   = $hotel->getNumeroHab($detalles[0]['id_habitacion']);

?>

<div class="form-group">
  <label for="roomAdi" class="col-sm-2 control-label">Habitacion</label>
  <div class="col-sm-2" style='padding-right: 5px'>
    <select name="roomAdi" id="roomAdi" readonly>
      <option value=""><?=$nroHab?></option>
    </select>
  </div>
</div>
<div class="form-group">
  <label for="desdeFechaAdi" class="col-sm-2 control-label">Desde Fecha</label>
  <div class="col-sm-3" style="padding-right: 5px">
    <input type="date" class="form-control" name="desdeFechaAdi" id="desdeFechaAdi" required="" value="<?=$detalles[0]['desde_fecha']?>" readonly>
  </div>
   <label for="hastaFechaAdi" class="col-sm-2 control-label">Hasta Fecha</label>
  <div class="col-sm-3" style="padding-right: 5px">
    <input type="date" class="form-control" name="hastaFechaAdi" id="hastaFechaAdi" required="" value="<?=$detalles[0]['hasta_fecha']?>" readonly>
  </div>
</div>
<div class="form-group">              
  <label for="motivoAdi" class="col-sm-2 control-label">Motivo</label>
  <div class="col-sm-4" style='padding-right: 5px'>
    <select name="motivoAdi" id="motivoAdi" readonly>
      <option value=""><?=$detalles[0]['descripcion_grupo']?></option>
    </select>
  </div>
</div>