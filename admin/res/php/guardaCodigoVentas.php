<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descripcion = strtoupper(addslashes($_POST['nombreAdi']));
	$impto       = $_POST['ImptosAdi'];
	$grupo       = $_POST['grupoAdi'];
	$puc         = $_POST['pucAdi'];
	$centro      = $_POST['centroAdi'];
	$contabil    = strtoupper(addslashes($_POST['descripcionAdi']));



	$guardaCodigo = $admin->insertCodigoVenta($descripcion, $impto, $grupo, $puc, $contabil, $centro) ;

	echo $guardaCodigo ;

 ?>
