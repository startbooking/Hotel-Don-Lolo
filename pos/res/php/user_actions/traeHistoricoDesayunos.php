<?php
require '../../../../res/php/app_topPos.php';
extract($_POST);

$desayunos = $pos->traeDesayunoHistoricos($desdeFe, $hastaFe, $ambiente);

echo json_encode($desayunos);

?>




