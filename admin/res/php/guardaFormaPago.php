<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descripcion = strtoupper(addslashes($_POST['nombreAdi']));
	$puc         = $_POST['pucAdi'];
	$contabil    = strtoupper(addslashes($_POST['descripcionAdi']));

	$guardaForma = $admin->insertFormaPago($descripcion, $puc, $contabil) ;

	echo $guardaForma ;

 ?>
