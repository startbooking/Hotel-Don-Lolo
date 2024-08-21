<?php

require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$consulta = $hotel->consultaDatosFE($factura);

if($consulta==0){
  $regis = $hotel->ingresaDatosFe($factura, $prefijo, $dian_validation_date_time, $message, $send_email_success, $send_email_date_time, '', '', '', '', '', '', '', $urlinvoicexml, $urlinvoicepdf, $cufe, $QRStr, '', $IsValid, '', $ErrorMessage, $StatusCode, $StatusDescription, $StatusMessage);
}else {
  $regis = $hotel->actualizaDatosFe($factura, $prefijo, $dian_validation_date_time, $message, $send_email_success, $send_email_date_time, '', '', '', '', '', '', '', $urlinvoicexml, $urlinvoicepdf, $cufe, $QRStr, '', $IsValid, '', $ErrorMessage, $StatusCode, $StatusDescription, $StatusMessage);
}

echo $regis;

