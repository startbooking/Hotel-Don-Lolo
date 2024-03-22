<?php 

  require '../../../res/php/app_topHotel.php'; 

  echo 'Entro ';

	$codigo     = $_POST['id'];
	$textcodigo = strtoupper($_POST['motivo']);
	$fecha      = FECHA_PMS;
	$usuario    = $_POST['usuario'];
	$idusuario  = $_POST['usuario_id'];
	echo 'Entro 2';
	
	echo $codigo.'1 <br>'.$textcodigo.'2 <br> '.$fecha.'3 <br>'.$usuario.'4 <br>'. $idusuario.'5 <br>';

	$anula = $hotel->updateAnulaConsumo($codigo,$textcodigo,$fecha,$usuario,$idusuario);

	echo 'Entro 3';

	echo $anula;

 ?>