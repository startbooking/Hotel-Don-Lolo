<?php 
  
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  require '../../imprimir/plantillaAuditoriaVert.php';

	$procesos = $hotel->getProcesoAuditoria();

  echo json_encode($procesos);   

?>







