<?php

require '../../../../res/php/app_topPos.php';
$postBody = json_decode(file_get_contents('php://input'), true);
$huespedes = $postBody['huespedes'];
$fec = $postBody['fecha_auditoria'];

foreach ($huespedes as $huesped ) {
  $est = $huesped['estado'];
  $idh = $huesped['id_huesped'];
  $res = $huesped['num_reserva'];
  $reg = $pos->guardaPlanillaDesayunos($fec, $res, $idh, $est);
}

echo json_encode($reg);
 