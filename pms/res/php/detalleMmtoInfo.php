

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
  <label for="desdeFechaAdi" class="col-sm-2 control-label">Desde Fecha</label>
  <div class="col-sm-2" style="padding-right: 5px">
    <input type="date" class="form-control" name="desdeFechaAdi" id="desdeFechaAdi" required="" value="<?=$detalles[0]['desde_fecha']?>" readonly>
  </div>
   <label for="hastaFechaAdi" class="col-sm-2 control-label">Hasta Fecha</label>
  <div class="col-sm-2" style="padding-right: 5px">
    <input type="date" class="form-control" name="hastaFechaAdi" id="hastaFechaAdi" required="" value="<?=$detalles[0]['hasta_fecha']?>">
  </div>
</div>
<div class="form-group">              
  <label for="motivoAdi" class="col-sm-2 control-label">Motivo</label>
  <div class="col-sm-4" style='padding-right: 5px'>
    <select name="motivoAdi" id="motivoAdi" readonly>
      <option value=""><?=$detalles[0]['descripcion_grupo']?></option>
    </select>
  </div>
  <label for="inputEmail3" class="col-sm-2 control-label"> Mantenimiento </label>
  <div class="col-sm-4 ondisplay">
    <div class="wrap">
      <div class="col-sm-6" style="padding:0;height: 15px">
        <div class="form-check form-check-inline">
          <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoMmtoOption" id="inlineRadio1" value="1" readonly disabled 
          <?php 
            if($detalles[0]['tipo_mmto']==1){ ?>
              checked
              <?php 
            }
          ?>
          >
          <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Preventivo</label>
        </div>                    
      </div>
      <div class="col-sm-6" style="padding:0;height: 15px"> 
        <div class="form-check form-check-inline">
          <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoMmtoOption" id="inlineRadio2" value="2" readonly disabled 
          <?php 
            if($detalles[0]['tipo_mmto']==2){ ?>
              checked
              <?php 
            }
          ?>
          >
          <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio2">Correctivo</label>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="form-group">
  <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
  <div class="col-sm-10">
    <textarea style="height: 8em !important;min-height: 8em" name="observacionesAdi" id="observacionesAdi" class="form-control" rows="4" readonly><?php echo $detalles[0]['observaciones'] ?></textarea>
  </div>                    
</div>                 
