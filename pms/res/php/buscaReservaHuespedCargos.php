<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php';

  $reserva     =  $_POST['reserva'];  
  $array       = array();
  $datoreserva = $hotel->getbuscaDatosReservaHuesped($reserva);
  $datohuesped = $hotel->getbuscaDatosHuesped($datoreserva[0]['id_huesped']);

	?>

  <input type="hidden" name="txtNumeroHabCon" id="txtNumeroHabCon" value="<?=$datoreserva[0]['num_habitacion']?>">
  <input type="hidden" name="txtIdHuespedDep" id="idHuespedSal" value="<?=$datoreserva[0]['id_huesped']?>"> 
  <input type="hidden" name="txtIdHuespedDep" id="txtImptoTurismo" value="<?=$datoreserva[0]['causar_impuesto']?>"> 
  <input type="hidden" name="reservaActual" id="reservaActual" value="<?=$reserva?>"> 
  <label class="control-label col-lg-3">Huesped</label>
  <div class="col-lg-9 col-md-9">
    <input class="form-control padInput" type="text" name="txtApellidosCon" id='txtApellidosCon' value='<?=$datohuesped[0]['nombre_completo']?>' readonly disabled>
  </div>
