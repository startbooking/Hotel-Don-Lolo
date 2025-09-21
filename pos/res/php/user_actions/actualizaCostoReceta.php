<?php
  require '../../../../res/php/app_topPos.php'; 

$data = json_decode(file_get_contents('php://input'), true);
extract($data);

$regis = $pos->actualizaCostoReceta($costo, $receta);

echo json_encode($regis);
