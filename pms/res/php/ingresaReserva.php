<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $numero  = $_POST['numero'];
  $habita  = $_POST['habita'];
  $usuario = $_POST['usuario']; 

  $ingresa = $hotel->updateingresaReserva($numero, $usuario); 
  
  // $estHabi = $hotel->cambiaEstadoHabitacion($habita,'0');
  $estHabi = $hotel->cambiaOcupacionHabitacon($habita,'1');

  if($ingresa==1){
  	$buscadeposito = $hotel->getBuscaDeposito($numero);
  	if($buscadeposito<>0){
      $buscareserva      = $hotel->getBuscaReservaDeposito($numero);
      $actualizadeposito = $hotel->updateDepositoReserva($numero,$buscareserva['id_huesped'],$buscareserva['num_habitacion']);
  	}
  }

  echo $ingresa;

  ?>
