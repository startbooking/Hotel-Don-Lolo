<?php 
	
  require '../../../res/php/app_topAdmin.php'; 


	$descrip  = strtoupper($_POST['descri']);
	$tipo     = $_POST['tipo'];
	$compra   = $_POST['compra'];
	$ajuste   = $_POST['ajuste'];
	$traslado = $_POST['traslado'];

	$guarda = $admin->inserTipoMovi($descrip, $tipo, $compra, $ajuste, $traslado) ;
	
	echo $guarda ;
	
 ?>
