<?php

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'http://servidordefacturacion.com:81/api/ubl2.1/credit-note',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $eNote,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$token,
    ],
]);

$response = curl_exec($curl);

curl_close($curl);
echo $response;
