<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $hues      =  $_POST['hues'];
  $rese      =  $_POST['rese'];

  $cambia = $hotel->cambiaHuespedReserva($rese,$hues);

  echo $cambia;


/*
  $huesped = $hotel->getSeleccionaHuesped($id);
  if(!empty($huesped[0]['tipo_identifica'])){
    $tipoDoc = $hotel->getTipoDocumentoHuesped($huesped[0]['tipo_identifica']);
  }else{
    $tipoDoc = '';
  }

  if(!empty($huesped[0]['id_compania'])){
    $cia =  $hotel->getSeleccionaCompania($huesped[0]['id_compania']);
  }

  if(empty($huesped)){
    echo '0';
  }else{ ?>
    <div class="form-group">
      <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="apellido1" placeholder="" value="<?=$huesped[0]['apellido1'].' '.$huesped[0]['apellido2']?>" readonly>
        <input type="hidden" name="sexo" id="sexo" value="<?=$huesped[0]['sexo']?>">
        <input type="hidden" name="idhuesped" id="idhuesped" value="<?=$huesped[0]['id_huesped']?>">
        <input type="hidden" name="identifica" id="identifica" value="<?=$huesped[0]['identificacion']?>">
      </div>
      <label for="nombres" class="col-sm-2 control-label">Nombres</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="nombre2" placeholder="" value="<?=$huesped[0]['nombre1'].' '.$huesped[0]['nombre2']?>" readonly>
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
      <?php
      }
    } 
  }

*/

?>
