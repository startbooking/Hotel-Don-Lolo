<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	$id    = $_POST['id'];
	$folio = $_POST['folio'];

	$moverF = $hotel->actualizaNumeroFolio($folio,$id);

?>


<div class="alert alert-success"><h4>Cargo Trasladado con Exito</h4></div>
