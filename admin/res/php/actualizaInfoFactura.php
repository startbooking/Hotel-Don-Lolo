<?php 
  
  require '../../../res/php/app_topAdmin.php';   
  $postBody = json_decode(file_get_contents('php://input'), true);
  
  extract($postBody);
	
	$upd = $admin->actualizaInfoFactura($idHotel, $tituloFac, $infoBanco, $infoFact, $infoPie);

	echo $upd;


 ?>
