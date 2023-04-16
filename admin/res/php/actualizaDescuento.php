<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id    = $_POST['idDescuentoMod'];
	$ambi  = $_POST['nombreAmbiMod'];
	$descr = strtoupper(addslashes($_POST['nombreMod']));
	$porce = $_POST['porcentajeMod'];

	$regis = $admin->actualizaDescuento($id, $descr,$ambi, $porce) ;

	echo $regis ;

 ?>
