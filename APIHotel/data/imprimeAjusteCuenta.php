<?php

/* require_once '../clases/functions.php';
$_hotel = new Hotel_Actions();
 */
$headers = apache_request_headers();
$token = str_replace('Bearer ','',$headers['Authorization']);

if ($token == '' ) {
  header('WWW-Authenticate: Basic realm="Conexion no Establecida"');
  header('HTTP/1.0 401 Unauthorized');
  echo 'Conexion no Establecida !!';
  http_response_code(401);
  exit;
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postBody = json_decode(file_get_contents('php://input'), true);
    extract($postBody);
    require_once '../../pms/imprimir/imprimeAjusteCuenta.php'; 
    http_response_code(200);
    return ;
  }
}