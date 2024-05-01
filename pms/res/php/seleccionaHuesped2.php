<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $iden    =  $_POST['iden'];
  $huesped = $hotel->getSeleccionaHuesped($iden);

  if(!empty($huesped[0]['id_compania'])){
    $cia =  $hotel->getSeleccionaCompania($huesped[0]['id_compania']);
  }

  if(empty($huesped)){
    echo '0';
  }else{ ?>
    <div class="form-group">
      <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="apellidos" placeholder="" value="<?=$huesped[0]['apellidos']?>" readonly>
        <input type="hidden" name="sexo" id="sexo" value="<?=$huesped[0]['sexo']?>">
        <input type="hidden" name="idhuesped" id="idhuesped" value="<?=$huesped[0]['id_huesped']?>">
      </div>
      <label for="nombres" class="col-sm-2 control-label">Nombres</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="nombres" placeholder="" value="<?=$huesped[0]['nombres']?>" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="direccion" class="col-sm-2 control-label">Direccion </label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="direccion" placeholder="" value="<?=$huesped[0]['direccion']?>" readonly>
      </div>
      <label for="nombres" class="col-sm-2 control-label">Celular</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="nombres" placeholder="" value="<?=$huesped[0]['celular']?>" readonly>
      </div>
    </div>
    <?php 
    if(!empty($huesped[0]['id_compania'])){
      if(!empty($cia)){; ?>
        <div class="form-group">
          <label for="direccion" class="col-sm-2 control-label">Empresa </label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="direccion" placeholder="" value="<?=$cia[0]['empresa']?>" readonly>
            <input type="hidden" name="idcia" id="idcia" value="<?=$cia[0]['id_compania']?>">
          </div>
          <label for="nombres" class="col-sm-2 control-label">Nit</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="nit" placeholder="" value="<?=$cia[0]['nit'].'-'.$cia[0]['dv']?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="direccion" class="col-sm-2 control-label">Direccion </label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="direccion" placeholder="" value="<?=$cia[0]['direccion']?>" readonly>
          </div>
          <label for="nombres" class="col-sm-2 control-label">Correo</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="nombres" placeholder="" value="<?=$cia[0]['email']?>" readonly>
          </div>
        </div> 
      <?php
      }
    } 
  }

?>
