<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$codigo     = $_POST['id'];
	$textcodigo = strtoupper($_POST['motivo']);
	$fecha      = FECHA_PMS;
	$usuario    = $_POST['usuario'];
	$idusuario  = $_POST['idusuario'];

	$anula = $hotel->updateAnulaConsumo($codigo,$textcodigo,$fecha,$usuario,$idusuario);

	echo $anula;

 ?>