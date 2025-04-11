<?php

require_once '../clases/functions.php';
$_hotel = new Hotel_Actions();

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
    $numero = $conse[0]['con_ajuste_cuenta'];
    $prefijo = $conse[0]['pref_ajuste_cuenta'];

    $lista = $_hotel->actualizaAjusteCuenta($folio,$reserva, $numero, $prefijo, $usuario, $usuario_id);
    echo json_encode($lista);
    http_response_code(200);
  }
}