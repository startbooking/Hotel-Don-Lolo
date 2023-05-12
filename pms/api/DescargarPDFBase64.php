<?php

// Usar /BASE64 para descargar el archivo en base64
// http://servidordefacturacion.com:81/api/ubl2.1/download/900961724/FES-ELP63676.pdf/BASE64


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://servidordefacturacion.com:81/api/ubl2.1/download/900961724/FES-ELP63676.pdf/BASE64',
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
    'Authorization: Bearer 88ffa79e99bb9cd025c5a95313495533ac38cb12438d751c74c8cc2466c401c3'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
