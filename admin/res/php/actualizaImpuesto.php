<?php 
  
  require '../../../res/php/app_topAdmin.php'; 
	extract($_POST);

	$actualImpto = $admin->updateImpuesto(strtoupper($nombreModImp), $porcentajeModImp, $tipoModImp, $pucModImp, strtoupper($descripcionModImp), $idImptoModImp, $imptoDianUpd) ;

	echo $actualImpto ;

 ?>
