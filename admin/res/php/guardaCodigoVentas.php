<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	extract($_POST);

	$guardaCodigo = $admin->insertCodigoVenta(strtoupper($nombreAdi), $unidadMed, $ImptosAdi, $grupoAdi, $reteFte, $reteIca, $centroAdi, $pucAdi, strtoupper($descripcionAdi), strtoupper($codigoDianAdi)) ;

	echo json_encode($guardaCodigo) ;

 ?>
