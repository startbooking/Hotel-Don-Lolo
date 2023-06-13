<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id          = $_POST['idImptoModImp'];
	$descripcion = strtoupper(addslashes($_POST['nombreModImp']));
	$porcentaje  = $_POST['porcentajeModImp'];
	$tipo        = $_POST['tipoModImp'];
	$puc         = $_POST['pucModImp'];
	$contabil    = strtoupper(addslashes($_POST['descripcionModImp']));

	$actualImpto = $admin->updateImpuesto($descripcion, $porcentaje, $tipo, $puc, $contabil, $id) ;

	echo $actualImpto ;

 ?>
