<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id      = $_POST['idPaquMod'];
	$descrip = strtoupper(addslashes($_POST['descripcionMod']));
	$frecuen = $_POST['frecuenciaMod'];
	$tipcar  = $_POST['tipoCargoMod'];
	$codpaq  = $_POST['codigoPaqMod'];
	$valor   = $_POST['valorMod'];

	$guarda = $admin->updatePaquete($id, $descrip, $frecuen, $tipcar, $codpaq, $valor);

	echo $guarda ;

 ?>
