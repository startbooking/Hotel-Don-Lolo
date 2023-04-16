<?php 
  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
  $ambWork   = $_POST['idamb'];

  if($ambWork==0){
    $ambientes = $pos->getAmbientes(); 
    $regis = count($ambientes); 
    if($regis==0){
      echo 0;
    }else{
        $ambi = array();
      if($regis==1){
        $ambienteSeleccionado = $pos->getAmbienteSeleccionado($ambientes[0]['id_ambiente']);
        $ambi = $ambienteSeleccionado;
        $_SESSION['NOMBRE_AMBIENTE'] = $ambienteSeleccionado[0]['nombre'];
        $_SESSION['AMBIENTE']        = $ambienteSeleccionado[0]['id_ambiente'];
        $_SESSION['BODEGA_AMBIENTE'] = $ambienteSeleccionado[0]['id_bodega'];
        $_SESSION['LOGO_POS']        = $ambienteSeleccionado[0]['logo'];
        $_SESSION['CODIGO_VENTA']    = $ambienteSeleccionado[0]['codigo_venta'];
        $_SESSION['CENTRO_COSTO']    = $ambienteSeleccionado[0]['id_centrocosto'];

        echo json_encode($ambi);
      }else{
        $ambientes = $pos->getAmbientes(); 
        echo json_encode($ambientes);
      }    
    }
  }else{
    $ambi = array();

    $ambienteSeleccionado = $pos->getAmbienteSeleccionado($ambWork);
    $ambi = $ambienteSeleccionado;
    $_SESSION['NOMBRE_AMBIENTE'] = $ambienteSeleccionado[0]['nombre'];
    $_SESSION['AMBIENTE']        = $ambienteSeleccionado[0]['id_ambiente'];
    $_SESSION['BODEGA_AMBIENTE'] = $ambienteSeleccionado[0]['id_bodega'];
    $_SESSION['LOGO_POS']        = $ambienteSeleccionado[0]['logo'];
    $_SESSION['CODIGO_VENTA']    = $ambienteSeleccionado[0]['codigo_venta'];
    $_SESSION['CENTRO_COSTO']    = $ambienteSeleccionado[0]['id_centrocosto'];
    echo json_encode($ambi);

  }

?>