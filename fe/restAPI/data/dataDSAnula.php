<?php
require_once '../../../res/php/app_topFE.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$eToken     = $user->datosTokenFE();
$resDoc     = $user->getResolucion(2);
$infoDoc    = $user->getInfoDS($id);
$infoProds   = $user->getProductosDS($id);

$token = $eToken[0]['token'];
$docSoporte = $eToken[0]['documentoSoporte'];
$rutaFE = $eToken[0]['rutaFE'];

$resolucion = $resDoc[0]['resolucion'];
$fechaRes   = $resDoc[0]['fecha'];
$desde      = $resDoc[0]['desde'];
$hasta      = $resDoc[0]['hasta'];

$fechaDoc = date('Y-m-d');
$horaDoc = date('H:s:i');

$eDocu = [];

$eDocu['number'] = $eToken[0]['consecutivoNCDS'];; 
$eDocu['type_document_id'] = 13;
$eDocu['time'] = $horaDoc; 
$eDocu['sendmail'] = false; 
$eDocu['sendmailtome'] = false; 
$eDocu['resolution_number'] =  $resolucion;
$eDocu['prefix'] =  $eToken[0]['prefijoDS'];
$eDocu['date'] = $infoDoc[0]['fechaDocumento']; 
$eDocu['notes'] = $infoDoc[0]['observaciones']; 

$eSell = [];
$ePaym = [];
$eInvo = [];
$eLega = [];
$eHold = [];
$eBill = [];

$eSell['identification_number'] = $infoDoc[0]['nit'];
$eSell['dv'] = $infoDoc[0]['dv'];
$eSell['name'] = $infoDoc[0]['empresa'];
$eSell['phone'] = $infoDoc[0]['celular'];
$eSell['address'] = $infoDoc[0]['direccion'];
$eSell['email'] = $infoDoc[0]['email'];
$eSell['merchant_registration'] = '000000';
$eSell['postal_zone_code'] = '0000-00';
$eSell['type_document_identification_id'] = $infoDoc[0]['tipo_documento'];
$eSell['type_organization_id'] = $infoDoc[0]['tipoAdquiriente'];
$eSell['municipality_id'] = $infoDoc[0]['ciudad'];
$eSell['type_liability_id'] = $hotel->traeIdResponsabilidadDianVenta($infoDoc[0]['responsabilidadTributaria']);
$eSell['type_regime_id'] = 2;

$ePaym['payment_form_id'] = $infoDoc[0]['formaPagoDian'];
$ePaym['duration_measure'] = $infoDoc[0]['vencimiento'];
$ePaym['payment_due_date'] = $infoDoc[0]['fechaVencimiento'];
$ePaym['payment_method_id'] = $infoDoc[0]['identificador_dian'];

$eLega['line_extension_amount'] = $infoDoc[0]['total'];
$eLega['payable_amount'] = $infoDoc[0]['total'];
$eLega['tax_exclusive_amount'] = $infoDoc[0]['total'];
$eLega['charge_total_amount'] = $infoDoc[0]['total'];
$eLega['tax_inclusive_amount'] = $infoDoc[0]['total'];
$eLega['allowance_total_amount'] = "0.00";

foreach($infoProds as $info){
    $invo = [
        'code' => $info['identificador_dian'],
        'notes' => null,
        'start_date' => $infoDoc[0]['fechaDocumento'],
        'description' => $info['descripcion_cargo'],
        'price_amount' => $info['valorUnitario'],
        'base_quantity' => $info['cantidad'],
        'unit_measure_id' => $info['unidadDian'],
        'allowance_charges' => [],
        'invoiced_quantity' => $info['cantidad'],
        'line_extension_amount' => $info['valorTotal'],
        'free_of_charge_indicator' => false,
        'type_item_identification_id' => 4,
        "type_generation_transmition_id" => $infoDoc[0]['tipoOperacion'],  
    ];

    array_push($eInvo, $invo); 

}

$eDocu['seller'] = $eSell;
$eDocu['payment_form'] = $ePaym;
$eDocu['invoice_lines'] = $eInvo;
$eDocu['legal_monetary_totals'] = $eLega;
$eDocu['with_holding_tax_total'] = $eHold;



echo json_encode($eDocu);

