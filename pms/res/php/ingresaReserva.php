<?php 
  require '../../../res/php/app_topHotel.php'; 
  extract($_POST);

  $ingresa = $hotel->updateingresaReserva($origen	, $destino, $motivo, $fuente, $segmento, $formapagoUpd, $numeroReserva, $usuario, strtoupper($placavehiculo), strtoupper($equipaje), $transporte); 
  
  $estHabi = $hotel->cambiaOcupacionHabitacion($nrohabitacionUpd,'1');

  if($ingresa==1){
  	$buscadeposito = $hotel->getBuscaDeposito($numeroReserva	);
  	if($buscadeposito<>0){
      $buscareserva      = $hotel->getBuscaReservaDeposito($numeroReserva	);
      $actualizadeposito = $hotel->updateDepositoReserva($numeroReserva	,$buscareserva['id_huesped'],$buscareserva['num_habitacion']);
  	}
  }

  echo $ingresa;

  ?>
