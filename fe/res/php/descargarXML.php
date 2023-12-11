<?php

$file = $_POST['file'];

require_once '../res/php/app_topHotel.php';
// https://api.nextpyme.plus/api/ubl2.1/download/892002427/ZipAttachm-HDL13402.xml


$eToken = $hotel->datosTokenCia();

$token = $eToken[0]['token'];

/* $numDoc = '892002427';

$eNit = [];
$numNC = strval($numDoc);

$eNit['identification_number'] = $numNC;
$eNit['rues'] = true;

$eNit = json_encode($eNit);
*/
// echo $eNit;

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.nextpyme.plus/api/ubl2.1/download/'.NIT.'/ZipAttachm-'.$file.'.xml',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  // CURLOPT_POSTFIELDS => $eNit,
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer '.$token,
  ],
]);

$respoNit = curl_exec($curl);
/* curl_close($curl);

echo $respoNit;
 */