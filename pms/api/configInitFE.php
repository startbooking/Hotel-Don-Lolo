<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'http://servidordefacturacion.com:81/api/ubl2.1/config/892002427/7',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS => '{
      "mode": "raw",
      "raw": "{\r\n\t\"type_document_identification_id\": 6,\r\n\t\"type_organization_id\": 1,\r\n\t\"type_regime_id\": 1,\r\n\t\"type_liability_id\": 14,\r\n\t\"business_name\": \"HOTEL DON LOLO LTDA\",\r\n\t\"merchant_registration\": \"77-00\",\r\n\t\"municipality_id\": 687,\r\n\t\"address\": \"CRA 39 NRO 20-32\",\r\n\t\"phone\": 6086706020,\r\n\t\"email\": \"reservas@donlolohotel.com\",\r\n    \"mail_host\": \"smtp.gmail.com\",\r\n    \"mail_port\": \"587\",\r\n    \"mail_username\": \"reservas@donlolohotel.com\",\r\n    \"mail_password\": \"reservA24\",\r\n    \"mail_encryption\": \"tls\"\r\n}"
      "response": []
    }',
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Accept: application/json',
  ],
]);

$response = curl_exec($curl);

curl_close($curl);
echo $response;
