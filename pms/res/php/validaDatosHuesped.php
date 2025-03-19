<?php 
  $resp = []; 

  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  
  require_once '../../../res/php/app_topHotel.php'; 
    
  $infoHuesped =  $hotel->getBuscaIdHuespedSinReserva($id);
  
  print_r($infohuesped);

  if($infohuesped[0]['nombre1']===""){
    array_push($resp, ['mensaje' => 'Huesped Sin Primer Nombre Asignado']);
  }
  if($infohuesped[0]['apellido1']===""){
    array_push($resp, ['mensaje' => 'Huesped Sin Primer Apellido Asignado']);
  }
  if($infohuesped[0]['celular']==""){
    array_push($resp, ['mensaje' => 'Huesped Sin Numero Telefonico Asignado']);  
  }
  if($infohuesped[0]['identificacion']==""){
    array_push($resp, ['mensaje' => 'Huesped Sin Identificacion Asignada ']);
  }
  if($infohuesped[0]['email']==""){
    array_push($resp, ['mensaje' => 'Huesped Sin Correo Electronico Asignado']);  
  }  
  
  echo json_encode($resp);  
  
?>
