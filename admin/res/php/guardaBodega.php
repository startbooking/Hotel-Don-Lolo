<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$bodega = strtoupper($_POST['nombreAdi']);
	$tipo   = $_POST['tipoBodega'];

	$guarda = $admin->insertBodega($bodega,$tipo) ;

	echo $guarda ;

 ?>
