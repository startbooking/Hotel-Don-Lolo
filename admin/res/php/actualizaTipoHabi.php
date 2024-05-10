<?php

require '../../../res/php/app_topAdmin.php';

$id = $_POST['id'];
$codigo = strtoupper(addslashes($_POST['codigo']));
$descr = strtoupper(addslashes($_POST['descr']));
$sector = $_POST['sector'];
$codvta = $_POST['codvta'];
$codexc = $_POST['codexc'];


$updateTipoHab = $admin->updateTipoHabi($id, $codigo, $descr, $sector, $codvta, $codexc);

echo $updateTipoHab;
