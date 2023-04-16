<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descripcion = strtoupper(addslashes($_POST['nombreAdi']));
	$porcentaje  = $_POST['porcentajeAdi'];
	$tipo        = $_POST['tipoAdi'];
	$puc         = $_POST['pucAdi'];
	$contabil    = strtoupper(addslashes($_POST['descripcionAdi']));

	$guardaImpto = $admin->insertImpuesto($descripcion, $porcentaje, $tipo, $puc, $contabil) ;

	echo $guardaImpto ;

 ?>
