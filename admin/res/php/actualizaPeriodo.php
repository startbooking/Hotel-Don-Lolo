<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id  = $_POST['idPeriodoMod'];
	$periodo  = strtoupper($_POST['nombreMod']);
	$ambiente = $_POST['nombreAmbiMod'];
	$inicio   = $_POST['inicioMod'];
	$final    = $_POST['finalMod'];

	$upd = $admin->updatePeriodo($id, $periodo, $ambiente, $inicio, $final) ;

	echo $upd ;

 ?>
