<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id      = $_POST['idHabiMod'];
	$nrohab  = strtoupper(addslashes($_POST['CodigoMod']));
	$tipo    = $_POST['tipoHabiMod'];
	$sector  = $_POST['sectorHabiMod'];
	$camas   = $_POST['camasMod'];
	$pax     = $_POST['huespedesMod'];
	$destipo = $admin->getDescrTipoHab($tipo);

	$update = $admin->updateHabitacion($id, $nrohab, $tipo, $sector, $camas, $pax, $destipo) ;

	echo $update ;

 ?>
