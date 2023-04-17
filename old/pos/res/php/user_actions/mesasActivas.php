<?php 

	require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

  $fecha = $_POST['fecha'];
  $idamb = $_POST['id'];

  $mesas = $pos->getComandasAmbiente($idamb);

  echo $mesas;
