<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$iden          =  $_POST['identifica'];
	$tiporeserva   =  $_POST['habitacionOption'];
	$llegada       =  $_POST['llegada'];
	$salida        =  $_POST['salida'];
	$noches        =  $_POST['noches'];
	$hombres       =  $_POST['hombres'];
	$mujeres       =  $_POST['mujeres'];
	$ninos         =  $_POST['ninos'];
	$tipohabi      =  $_POST['tipohabi'];
	$nrohabitacion =  $_POST['nrohabitacion'];
	$tarifahab     =  $_POST['tarifahab'];
	$valortarifa   =  str_replace('.00','',$_POST['valortarifa']);
	$valortarifa   =  str_replace(',','',$valortarifa);
	$origen        =  $_POST['origen'];
	$destino       =  $_POST['destino'];
	$motivo        =  $_POST['motivo'];
	$fuente        =  $_POST['fuente'];
	$segmento      =  $_POST['segmento'];
	$idhuesp       =  $_POST['idhuesped'];
	$idcia         =  $_POST['idcia'];
	$observa       =  $_POST['observaciones'];
	$usuario       =  $_SESSION['usuario'];
	$tipo          =  2;

	if(!isset($idcia)){
		$idcia = '';
	}

	$numero        =  $hotel->getNumeroReserva(); // Numero Actual de La Reserva

	$nuevonumero  = $hotel->updateNumeroReserva($numero + 1); // Actualiza Consecutivo de Reserva

	$nuevaReserva = $hotel->insertNuevaReserva($iden, $tiporeserva, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, $tipohabi, $nrohabitacion, $tarifahab, $valortarifa, $origen, $destino, $motivo, $fuente, $segmento, $idhuesp, $idcia, $numero, $usuario, $tipo,1);

	return $nuevaReserva;


 ?>
