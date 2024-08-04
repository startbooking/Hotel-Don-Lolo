<?php
require '../../../../res/php/app_topPos.php';
$datos  = $pos->huespedesEnCasaDesayunos();

echo json_encode($datos);
