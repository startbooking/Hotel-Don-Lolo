<?php
require '../../../../res/php/app_topPos.php';

$codigo = $_POST['codigo'];
$ambiente = $pos->getAmbienteSeleccionado($codigo);

echo json_encode($ambiente);

?>
  