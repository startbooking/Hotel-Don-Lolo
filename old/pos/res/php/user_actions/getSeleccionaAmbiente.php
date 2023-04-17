<?php 

  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

  $codigo = $_POST['codigo'];
 
  $ambi = array();
  $ambienteSeleccionado = $pos->getAmbienteSeleccionado($codigo);

  $_SESSION['AMBIENTE']        = $ambienteSeleccionado[0]['codigo'];
  $_SESSION['NOMBRE_AMBIENTE'] = $ambienteSeleccionado[0]['nombre'];
  $_SESSION['BODEGA_ID']       = $ambienteSeleccionado[0]['id_bodega'];
  $_SESSION['AMBIENTE_ID']     = $ambienteSeleccionado[0]['id_ambiente'];
  $_SESSION['IMPUESTO']        = $ambienteSeleccionado[0]['impuesto'];
  $_SESSION['PROPINA']         = $ambienteSeleccionado[0]['propina'];
  $_SESSION['SERVICIO']        = $ambienteSeleccionado[0]['servicio']; 
  $_SESSION['CODIGO_VENTA']    = $ambienteSeleccionado[0]['codigo_venta'];
  $_SESSION['ENCUESTA']        = $ambienteSeleccionado[0]['encuesta'];
  
  $ambi = $ambienteSeleccionado ;

  echo json_encode($ambi);


 ?>
 