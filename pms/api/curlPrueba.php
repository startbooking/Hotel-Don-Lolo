<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'http://servidordefacturacion.com:81/api/ubl2.1/download',
  CURLOPT_CUSTOMREQUEST => 'POST',

]);

$response = curl_exec($curl);

// $error = curl_error();

curl_close($curl);
echo $response;
// echo $error;
