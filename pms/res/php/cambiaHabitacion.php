<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	$id      = $_POST['id'];
	$tipoact = $_POST['tipoact'];
	$habiact = $_POST['habiact'];
	$tiponue = $_POST['tiponue'];
	$habinue = $_POST['habinue'];
	$motivo  = $_POST['motivo'];
	$observa = $_POST['observa']; 
	$idUsuario = $_POST['usuario_id']; 
	$mmto    = 0;
	$fecha   = date(FECHA_PMS." H:i:s");

	$cambiaRoom = $hotel->cambiaHabitacion($id,$tiponue,$habinue);

	if($cambiaRoom==1){
		$actRoom = $hotel->insertCambioHabitaciones($id, $tipoact, $habiact, $tiponue, $habinue, $mmto, $motivo, $observa, $fecha,1, $idUsuario);
	}
	
	$estHabi = $hotel->cambiaOcupacionHabitacion($habinue,'1');
	$estHabi = $hotel->cambiaOcupacionHabitacion($habiact,'0');
	$estHabi = $hotel->cambiaEstadoHabitacion($habiact,1);
  
?>


<div class="alert alert-success"><h3>Numero de Habitacion Actualizada con Exito</h3></div>
