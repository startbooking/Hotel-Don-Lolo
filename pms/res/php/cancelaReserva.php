<?php 

  require '../../../res/php/app_topHotel.php'; 

  $numero    = $_POST['numero'];
  $motivo    = $_POST['motivo'];
  $usuario   = $_POST['usuario'];
  $observa   = $_POST['observa'].' Usuario: '.$usuario.' Fecha Observacion: '.date('Y.m.d H:i:s');

  $depositos = $hotel->getDepositosReservas($numero);

  if(count($depositos)==0){
	  $cancela = $hotel->updateCancelaReserva($numero, $usuario, $motivo, $observa); 
	  echo $cancela;
  }else{
  	echo -1 ;
  }




  ?>
