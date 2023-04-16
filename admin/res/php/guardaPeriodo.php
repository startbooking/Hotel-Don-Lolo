<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$periodo  = strtoupper($_POST['nombreAdi']);
	$ambiente = $_POST['nombreAmbi'];
	$inicio   = $_POST['inicioAdi'];
	$final    = $_POST['finalAdi'];

	$guarda = $admin->insertPeriodo($periodo, $ambiente, $inicio, $final) ;

	echo $guarda ;

 ?>
