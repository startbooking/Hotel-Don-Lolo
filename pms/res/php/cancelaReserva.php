<?php 

  require '../../../res/php/app_topHotel.php'; 
  $regis = [];

  extract($_POST);
  
  $depositos = $hotel->getDepositosReservas($numero);
  
  $anula = 0;
  
  $cancela = $hotel->updateCancelaReserva($numero, $usuario, $motivo, strtoupper($observa)); 
  
  if($cancela==1){
    if(count($depositos)>0){
      $anula = $hotel->updateAnulaConsumo($depositos[0]['id_cargo'],strtoupper($observa),FECHA_PMS,$usuario,$usuario_id);
    }
  }
  
  $regis = [
    'anula' => $anula,
    'cancela' => $cancela,
  ];

  echo json_encode($regis);




  ?>
