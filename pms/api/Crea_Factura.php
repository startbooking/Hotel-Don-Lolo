<?php

echo 'Entro';

$curl = curl_init();

echo 'Inicio ';

curl_setopt_array($curl, [
  CURLOPT_URL => 'http://servidordefacturacion.com:81/api/ubl2.1/invoice',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{
	"number": 63677,
	"type_document_id": 1,
	"date": "2022-12-07",
	"time": "04:08:12",
	"resolution_number": "18764040460991",
	"prefix": "ELP",
  "notes": "ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA",
  "disable_confirmation_text": true,
	"sendmail": true,
	"sendmailtome": true,
	"head_note": "PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL ENCABEZADO DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN",
	"foot_note": "PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL PIE DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN",
	"customer": {
		"identification_number": 1017129099,
		"dv": 7,
		"name": "JUAN CARLOS DELGADO",
		"phone": "3013391116",
		"address": "CLL 4 NRO 33-90",
		"email": "juandelagado@gmail.com",
		"merchant_registration": "0000000-00",
		"type_document_identification_id": 3,
		"type_organization_id": 2,
        "type_liability_id": 117,
		"municipality_id": 822,
		"type_regime_id": 2
	},
	"payment_form": {
		"payment_form_id": 2,
		"payment_method_id": 30,
		"payment_due_date": "2023-01-07",
		"duration_measure": "30"
	},	
	"allowance_charges": [
		{
			"discount_id": 1,
			"charge_indicator": false,
			"allowance_charge_reason": "DESCUENTO GENERAL",
			"amount": "50.00",
			"base_amount": "1000.00"
		}
	],
	"legal_monetary_totals": {
		"line_extension_amount": "840.336134",
		"tax_exclusive_amount": "840.336134",
		"tax_inclusive_amount": "1000.00",
		"allowance_total_amount": "50.00",
		"payable_amount": "950.00"
	},
	"tax_totals": 
	[
		{
			"tax_id": 1,
			"tax_amount": "159.663865",
			"percent": "19",
			"taxable_amount": "840.336134"
		}
	],
	"invoice_lines": 
	[
		{
			"unit_measure_id": 70,
			"invoiced_quantity": "1",
			"line_extension_amount": "840.336134",
			"free_of_charge_indicator": false,
			"tax_totals": [
				{
					"tax_id": 1,
					"tax_amount": "159.663865",
					"taxable_amount": "840.336134",
					"percent": "19.00"
				}
			],
			"description": "COMISION POR SERVICIOS",
            "notes": "ESTA ES UNA PRUEBA DE NOTA DE DETALLE DE LINEA.",
			"code": "COMISION",
			"type_item_identification_id": 4,
			"price_amount": "1000.00",
			"base_quantity": "1"
		}
	]
}

',
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer 88ffa79e99bb9cd025c5a95313495533ac38cb12438d751c74c8cc2466c401c1',
  ],
]);

$response = curl_exec($curl);

curl_close($curl);
echo $response;
