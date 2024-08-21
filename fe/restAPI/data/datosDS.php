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
    $result = $user->ingresaDS($dataDS, $prefijoDS, $consecutivoDS, $StatusCode,$statusText, $StatusDescription, $StatusMessage, $ErrorMessage, $IsValid, $message, $send_email_success, $send_email_date_time, $urlinvoicexml, $urlinvoicepdf, $cude, $QRStr, $Created);
    echo json_encode($result);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $postBody = json_decode(file_get_contents('php://input'), true);
    extract($postBody);
    
    $result = $user->incrementaDS($numDS);
    echo json_encode($result);
}
