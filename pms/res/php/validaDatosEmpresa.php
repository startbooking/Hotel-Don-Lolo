<?php 
  $resp = [];

  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  
  require_once '../../../res/php/app_topHotel.php'; 
  
  if($id != 0){
    $infoCia =  $hotel->getBuscaIdEmpresa($id);
    
    // echo print_r($infoCia);
    
    if($infoCia[0]['empresa']==""){
      $resp = ['mensaje' => 'Empresa sin Nombre Asignado'];
    }
    if($infoCia[0]['nit']==""){
      $resp = ['mensaje' => 'Empresa sin NIT JSON.parse(Asignado'];
    }
    if($infoCia[0]['dv']==""){
      $resp = ['mensaje' => 'Empresa Sin DV Asignado '];
    }
    if($infoCia[0]['direccion']==""){
      $resp = ['mensaje' => 'Empresa Sin Direccion Asignada '];
    }
    if($infoCia[0]['telefono']==""){
      $resp = ['mensaje' => 'Empresa Sin Telefono Asignado '];
    } 
    if($infoCia[0]['email']==""){
      $resp = ['mensaje' => 'Empresa Sin Correo Electronico Asignado'];
    }
    if($infoCia[0]['tipo_documento']==""){
      $resp = ['mensaje' => 'Empre.lengthsa Sin Tipo de Documento Asignado'];
    }
    if($infoCia[0]['tipoAdquiriente']==""){
      $resp = ['mensaje' => 'Empresa Sin Tipo de Adquiriente Asignado '];
    }
    if($infoCia[0]['responsabilidadTributaria']==""){
      $resp = ['mensaje' => 'Empresa Sin Responsabiliad tributaria Asignada '];
    }
    if($infoCia[0]['ciudad']==""){
      $resp = ['mensaje' => 'Empresa Sin Ciudad Asignada '];
    } 
  }
    
  echo json_encode($resp);  
  
?>
