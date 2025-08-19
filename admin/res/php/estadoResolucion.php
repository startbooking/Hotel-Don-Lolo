<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$data = json_decode(file_get_contents('php://input'), true);
	extract($data);
  if($estado == 1){
    $reg = $admin->cambiaEstado($id, $cambio);
  }else{
    $cant = $admin->resolucionesActivas();
    if($cant == 0){
      $reg = $admin->cambiaEstado($id, $cambio);
    }else{
      $reg = [
        'id' => $cant,
        'error' => 'Existen Resoluciones Activas',
      ];
    }
  }

  echo json_encode($reg);
 ?>
