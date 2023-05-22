<?php

$curl = curl_init();

$dataHotel = [
  'type_document_identification_id' => 6,
  'type_organization_id' => 1,
  'type_regime_id' => 1,
  'type_liability_id' => 14,
  'business_name' => 'HOTEL DON LOLO LTDA',
  'merchant_registration' => '7700',
  'municipality_id' => 687,
  'address' => 'CRA 39#20-32 BARRIO CAMOA',
  'phone' => '6086706020',
  'email' => 'reservas@donlolohotel.com',
  'mail_host' => 'smtp.gmail.com',
  'mail_port' => '58',
  'mail_username' => 'reservas@donlolohotel.com',
  'mail_password' => 'reservA24',
  'mail_encryption' => 'tls',
];

curl_setopt_array($curl, [
  CURLOPT_URL => 'http://servidordefacturacion.com:81/api/ubl2.1/config/892002427/7',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($dataHotel),
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Accept: application/json',
  ],
]);

$response = curl_exec($curl);

curl_close($curl);

$dataresp = json_decode($response);

echo json_encode($dataresp);

// echo $error;
