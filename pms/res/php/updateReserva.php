<?php 

  // require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	
	$empresa       = $_POST['empresaUpd'];
	$numero        = $_POST['numeroReserva'];
	$iden          = $_POST['identifica'];
	$llegada       = $_POST['llegadaUpd']; 
	$noches        = $_POST['nochesUpd'];
	$salida        = $_POST['salidaUpd'];
	$hombres       = $_POST['hombresUpd']; 
	$mujeres       = $_POST['mujeresUpd'];
	$ninos         = $_POST['ninosUpd'];
	$orden         = strtoupper($_POST['orden']);
	$tipohabi      = $_POST['tipohabiUpd'];
	$nrohabitacion = $_POST['nrohabitacionUpd'];
	$tarifahab     = $_POST['tarifahabUpd'];
	$valortarifa   = str_replace('.00','',$_POST['valortarifaUpd']);
	$valortarifa   = str_replace(',','',$valortarifa);
	$valortarifa   = round($valortarifa,2);
	$origen        = $_POST['origen'];
	$destino       = $_POST['destino'];
	$motivo        = $_POST['motivo'];
	$fuente        = $_POST['fuente'];
	$segmento      = $_POST['segmento'];
	$idhuesp       = $_POST['idhuesped'];
	$observa       = $_POST['observaciones']; 
	$formapa       = $_POST['formapagoUpd'];
	$impto         = $_POST['imptoOption'];

	$updateReserva = $hotel->updateReserva($iden, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, $orden, $tipohabi, $nrohabitacion, $tarifahab, $valortarifa, $origen, $destino, $motivo, $fuente, $segmento, $idhuesp, $numero, $observa, $formapa, $impto, $empresa);

	echo $updateReserva;

 ?>
