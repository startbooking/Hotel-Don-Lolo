<?php 
	
  require '../../../res/php/app_topAdmin.php'; 
	extract($_POST); 

	$guardaRete = $admin->insertRetencion(strtoupper($nombreAdi), $porcentaje, $baseRete, $tipoRete, $imptoDian, $pucAdi ) ;

	echo json_encode($guardaRete);

 ?>
