<?php

// require '../../../res/php/titles.php';
require '../res/php/app_topHotel.php';

$eToken = $hotel->datosTokenCia();

echo print_r($eToken);

// $datosFact = $hotel->traeDatosFE($numero);

$eNote = [];
$eBill = [];
$eCust = [];
$eTaxe = [];
$eInvo = [];

/* $eBill['number'] = strval($dFactura[0]['factura_numero']);
$eBill['uuid'] = $uuid;
$eBill['issue_date'] = $dFactura[0]['fecha_factura'];

$eNote['billing_reference'] = $eBill;

$eNote['discrepancyresponsecode'] = 2;
$eNote['discrepancyresponsedescription'] = $motivo;
$eNote['notes'] = '';
// $eNote['resolution_number'] = $resolucion;
$eNote['prefix'] = $prefNC;
$eNote['number'] = $numDoc;
$eNote['type_document_id'] = 4;
$eNote['date'] = $fechaDoc;
$eNote['time'] = $horaDoc;
$eNote['establishment_name'] = NAME_EMPRESA;
$eNote['establishment_address'] = ADRESS_EMPRESA;
$eNote['establishment_phone'] = TELEFONO_EMPRESA;
$eNote['establishment_municipality'] = CODE_CITY_COMPANY;
$eNote['sendmail'] = false;
$eNote['sendmailtome'] = false;
$eNote['seze'] = '2021-2017';
$eNote['head_note'] = '';
$eNote['foot_note'] = '';

$eCust['identification_number'] = $nitFact;
$eCust['dv'] = $dvFact;
$eCust['name'] = $nomFact;
$eCust['phone'] = $telFact;
$eCust['address'] = $dirFact;
$eCust['email'] = $emaFact;
$eCust['merchant_registration'] = $merFact;
$eCust['type_document_identification_id'] = $tdiFact;
$eCust['type_organization_id'] = $torFact;
$eCust['type_liability_id'] = $tliFact;
$eCust['municipality_id'] = $munFact;
$eCust['type_regime_id'] = $triFact;

$eNote['customer'] = $eCust;

$eLmon['line_extension_amount'] = $subtotales[0]['cargos'];
$eLmon['tax_exclusive_amount'] = $subtotales[0]['cargos'];
$eLmon['tax_inclusive_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];
$eLmon['allowance_total_amount'] = 0;
$eLmon['payable_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];

$eNote['legal_monetary_totals'] = $eLmon;

$tax_totals = [];
foreach ($folios as $folio1) {
    $taxfolio = [];
    $taxTot = [];
    $taxTot = [
        'tax_id' => $hotel->traeCodigoDianVenta($folio1['codigo_impto']),
        'tax_amount' => $folio1['imptos'],
        'percent' => number_format($folio1['porcentaje_impto'], 0),
        'taxable_amount' => $folio1['cargos'],
    ];

    array_push($taxfolio, $taxTot);
    array_push($tax_totals, $taxTot);

    $invo = [
        'unit_measure_id' => $hotel->traeTipoUnidadDianVenta($folio1['id_codigo_cargo']),
        'invoiced_quantity' => 1,
        'line_extension_amount' => $folio1['cargos'],
        'free_of_charge_indicator' => false,
        'tax_totals' => $taxfolio,
        'description' => $folio1['descripcion_cargo'],
        'notes' => '',
        'code' => $hotel->traeCodigoDianVenta($folio1['id_codigo_cargo']),
        'type_item_identification_id' => 1,
        'price_amount' => $folio1['cargos'] + $folio1['imptos'],
        'base_quantity' => 1,
    ];

    array_push($eInvo, $invo);
}

foreach ($tipoimptos as $impto) {
    $tax = [
        'tax_id' => $hotel->traeCodigoDianVenta($impto['id_cargo']),
        'tax_amount' => $impto['imptos'],
        'taxable_amount' => $impto['cargos'],
        'percent' => number_format($impto['porcentaje_impto'], 0),
    ];

    array_push($eTaxe, $tax);
}

$eNote['tax_totals'] = $eTaxe;
$eNote['credit_note_lines'] = $eInvo;

$eNote = json_encode($eNote);

include_once '../../api/enviaNC.php';

$recibeCurl = json_decode($respoNC, true);

$message = $recibeCurl['message'];
$sendSucc = $recibeCurl['send_email_success'];
$sendDate = $recibeCurl['send_email_date_time'];

$invoicexml = $recibeCurl['invoicexml'];
$zipinvoicexml = $recibeCurl['zipinvoicexml'];
$unsignedinvoicexml = $recibeCurl['unsignedinvoicexml'];
$reqfe = $recibeCurl['reqfe'];
$rptafe = $recibeCurl['rptafe'];
$attacheddocument = $recibeCurl['attacheddocument'];
$urlinvoicexml = $recibeCurl['urlinvoicexml'];
$urlinvoicepdf = $recibeCurl['urlinvoicepdf'];
$cude = $recibeCurl['cude'];
$QRStr = $recibeCurl['QRStr'];
$respo = $recibeCurl['ResponseDian'];
$envelo = $respo['Envelope'];
$head = $envelo['Header'];
$secu = $head['Security'];
$time = $secu['Timestamp'];
$timeCrea = $time['Created'];

$Isvalid = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['IsValid'];

$regis = $hotel->ingresaDatosFe($numDoc, $prefNC, $timeCrea, $message, $sendSucc, $sendDate, $respo, $invoicexml, $zipinvoicexml, $unsignedinvoicexml, $reqfe, $rptafe, $attacheddocument, $urlinvoicexml, $urlinvoicepdf, $cude, $QRStr, $respoNC, $Isvalid, $eNote); */

