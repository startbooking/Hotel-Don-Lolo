<?php

require '../../../res/php/app_topHotel.php';


$query = "SELECT DISTINCT huespedes.id_huesped, huespedes.nombre_completo, valores_tarifas.id_subtarifa FROM huespedes INNER JOIN historico_reservas_pms ON huespedes.id_huesped = historico_reservas_pms.id_huesped INNER JOIN valores_tarifas ON historico_reservas_pms.tarifa = valores_tarifas.id WHERE huespedes.id_tarifa IS NULL  ORDER BY huespedes.id_huesped ASC";

$huesped     = $hotel->creaConsulta($query);

foreach ($huesped as $key => $value) {
  $id = $value['id_huesped'];
  $tarifa = $value['id_subtarifa'];
  $regis = $hotel->actualizaTarifaHuesped($id, $tarifa);

}


echo 'Proceso Terminado';