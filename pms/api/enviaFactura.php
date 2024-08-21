<?php
// echo 'ENtro Curl ';

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.nextpyme.plus/api/ubl2.1/invoice',
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
    'Authorization: Bearer '.$token,
  ],
]);

$respofact = curl_exec($curl);

curl_close($curl);
