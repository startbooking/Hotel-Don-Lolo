<?php
  require '../../../res/php/app_topAdmin.php';
	extract($_POST);
	$regis = $admin->updateRetencion($idImptoModImp, strtoupper($nombreModImp), $porcentajeModImp, $baseReteUpd, $tipoReteUpd, $imptoDianUpd, $pucModImp)  ;
	echo $regis ;
?>
