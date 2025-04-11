<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	
	$numero   =  $_POST['numeroReserva'];
	/* $iden     =  $_POST['identifica'];
	$impto    =  $_POST['imptoOption'];
	$noches   =  $_POST['noches'];
	$salida   =  $_POST['salida']; 
	$motivo   =  $_POST['motivo'];
	$fuente   =  $_POST['fuente'];
	$segmento =  $_POST['segmento'];
	$formapa  =  $_POST['formapagoUpd']; */
	$orden    =  $_POST['orden']; 

	$update = $hotel->updateCongelada($numero, $orden);

	echo $update;

 ?>
