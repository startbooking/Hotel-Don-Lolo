<?php 
	
  require '../../../res/php/app_topInventario.php'; 

	$descripcion = strtoupper(addslashes($_POST['nombreAdi']));
	$impto       = $_POST['ImptosAdi'];
	$grupo       = $_POST['grupoAdi'];
	$puc         = $_POST['pucAdi'];
	$contabil    = strtoupper(addslashes($_POST['descripcionAdi']));

	$guardaCodigo = $admin->insertProducto($descripcion, $impto, $grupo, $puc, $contabil) ;

	echo $guardaCodigo ;

 ?>
