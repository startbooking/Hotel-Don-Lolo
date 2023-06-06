<?php 

  require '../../../../res/php/app_topPos.php'; 

	$comanda  = $_POST['comanda'];
	$ambiente = $_POST['ambiente'];

  $resumen = $pos->getComandaResumen($ambiente, $comanda) ;

  echo json_encode($resumen);