/*
{
  "number": 1,
  "type_document_id": 11,
  "date": "2020-10-06",
  "time": "04:08:12",
  "resolution_number": "18760000002",
  "prefix": "DS",
  "sendmail": false,
  "seller": {
    "identification_number": 900166483,
    "dv": 1,
    "name": "BERCODE S.A.S",
    "phone": 3017882489,
    "address": "CLL 18A # 11 - 20",
    "email": "soporte@nextpyme.plus",
    "merchant_registration": "0000000-00",
    "type_document_identification_id": 6,
    "type_organization_id": 1,
    "municipality_id": 439,
    "type_regime_id": 1
  },
  "payment_form": {
    "payment_form_id": 2,
    "payment_method_id": 30,
    "payment_due_date": "2020-11-06",
    "duration_measure": "30"
  },
  "allowance_charges": [
    {
      "discount_id": 1,
      "charge_indicator": false,
      "allowance_charge_reason": "DESCUENTO GENERAL",
      "amount": "0.00",
      "base_amount": "1000000.00"
    }
  ],
  "legal_monetary_totals": {
    "line_extension_amount": "1000000.00",
    "tax_exclusive_amount": "0.00",
    "tax_inclusive_amount": "1000000.00",
    "allowance_total_amount": "0.00",
    "charge_total_amount": "0.00",
    "payable_amount": "1000000.00"
  },
  "tax_totals": [],
  "invoice_lines": [
    {
      "unit_measure_id": 70,
      "invoiced_quantity": "1",
      "line_extension_amount": "1000000.00",
      "free_of_charge_indicator": false,
      "allowance_charges": [
        {
          "charge_indicator": false,
          "allowance_charge_reason": "DESCUENTO GENERAL",
          "amount": "0.00",
          "base_amount": "1000000.00"
        }
      ],
      "tax_totals": [],
      "description": "COMISION POR SERVICIOS",
      "code": "COMISION",
      "type_item_identification_id": 4,
      "price_amount": "1000000.00",
      "base_quantity": "1",
      "type_generation_transmition_id": 1,
      "start_date": "2022-07-30"
    }
  ]
}

*/
