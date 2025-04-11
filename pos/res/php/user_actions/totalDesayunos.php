<?php
require '../../../../res/php/app_topPos.php';
$postBody = json_decode(file_get_contents('php://input'), true);

extract($postBody);

$reg = $pos->totalDesayunos($fecha_auditoria);

echo $reg;
 