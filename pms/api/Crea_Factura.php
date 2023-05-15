<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'http://servidordefacturacion.com:81/api/ubl2.1/invoice',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $eFact,
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer 88ffa79e99bb9cd025c5a95313495533ac38cb12438d751c74c8cc2466c401c1',
  ],
]);

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
