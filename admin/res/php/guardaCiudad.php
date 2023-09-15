<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

  extract($_POST);

	$guarda = $admin->insertCiudad($paices, $ciudad, $codigo) ;

	echo $guarda ;

 ?>
