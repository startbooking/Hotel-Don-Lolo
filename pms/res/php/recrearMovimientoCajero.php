<?php 
  require '../../../res/php/app_topHotel.php'; 
  require '../../imprimir/plantillaReimprimir.php';

	$usuario     = $_SESSION['usuario']; 
	$fechaIni    = $_POST['fechaIni'];
	$fechaFin    = $_POST['fechaFin'];
	$fechaPro    = $fechaIni;
	$fechaIniUni = strtotime($fechaIni);
	$fechaFinUni = strtotime($fechaFin);

	$dias =  ($fechaFinUni - $fechaIniUni) / 86400 ;
	echo $dias;

	for ($i=1; $i <=$dias ; $i++) { 
	  $_SESSION['fechaPro'] = $fechaPro ;
	  include '../../imprimir/recreaBalanceCajeros.php' ;
		$fechaPro    = strtotime ( '+1 day' , strtotime ( $fechaPro ) ) ;
		$fechaPro    = date ('Y-m-d' , $fechaPro );

		echo $fechaPro;
	}

 

?>
