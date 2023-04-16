<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$ambi  = $_POST['nombreAmbi'];
	$descr = strtoupper(addslashes($_POST['nombreAdi']));
	$porce = $_POST['porcentajeAdi'];

	$regis = $admin->insertDescuento($descr,$ambi, $porce) ;

	echo $regis ;

 ?>
