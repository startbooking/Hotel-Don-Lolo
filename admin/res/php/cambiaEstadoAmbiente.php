<?php

require '../../../res/php/app_topAdmin.php';

$ambiente = $_POST['ambiente'];
$estado = $_POST['estado'];

if ($estado === '1') {
    $estadoen = '0';
} elseif ($estado === '0') {
    $estadoen = '1';
}

$bloquea = $admin->activaAmbiente($ambiente, $estadoen);

echo $bloquea;

?>
 