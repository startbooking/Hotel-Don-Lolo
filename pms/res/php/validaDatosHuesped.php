<?php 
  $resp = [];

  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  
  require_once '../../../res/php/app_topHotel.php'; 
    
  $infoHuesped =  $hotel->getBuscaIdHuesped($id);
  
  if($infoHuesped[0]['nombre1']==""){
    $resp = ['mensaje' => 'Huesped Sin Primer Nombre Asignado'];
  }
  if($infoHuesped[0]['apellido1']==""){
    $resp = ['mensaje' => 'Huesped Sin Primer Apellido Asignado'];
  }
  if($infoHuesped[0]['celular']==""){
    $resp = ['mensaje' => 'Huesped Sin Telefono Asignado '];
  }
  if($infoHuesped[0]['identificacion']==""){
    $resp = ['mensaje' => 'Huesped Sin Identificacion Asignada '];
  }
  if($infoHuesped[0]['email']==""){
    $resp = ['mensaje' => 'Huesped Sin Correo Electronico Asignado '];
  }  
  
  echo json_encode($resp);  
  
?>
