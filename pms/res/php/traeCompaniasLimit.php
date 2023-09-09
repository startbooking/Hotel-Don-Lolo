<?php 
  require '../../../res/php/app_topHotel.php'; 
	
  /* $regis      = $_POST['regis'];
  $filas      = $_POST['filas'];  */

  $companias = $hotel->getPerfilCompanias();

  echo json_encode($companias);
