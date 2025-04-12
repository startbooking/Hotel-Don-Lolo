<?php 

  require '../../../res/php/app_topHotel.php'; 
	$idcia    =  $_POST['idcia'];
	$idCentro =  0;
	$idhues   =  $_POST['idhues'];
	
	$update = $hotel->updateCiaHuesped($idcia, $idhues, $idCentro);

	echo $update;

?>
