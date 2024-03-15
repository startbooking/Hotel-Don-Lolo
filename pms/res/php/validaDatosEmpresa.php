<?php 
  $resp = [];

  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  
  require_once '../../../res/php/app_topHotel.php'; 
  
  if($id != 0){
    $infoCia =  $hotel->getBuscaIdEmpresa($id);
    
    if($infoCia[0]['empresa']==""){
      array_push($resp, ['mensaje' => 'Empresa sin Nombre Asignado']);
    }
    if($infoCia[0]['nit']==""){
      array_push($resp, ['mensaje' => 'Empresa sin NIT  Asignado']);
    }
    if($infoCia[0]['dv']==""){
      array_push($resp, ['mensaje' => 'Empresa Sin DV Asignado']);
    }
    if($infoCia[0]['direccion']==""){
      array_push($resp, ['mensaje' => 'Empresa Sin Direccion Asignada']);
    }
    if($infoCia[0]['telefono']==""){
      array_push($resp, ['mensaje' => 'Empresa Sin Telefono Asignado']);
    } 
    if($infoCia[0]['email']==""){
      array_push($resp, ['mensaje' => 'Empresa Sin Correo Electronico Asignado']);
    }
    if($infoCia[0]['tipo_documento']==""){
      array_push($resp, ['mensaje' => 'Empresa Sin Tipo de Documento Asignado']);
    }
    if($infoCia[0]['tipoAdquiriente']==""){
      array_push($resp, ['mensaje' => 'Empresa sin Tipo de Adquiriente Asignado']);
    }
    if($infoCia[0]['responsabilidadTributaria']==""){
      array_push($resp, ['mensaje' => 'Empresa sin Responsabiliad Tributaria Asignada']);
    }
    if($infoCia[0]['ciudad']==""){
      array_push($resp, ['mensaje' => 'Empresa sin NIT  Ciudad Asignada']);
    } 
  }
    
  echo json_encode($resp);  
  
?>
