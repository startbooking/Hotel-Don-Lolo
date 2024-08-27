<?php

require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';

$codigo = $_POST['codigo'];
$ambienteSeleccionado = $pos->getAmbienteSeleccionado($codigo);

echo json_encode($ambienteSeleccionado);

?>
  