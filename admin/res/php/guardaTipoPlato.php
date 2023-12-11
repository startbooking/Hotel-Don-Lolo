<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$ambi        = $_POST['nombreAmbi'];
	$descripcion = strtoupper(addslashes($_POST['nombreAdi']));

	$regis = $admin->insertTipoPlato($descripcion,$ambi) ;

	echo $regis ;

 ?>
