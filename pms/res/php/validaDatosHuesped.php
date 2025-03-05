<?php 
  $resp = []; 

  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  
  require_once '../../../res/php/app_topHotel.php'; 
    
  $infoHuesped =  $hotel->getBuscaIdHuesped($id);
  
  if($infohuesped['nombre1']==""){
    array_push($resp, ['mensaje' => 'Huesped Sin Primer Nombre Asignado']);
  }
  if($infohuesped['apellido1']==""){
    array_push($resp, ['mensaje' => 'Huesped Sin Primer Apellido Asignado']);
  }
  if($infohuesped['celular']==""){
    array_push($resp, ['mensaje' => 'Huesped Sin Numero Telefonico Asignado']);  
  }
  if($infohuesped['identificacion']==""){
    array_push($resp, ['mensaje' => 'Huesped Sin Identificacion Asignada ']);
  }
  if($infohuesped['email']==""){
    array_push($resp, ['mensaje' => 'Huesped Sin Correo Electronico Asignado']);  
  }  
  
  echo json_encode($resp);  
  
?>
