<?php

require_once '../../../res/php/app_topFE.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {    
  if(isset($_GET['item'])){
    $id = $_GET['item'];
    $lista = $user->getDocumento($id);
  }else{
    $lista = $user->getDocumentos();
  }
  header('Content-Type: application/json');    
  echo json_encode($lista);
  http_response_code(200);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  $result = $user->ingresaEncabezadoDocumento(strtoupper($docu), $tipo, $prov, $fech, $plaz, $venc, $form, $usuario_id, strtoupper($come));
  echo json_encode($result);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  $result = $user->actualizaEstadoDS($idDoc,$conse);
  echo json_encode($result);
}
