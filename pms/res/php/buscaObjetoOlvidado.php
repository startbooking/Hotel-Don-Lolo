<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $id  =  $_POST['id'];

	$encontro = $hotel->getBuscaObjetoOlvidado($id);
	$numhab   = $hotel->getNumeroHab($encontro[0]['id_habitacion']);
	$huesped  = $hotel->getNombreHuesped($encontro[0]['id_huesped']);

?>

  <div class="form-group">
    <label for="llegada" class="col-sm-2 control-label">Objeto Encontrado</label>
    <div class="col-sm-6" style="padding-right: 5px">
      <input type="text" class="form-control" name="objetoInf" id="objetoInf" required="" value="<?=$encontro[0]['objeto_encontrado']?>" readonly disabled> 
    </div>
     <label for="salida" class="col-sm-1 control-label">Fecha</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="fechaInc" id="fechaInc" value="<?php echo substr($encontro[0]['fecha_encontrado'],0,10);?>" disabled>
    </div>
  </div>
  <div class="form-group">
    <label for="ninos" class="col-sm-2 control-label">Habitacion</label>
    <div class="col-sm-2" style='padding-right: 5px'>
      <select name="roomInc" id="roomInc" readonly disabled>
      	<option value="" ><?=$numhab?></option>
      </select>
    </div>
    <label for="hombres" class="col-sm-1 control-label">Lugar</label>
    <div class="col-sm-3" style='padding-right: 5px'>
      <input type="text" class="form-control" name="lugarInc" id="lugarInc" readonly disabled value="<?=$encontro[0]['lugar_encontrado']?>">
    </div>
    <label for="orden" class="col-sm-1 control-label">Estado</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="estadoInc" id="estadoInc" value="<?=$encontro[0]['estado_objeto']?>" readonly disabled>
    </div>
  </div>
  <div class="form-group">
    <label for="mujeres" class="col-sm-2 control-label">Huesped</label>
    <div class="col-sm-4" style='padding-right: 5px'>
    	<select name="huespedInc" id="huespedInc" readonly disabled>
    		<option value=""><?=$huesped[0]['nombre_completo']?></option>
    		option
    	</select>
    </div>
    <label for="IncontradoInc" class="col-sm-2 control-label">Encontrado Por</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="encontradoInc" id="encontradoInc" readonly disabled value='<?=$encontro[0]['encontrado_por']?>'>
    </div>
  </div>
  <div class="form-group">                    
    <label for="tipohabi" class="col-sm-2 control-label">Lugar Almacenado</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="almacenadoEnc" id="almacenadoEnc" readonly disabled value='<?=$encontro[0]['almacenado_en']?>'>
    </div>
  </div>
  <div class="form-group">
    <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
    <div class="col-sm-10">
      <textarea style="height: 5em !important;min-height: 5em" name="observacionesInc" id="observacionesInc" class="form-control" rows="4" readonly disabled><?=$encontro[0]['observaciones_objeto']?></textarea>
    </div>                    
  </div>                 
