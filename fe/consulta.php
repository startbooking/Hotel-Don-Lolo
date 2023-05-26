<?php

// "raw": "http://apidian2023.oo/api/ubl2.1/status/zip/0f505cdb-dabb-47cd-9ebc-df7805f7c1ae",

$servidor = 'http://servidordefacturacion.com:81/api/ubl2.1/';
$ruta = 'status/zip';
$nit = '892002427';
$dv = '7';
$zip = '0f505cdb-dabb-47cd-9ebc-df7805f7c1ae';

$url = $servidor.'/'.$ruta.'/'.$zip;

// echo $url;

// echo 'http://servidordefacturacion.com:81/api/ubl2.1/config/892002427/7';

$curl = curl_init();

$consulta = [
  'sendmail' => false,
  'sendmailtome' => false,
  'is_payroll' => false,
];

curl_setopt_array($curl, [
  CURLOPT_URL => $ruta,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($consulta),
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Accept: application/json',
  ],
]);

$response = curl_exec($curl);

curl_close($curl);

$dataresp = json_decode($response);

echo json_encode($dataresp);

?> 