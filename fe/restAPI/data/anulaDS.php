<?php
require_once '../../../res/php/app_topFE.php';

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  $result = $user->anulaDS($id, $numDocu, strtoupper($motivo), $rechazo, $usuario_id, $idNC);
  echo json_encode($result);
}elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  $result = $user->ingresaDSNC($infoJSON, $IsValid, $StatusCode, $StatusDescription, $StatusMessage, $string, $message, $send_email_success, $send_email_date_time, $urlinvoicexml, $urlinvoicepdf, $cuds, $uuid_dian, $QRStr, $Created, $number, $prefix);
  echo json_encode($result);
}

?>