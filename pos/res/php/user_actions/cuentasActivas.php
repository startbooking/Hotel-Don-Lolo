<?php
// require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';
$data = json_decode(file_get_contents('php://input'), true);

extract($data);

$mesas = $pos->getMesasAmbi($id_ambiente);

echo json_encode($mesas);
