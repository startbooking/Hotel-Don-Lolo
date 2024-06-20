

<?php 
  require '../../../res/php/app_topHotel.php'; 
	
	extract($_POST);	
	
	$regAdi = $hotel->adicionaHuespedAdicional($numRese,$id);
	
	echo json_encode($regAdi);

 