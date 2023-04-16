<?php 
	
  require '../../../res/php/app_topAdmin.php'; 


	$id       = $_POST['id'];
	$descrip  = strtoupper($_POST['descri']);
	$tipo     = $_POST['tipo'];
	$compra   = $_POST['compra'];
	$ajuste   = $_POST['ajuste'];
	$traslado = $_POST['traslado'];

	$actual = $admin->updateTipoMovi($id, $descrip, $tipo, $compra, $ajuste, $traslado) ;
	
	echo $actual ;
	
 ?>
