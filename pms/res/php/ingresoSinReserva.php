<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$idcia         =  $_POST['empresaUpd'];
	$idcentro      =  0;
	
	$iden          =  $_POST['identifica'];
	$llegada       =  $_POST['llegada'];
	$salida        =  $_POST['salida'];
	$noches        =  $_POST['noches'];
	$hombres       =  $_POST['hombres'];
	$mujeres       =  $_POST['mujeres']; 
	$ninos         =  $_POST['ninos'];
	$tipohabi      =  $_POST['tipohabi'];
	$nrohabitacion =  $_POST['nrohabitacion'];
	$tarifahab     =  $_POST['tarifahab'];
	$valortarifa   =  str_replace('.00','',$_POST['valortar']);
	$valortarifa   =  str_replace(',','',$valortarifa);
	$valortarifa   =  round($valortarifa,2);
	$origen        =  $_POST['origen'];
	$destino       =  $_POST['destino'];
	$motivo        =  $_POST['motivo']; 
	$fuente        =  $_POST['fuente'];
	$segmento      =  $_POST['segmento'];
	$idhuesp       =  $_POST['idhuesped'];
	$orden         =  $_POST['orden'];
	$usuario       =  $_POST['usuario'];
	$idusuario     =  $_POST['idusuario'];
	$tipo          =  $_POST['tipoocupacion'];
	$estado        =  $_POST['estadoocupacion'];
	$formapa       =  $_POST['formapago'];
	$impto         =  $_POST['imptoOption'];
	$observa       =  strtoupper($_POST['observaciones']);
	$placavehiculo =  strtoupper($_POST['placavehiculo']);
	$equipaje      =  strtoupper($_POST['equipaje']);
	$transporte    =  $_POST['transporte'];

	

	if($observa!=''){
		$observa       =  $observa . ' Usuario: '.$_POST['usuario'].' Fecha Observacion: '.date('Y.m.d H:i:s');
	} 

	$numero       = $hotel->getNumeroReserva(); // Numero Actual de La Reserva
	$nuevonumero  = $hotel->updateNumeroReserva($numero + 1); // Actualiza 

	$nueva = $hotel->insertLlegadaSinReserva($iden, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, $orden, $tipohabi, $nrohabitacion, $tarifahab, $valortarifa, $origen, $destino, $motivo, $fuente, $segmento, $idhuesp, $idcia, $idcentro, $numero, $usuario, $estado, $observa, $formapa, 1, $impto, $idusuario, $tipo, $placavehiculo, $equipaje, $transporte);

	echo $numero;	
?>
