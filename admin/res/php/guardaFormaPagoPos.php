<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descripcion = strtoupper(addslashes($_POST['nombreAdi']));
	$puc         = $_POST['pucAdi'];
	$contabil    = strtoupper(addslashes($_POST['descripcionAdi']));
	$pms         = $_POST['pms'];

	$guarda = $admin->insertFormaPagoPos($descripcion, $puc, $contabil, $pms) ;

	echo $guarda ;

 ?>
