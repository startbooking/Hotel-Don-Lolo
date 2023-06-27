<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id     = $_POST['idBodegaEli'];
	$bodega = strtoupper($_POST['nombreEli']);
	$tipo   = $_POST['tipoBodegaEli'];
	
	$guarda = $admin->eliminaBodega($id) ;

	echo $guarda ;

 ?>
