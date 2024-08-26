<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descrip = strtoupper(addslashes($_POST['descripcionAdi']));
	$frecuen =  $_POST['frecuencia'];
	$tipcar  = $_POST['tipoCargo'];
	$codpaq  = $_POST['codigoPaq'];
	$codexc  = $_POST['codigoPaqExc'];
	$valor   = $_POST['valorAdi'];

	$guarda = $admin->insertPaquete($descrip, $frecuen, $tipcar, $codpaq, $codexc, $valor);

	echo $guarda ;

 ?>
