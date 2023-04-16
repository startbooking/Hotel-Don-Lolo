<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id     = $_POST['idBodegaMod'];
	$bodega = strtoupper($_POST['nombreMod']);
	$tipo   = $_POST['tipoBodegaMod'];
	
	$guarda = $admin->updateBodega($id,$bodega,$tipo) ;

	echo $guarda ;

 ?>
