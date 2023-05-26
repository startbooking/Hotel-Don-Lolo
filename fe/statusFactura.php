<?php

$zip = '0f505cdb-dabb-47cd-9ebc-df7805f7c1ae';
$token = '13e5b0375855ae69baffd8dd8f4cfe7d0a25d5773dc5ad26238ae76696778fab';
$server = 'http://servidordefacturacion.com:81/api/ubl2.1/';
$subdom = 'status/zip';
$pref = 'FES-';
$nit = '892002427';
$numDoc = '991000080';
$preFac = 'SETP';
$ext = '.xml';
/*
$sendm = [
  'sendmail' => false,
  'sendmailtome' => false,
  'is_payroll' => false,
]; */

// echo 'http://servidordefacturacion.com:81/api/ubl2.1/status/zip/0f505cdb-dabb-47cd-9ebc-df7805f7c1ae<br>',

$ruta = $server.$subdom.'/'.$zip;

// echo $ruta;
// echo $ruta.'<br>';

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => $ruta,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer '.$token,
  ],
]);

$response = curl_exec($curl);

curl_close($curl);

// echo $response;

$recibeCurl = json_decode($response, true);

// echo json_encode($recibeCurl);

$rD = $recibeCurl['ResponseDian']['Envelope']['Body']['GetStatusZipResponse']['GetStatusZipResult']['DianResponse'];
// ['XmlBase64Bytes'];

// echo print_r($rD);

echo json_encode($rD);

?>

<section class="content">
  <div class="panel panel-success">
    <div class="panel-heading"> 
      <div class="row">
        <div class="col-lg-9">
        </div>
      </div>
    <div class="panel-body">
      <div class="divInforme">
        <object type="text/html" id="verInforme" width="100%" height="500" data="data:application/pdf;base64,<?php echo $rD; ?>"></object> 
      </div>
    </div>
  </div> 
</section>