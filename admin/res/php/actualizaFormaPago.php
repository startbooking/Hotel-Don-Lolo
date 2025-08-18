<?php 
  require '../../../res/php/app_topAdmin.php'; 
	extract($_POST);

	$actualFormaPago = $admin->updateFormaPago(strtoupper($nombreMod), $pucMod, strtoupper($descripcionMod), $idFormaPagoMod, $formaDianMod, $metodoDianMod, $crucepucMod) ;

	echo $actualFormaPago ;

 ?>
