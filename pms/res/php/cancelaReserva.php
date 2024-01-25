<?php 

  require '../../../res/php/app_topHotel.php'; 

/*   $numero    = $_POST['numero'];
  $motivo    = $_POST['motivo'];
  $usuario   = $_POST['usuario'];
  $observa   = $_POST['observa'].' Usuario: '.$usuario.' Fecha Observacion: '.date('Y.m.d H:i:s');
 */
  extract($_POST);
  
  $depositos = $hotel->getDepositosReservas($numero);

  echo json_encode($depositos);
  

  
  
  if(count($depositos)>0){
    // $anula = $hotel->
    $anula = $hotel->updateAnulaConsumo($codigo,$textcodigo,$fecha,$usuario,$idusuario);

  }
  $cancela = $hotel->updateCancelaReserva($numero, $usuario, $motivo, $observa); 
  echo $cancela;




  ?>
