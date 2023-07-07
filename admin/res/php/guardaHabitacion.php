<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$nrohab  = strtoupper(addslashes($_POST['CodigoAdi']));
	$tipo    = $_POST['tipoHabiAdi'];
	$sector  = $_POST['sectorHabiAdi'];
	$camas   = $_POST['camasAdi'];
	$pax     = $_POST['huespedesAdi']; 
	$destipo = $admin->getDescrTipoHab($tipo);

	$guarda = $admin->insertHabitacion($nrohab, $tipo, $sector, $camas, $pax, $destipo) ;

	echo $guarda ;

 ?>
