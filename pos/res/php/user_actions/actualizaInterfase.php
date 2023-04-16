<?php 

  require '../../../../res/php/app_topPos.php'; 

	$codigo   = $_POST['codigo'];
	$propina  = $_POST['propina'];
	$servicio = $_POST['servicio'];
	$idamb    = $_SESSION['AMBIENTE_ID'];

  $upda = $pos->actualizaInterfase($codigo,$propina,$servicio,$idamb);
  
  echo $upda; 

 ?>
