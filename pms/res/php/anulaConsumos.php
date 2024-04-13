<?php 

  require '../../../res/php/app_topHotel.php';
	extract($_POST);

	$anula = $hotel->updateAnulaConsumo($id, strtoupper($motivo), FECHA_PMS,$usuario, $usuario_id);

	echo $anula;

 ?>