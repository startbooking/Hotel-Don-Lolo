<?php

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
  CURLOPT_POSTFIELDS => '{
    "number": 990000027,
    "type_document_id": 1,
    "date": "2023-05-23",
    "time": "09:00:44",
    "resolution_number": "18760000001",
    "prefix": "SETP",
    "notes": "",
    "disable_confirmation_text": true,
    "establishment_name": "HOTEL DON LOLO LTDA",
    "establishment_address": "CRA 39 NRO 20 32 BARRIO CAMOA",
    "establishment_phone": "3138153620",
    "establishment_municipality": "684",
    "establishment_email": "RESERVAS@DONLOLOHOTEL.COM",
    "sendmail": true,
    "sendmailtome": true,
    "send_customer_credentials": false,
    "head_note": "",
    "foot_note": "",
    "customer": {
      "identification_number": 901484327,
      "dv": 8,
      "name": "AU CORPORATION S.A.S",
      "phone": "3138523719",
      "address": "CR 19 6 50 P 2",
      "email": "aucorporation1@gmail.com",
      "merchant_registration": "0000000-00",
      "type_document_identification_id": 8,
      "type_organization_id": 1,
      "type_liability_id": 14,
      "municipality_id": "149",
      "type_regime_id": 1
    },
    "payment_form": {
      "payment_form_id": "1",
      "payment_method_id": "1",
      "payment_due_date": "2023-05-23",
      "duration_measure": 45
    },
    "legal_monetary_totals": {
      "line_extension_amount": 664270,
      "tax_exclusive_amount": 664270,
      "tax_inclusive_amount": 774957,
      "payable_amount": 736798
    },
    "invoice_lines": [
      {
        "unit_measure_id": "70",
        "invoiced_quantity": 1,
        "line_extension_amount": 490000,
        "free_of_charge_indicator": false,
        "tax_totals": [
          {
            "tax_id": "1",
            "tax_amount": 93100,
            "percent": "19",
            "taxable_amount": 490000
          }
        ],
        "description": "ALOJAMIENTO",
        "notes": "",
        "code": "ALOJA",
        "type_item_identification_id": 1,
        "price_amount": 583100,
        "base_quantity": 1
      },
      {
        "unit_measure_id": "70",
        "invoiced_quantity": 1,
        "line_extension_amount": 141130,
        "free_of_charge_indicator": false,
        "tax_totals": [
          {
            "tax_id": "4",
            "tax_amount": 11290,
            "percent": "8",
            "taxable_amount": 141130
          }
        ],
        "description": "RESTAURANTE",
        "notes": "",
        "code": "RESTA",
        "type_item_identification_id": 1,
        "price_amount": 152420,
        "base_quantity": 1
      },
      {
        "unit_measure_id": "70",
        "invoiced_quantity": 1,
        "line_extension_amount": 25000,
        "free_of_charge_indicator": false,
        "tax_totals": [
          {
            "tax_id": "1",
            "tax_amount": 4750,
            "percent": "19",
            "taxable_amount": 25000
          }
        ],
        "description": "PISCINA",
        "notes": "",
        "code": "PISCIM",
        "type_item_identification_id": 1,
        "price_amount": 29750,
        "base_quantity": 1
      },
      {
        "unit_measure_id": "70",
        "invoiced_quantity": 1,
        "line_extension_amount": 8140,
        "free_of_charge_indicator": false,
        "tax_totals": [
          {
            "tax_id": "1",
            "tax_amount": 1547,
            "percent": "19",
            "taxable_amount": 8140
          }
        ],
        "description": "ROOM SERVICE",
        "notes": "",
        "code": "ROOSER",
        "type_item_identification_id": 1,
        "price_amount": 9687,
        "base_quantity": 1
      }
    ]
  }',
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer 7f67fbba91001812c960d792bab0ea8005d349dc440f0bc60e9100337ab2750d',
  ],
]);

$response = curl_exec($curl);
curl_close($curl);

echo $response;
