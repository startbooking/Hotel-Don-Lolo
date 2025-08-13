<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	extract($_POST);

	$porImpto = $admin->traePorceImpto($ImptosAdi);

	$guardaCodigo = $admin->insertCodigoVenta(strtoupper($nombreAdi), $unidadMed, $ImptosAdi, $grupoAdi, $reteFte, $reteIca, $centroAdi, $pucAdi, strtoupper($descripcionAdi), strtoupper($codigoDianAdi), $porImpto) ;

	echo json_encode($guardaCodigo) ;

 ?>
