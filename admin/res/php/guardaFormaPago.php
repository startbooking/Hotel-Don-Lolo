<?php 
	
  require '../../../res/php/app_topAdmin.php';
	extract($_POST);

	$guardaForma = $admin->insertFormaPago(strtoupper($nombreAdi), $pucAdi, strtoupper($descripcionAdi),$formaDian, $metodoDian, $crucepucAdi) ;

	echo $guardaForma ;

 ?>
