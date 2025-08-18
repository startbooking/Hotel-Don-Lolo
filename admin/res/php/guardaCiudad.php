<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

  extract($_POST);

	$guarda = $admin->insertCiudad($paices, strtoupper($ciudad), strtoupper($codigo)) ;

	echo $guarda ;

 ?>
