<?php

require '../../../res/php/app_topHotel.php';
$id = $_POST['id'];
$huesped = $hotel->getSeleccionaHuesped($id);

if (!empty($huesped[0]['tipo_identifica'])) {
    $tipoDoc = $hotel->getTipoDocumentoHuesped($huesped[0]['tipo_identifica']);
} else {
    $tipoDoc = '';
}

if (empty($huesped)) {
    echo '0';
} else { ?>
    <div class="form-group">
      <label for="apellidos" class="col-sm-3 control-label">Huesped </label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="apellido1" placeholder="" value="<?php echo $huesped[0]['apellido1'].' '.$huesped[0]['apellido2'].' '.$huesped[0]['nombre1'].' '.$huesped[0]['nombre2']; ?>" readonly>
        <input type="hidden" name="sexo" id="sexo" value="<?php echo $huesped[0]['sexo']; ?>">
        <input type="hidden" name="idhuesped" id="idhuesped" value="<?php echo $huesped[0]['id_huesped']; ?>">
        <input type="hidden" name="identifica" id="identifica" value="<?php echo $huesped[0]['identificacion']; ?>">
        <input type="hidden" name="idcia" id="idcia" value="<?php echo $huesped[0]['id_compania']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-3 control-label">Empresa</label>
      <div class="col-lg-9 col-md-9">
        <select class="form-control" name="empresaUpd" id="empresaUpd" >
          <option value="0">SIN COMPAÑIA</option>
          <?php
            $companias = $hotel->getCompanias(); 
            foreach ($companias as $compañia) { ?>
              <option value="<?=$compañia['id_compania']?>"
              <?php
              if ($compañia['id_compania'] == $huesped[0]['id_compania'] ) { ?>
                selected
                <?php
              }
              ?>              
              ><?=$compañia['empresa']?></option>
              <?php
            }?>
        </select>
      </div> 
    </div>
    <?php
  }

  ?>
  