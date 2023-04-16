<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	$id      = $_POST['id'];
	$tipoact = $_POST['tipoact'];
	$habiact = $_POST['habiact'];
	$tiponue = $_POST['tiponue'];
	$motivo  = $_POST['motivo'];
	$mmto    = $_POST['mmto'];
	$habiant = str_replace('.00','',$_POST['habiact']);
	$habiant = str_replace(',','',$habiant);
	$habinue = str_replace('.00','',$_POST['habinue']);
	$habinue = str_replace(',','',$habinue);
	$habinue = round($habinue,0);
	$fecha   = date(FECHA_PMS." H:i:s");

	$cambiaTarifa = $hotel->cambiaTarifaHabitacion($id,$tiponue,$habinue);

?>

<div class="alert alert-success"><h3>Tarifa Actualizada con Exito</h3></div>
