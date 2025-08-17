<?php 
	
  require '../../../res/php/app_topAdmin.php'; 
	extract($_POST); 

	$guardaImpto = $admin->insertImpuesto(strtoupper($nombreAdi), $porcentajeAdi, $tipoAdi, $pucAdi, strtoupper($descripcionAdi),$imptoDian ) ;

	echo $guardaImpto ;

 ?>
