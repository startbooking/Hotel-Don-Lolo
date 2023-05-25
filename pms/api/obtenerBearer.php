<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://servidordefacturacion.com:81/api/ubl2.1/config/892002427/7',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "type_document_identification_id": 3,
    "type_organization_id": 2,
    "type_regime_id": 2,
    "type_liability_id": 14,
    "business_name": "Hotel Lolo",
    "merchant_registration": "0000000-00",
    "municipality_id": 820,
    "address": "CRA 21A NRO 11-25",
    "phone": 3103891693,
    "email": "alexander_obando@hotmail.com",
    "mail_host": "smtp.gmail.com",
    "mail_port": "587",
    "mail_username": "backupsbabel7@gmail.com",
    "mail_password": "ccsdfjruqddyxcsjgfggqlqvttt",
    "mail_encryption": "tls"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer 7692a20fec92af0aa5729d796b019d27c83c9955407994630a0cdd7702ca2329'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
