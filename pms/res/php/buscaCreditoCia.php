<?php 
  require '../../../res/php/app_topHotel.php'; 

	$idCia =  $_POST['idCia'];

	$creditoCia  = $hotel->getBuscaCreditoCia($idCia);

	echo json_encode($creditoCia);


 ?>