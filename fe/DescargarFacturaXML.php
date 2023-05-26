<?php

 $token = '13e5b0375855ae69baffd8dd8f4cfe7d0a25d5773dc5ad26238ae76696778fab';
 $server = 'http://servidordefacturacion.com:81/api/invoice/';
 $pref = 'FES-';
 $nit = '892002427';
 $numDoc = '991000080';
 $preFac = 'SETP';
 $ext = '.xml';

 $ruta = $server.$nit.'/'.$pref.$preFac.$numDoc.$ext;

 $curl = curl_init();

 curl_setopt_array($curl, [
   CURLOPT_URL => $ruta,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'GET',
   CURLOPT_HTTPHEADER => [
     'Content-Type: application/json',
     'Accept: application/json',
     'Authorization: Bearer '.$token,
   ],
 ]);

 $response = curl_exec($curl);

 curl_close($curl);
 echo $response;
