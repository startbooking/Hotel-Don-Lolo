<?php 
  require '../../../res/php/app_topHotel.php'; 
  extract($_POST);


  $ingresa = $hotel->updateingresaReserva($numero, $usuario, strtoupper($placa), strtoupper($equipaje), $transporte); 
  
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
