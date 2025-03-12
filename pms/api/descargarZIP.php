<?php

$numeroFac = $_POST['numero'];

// $numeroFac = '13412';
require_once '../../res/php/app_topHotel.php';
// https://api.nextpyme.plus/api/ubl2.1/download/892002427/ZipAttachm-HDL13402.xml

// $token = '3fcd8364af60e73a8cbca99ea3cf57c279350e108e39d693aa74e9d2a8476918';
$eToken = $hotel->datosTokenCia();
$token = $eToken[0]['token'];

// echo $token;

$prefijo = 'HDL';
$resFac = $hotel->getResolucion(1);
$prefijo = $resFac['prefijo'];


$url = 
'https://api.nextpyme.plus/api/ubl2.1/download/'.NIT.'/Attachment-'.$prefijo.$numeroFac.'.xml';
echo $url;

/*
curl_setopt_array($curl, [
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_AUTOREFERER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer '.$token,
  ],
]);

$respoZIP = curl_exec($curl);
curl_close($curl);

echo $respoZIP; */

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer '.$token,
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;