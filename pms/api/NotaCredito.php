<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://servidordefacturacion.com:81/api/ubl2.1/credit-note',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"billing_reference": {
		"number": "SETP990000674",
		"uuid": "9e9fa66bcea1f92908dd0c372c4960946bc5941060b7440c2ef0acd1c8c1a955e2d45e92afc99bdccc58e9711dbefac6",
		"issue_date": "2022-11-17"
	},
	"discrepancyresponsecode": 2,
	"discrepancyresponsedescription": "PRUEBA DE MOTIVO NOTA CREDITO",
    "notes": "PRUEBA DE NOTA CREDITO",
    "resolution_number": "0000000000",
    "prefix": "NC",
	"number": 65,
	"type_document_id": 4,
	"date": "2022-11-17",
	"time": "06:00:13",
    "establishment_name": "TORRE SOFTWARE",
    "establishment_address": "BRR LIMONAR MZ 6 CS 3 ET 1 PISO 2",
    "establishment_phone": "3226563672",
    "establishment_municipality": 600,
    "sendmail": true,
    "sendmailtome": true,
    "seze": "2021-2017",
    "head_note": "PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL ENCABEZADO DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN",
    "foot_note": "PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL ENCABEZADO DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN",
	"customer": {
		"identification_number": 800135582,
		"dv": 7,
		"name": "FUNDACION ALEJANDRO LONDOÑO",
		"phone": "3105193539",
		"address": "CLL 4 NRO 33-90",
		"email": "gerencia@torresoftware.com",
		"merchant_registration": "0000000-00",
		"type_document_identification_id": 6,
		"type_organization_id": 1,
        "type_liability_id": 117,
		"municipality_id": 822,
		"type_regime_id": 1
	},
	"allowance_charges": [
		{
			"discount_id": 1,
			"charge_indicator": false,
			"allowance_charge_reason": "DESCUENTO GENERAL",
			"amount": "50000.00",
			"base_amount": "1000000.00"
		}
	],
	"legal_monetary_totals": {
		"line_extension_amount": "840336.134",
		"tax_exclusive_amount": "840336.134",
		"tax_inclusive_amount": "1000000.00",
		"allowance_total_amount": "50000.00",
		"payable_amount": "950000.00"
	},
	"tax_totals": 
	[
		{
			"tax_id": 1,
			"tax_amount": "159663.865",
			"percent": "19",
			"taxable_amount": "840336.134"
		}
	],
	"credit_note_lines": 
	[
		{
			"unit_measure_id": 70,
			"invoiced_quantity": "1",
			"line_extension_amount": "840336.134",
			"free_of_charge_indicator": false,
			"tax_totals": [
				{
					"tax_id": 1,
					"tax_amount": "159663.865",
					"taxable_amount": "840336.134",
					"percent": "19.00"
				}
			],
			"description": "COMISION POR SERVICIOS",
            "notes": "ESTA ES UNA PRUEBA DE NOTA DE DETALLE DE LINEA.",
			"code": "COMISION",
			"type_item_identification_id": 4,
			"price_amount": "1000000.00",
			"base_quantity": "1"
		}
	]
}
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer 7692a20fec92af0aa5729d796b019d27c83c9955407994630a0cdd7702ca2329'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
