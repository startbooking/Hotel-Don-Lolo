<?php

require '../../../res/fpdf/fpdf.php';
require '../../../res/phpqrcode/qrlib.php'; 

// $filename = 'QR_'.$prefijo.'-'.$factura.'.png';
$filename = '../../../img/pms/QR_'.$prefijo.'-'.$factura.'.png';

$size = 100; // Tamaño en píxeles
$level = 'L'; // Nivel de corrección (L, M, Q, H)

// Generar el código QR
QRcode::png($QRStr, $filename, $level, $size);

$datosReserva = $hotel->getReservasDatos($reserva);
$datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);

$horaIng = $datosReserva['hora_llegada'];

if ($tipofac == 2) { 
    $datosCompania = $hotel->getSeleccionaCompania($idperfil);
    $diasCre = $datosCompania[0]['dias_credito'];
}

$textoResol = 'RESOLUCION DIAN No.'.$resolucion.' de '.$fechaRes.' Autorizacion Pref '.$prefijo.' desde el No. '.$desde.' AL '.$hasta;

$fechaFac = FECHA_PMS;
$fechaVen = $fechaFac;
$fechaVen = strtotime('+ '.$diasCre.' day', strtotime($fechaFac));
$fechaVen = date('Y-m-d', $fechaVen);

$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva['tipo_habitacion']);

$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($factura, $reserva, $folioAct, 1);

$pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($factura, $reserva, $folioAct, 3);
$tipoimptos = $hotel->getValorImptoFolio($factura, $reserva, $folioAct, 2);
$fecha = $hotel->getDatePms();

if($datosReserva['fecha_salida']> FECHA_PMS){
    $fechaSalida = FECHA_PMS;
}else{
    $fechaSalida = $datosReserva['fecha_salida'];
}

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 50, 190, 210);

$pdf->Image('../../../img/'.LOGO, 10, 5, 40);
$pdf->Image($filename, 163, 5, 33);


$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 4, (NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(190, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(190, 4, (ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (CIUDAD_EMPRESA).' '.PAIS_EMPRESA, 0, 1, 'C');
// $pdf->Cell(40, 4, '', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (REGIMEN), 0, 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (MAIL_HOTEL), 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (ACTIVIDAD), 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(40, 4, 'FACTURA ELECTRONICA DE VENTA', 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->setY(42);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->MultiCell(110, 4, ($textoResol), 0, 'C');
$pdf->Cell(150, 4, '', 0, 0, 'C');
$pdf->setY(46);
$pdf->setX(160);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(40, 4, 'Nro '.$prefijo.' '.str_pad($factura, 4, '0', STR_PAD_LEFT), 1, 'C');
$pdf->SetFont('Arial', '', 8);

$pdf->Ln(1);

$pdf->SetFont('Arial', 'B', 8);

if ($tipofac == 2) {
  if (!empty($datosCompania)) {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'RAZON SOCIAL', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(120, 4, substr($datosCompania[0]['empresa'],0,69), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 4, 'NIT.', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(30, 4, number_format($datosCompania[0]['nit'], 0).'-'.$datosCompania[0]['dv'], 0, 1, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'DIRECCION', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(70, 4, substr(($datosCompania[0]['direccion']), 0, 35), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 4, 'CIUDAD', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(30, 4, (substr($hotel->getCityName($datosCompania[0]['ciudad']), 0, 12)), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(21, 4, 'TELEFONO', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B');
    $pdf->Cell(20, 4, $datosCompania[0]['telefono'], 0, 1, 'L');
  }
} else {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'CLIENTE', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(70, 4, substr(($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']), 0, 30), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 4, 'IDENTIFICACION', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(25, 4, $datosHuesped[0]['identificacion'], 0, 1, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'DIRECCION', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(70, 4, ($datosHuesped[0]['direccion']), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 4, 'CIUDAD', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(30, 4, substr(($hotel->getCityName($datosHuesped[0]['ciudad'])), 0, 12), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 4, 'TELEFONO', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(15, 4, $datosHuesped[0]['telefono'], 0, 1, 'L');
}


$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 4, 'Huesped ', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 4, substr(($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']), 0, 30), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(25, 4, 'Identificacion', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 4, $datosHuesped[0]['identificacion'], 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(190, 4, (strtoupper($datosReserva['orden_reserva'])), 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(32, 4, ('ADULTOS / NIÑOS'), 1, 0, 'C');
$pdf->Cell(32, 4, 'HABITACION', 1, 0, 'C');
$pdf->Cell(32, 4, 'TARIFA', 1, 0, 'C');
$pdf->Cell(31, 4, 'HORA LLEGADA', 1, 0, 'C');
$pdf->Cell(31, 4, 'HORA SALIDA', 1, 0, 'C');
$pdf->Cell(32, 4, 'REGISTRO NRO', 1, 1, 'C');
$pdf->Cell(32, 4, $datosReserva['can_hombres'] + $datosReserva['can_mujeres'].'/'.$datosReserva['can_ninos'], 1, 0, 'C');
$pdf->Cell(32, 4, $datosReserva['num_habitacion'], 1, 0, 'C');
$pdf->Cell(32, 4, number_format($datosReserva['valor_diario'], 2), 1, 0, 'C');
$pdf->Cell(31, 4, $horaIng, 1, 0, 'C');
$pdf->Cell(31, 4, date('H:m:s'), 1, 0, 'C');
$pdf->Cell(32, 4, str_pad($datosReserva['num_registro'], 4, '0', STR_PAD_LEFT), 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(47, 4, 'FECHA LLEGADA', 1, 0, 'C');
$pdf->Cell(47, 4, 'FECHA SALIDA', 1, 0, 'C');
$pdf->Cell(48, 4, 'FECHA EXPEDICION', 1, 0, 'C');
$pdf->Cell(48, 4, 'FECHA VENCIMIENTO', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(47, 4, $datosReserva['fecha_llegada'], 1, 0, 'C');
$pdf->Cell(47, 4, FECHA_PMS, 1, 0, 'C');
$pdf->Cell(48, 4, $fechaSalida, 1, 0, 'C');
$pdf->Cell(48, 4, $fechaVen, 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln(4);
$pdf->Cell(15, 8, 'CANT', 1, 0, 'C');
$pdf->Cell(65, 8, 'CONCEPTO', 1, 0, 'C');
$pdf->Cell(30, 8, 'VALOR', 1, 0, 'C');
$pdf->Cell(20, 8, '% IMPTO', 1, 0, 'C');
$pdf->Cell(30, 8, 'IMPTO', 1, 0, 'C');
$pdf->Cell(30, 8, 'TOTAL', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);

$consumos = 0;
$impto = 0;
$pagos = 0;
$total = $consumos + $impto;
foreach ($folios as $folio1) {
    $pdf->Cell(15, 4, $folio1['cant'], 0, 0, 'C');
    $pdf->Cell(65, 4, ($folio1['descripcion_cargo']), 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($folio1['cargos'], 2), 0, 0, 'R');
    $pdf->Cell(20, 4, number_format($folio1['porcentaje_impto'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($folio1['imptos'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($folio1['cargos'] + $folio1['imptos'], 2), 0, 1, 'R');
    $consumos = $consumos + $folio1['cargos'];
    $impto = $impto + $folio1['imptos'];
    $total = $consumos + $impto;
    $pagos = $pagos + $folio1['pagos'];
}

$pdf->Cell(110, 4, '', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(50, 4, 'TOTAL ', 1, 0, 'C');
$pdf->Cell(30, 4, number_format($total, 2), 1, 1, 'R');
$pdf->Ln(1);
$pdf->setY(155);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(95, 4, 'RETENCIONES ', 1, 0, 'C');
$pdf->Cell(95, 4, 'FORMAS DE PAGO ', 1, 1, 'C');
$pdf->Cell(35, 4, 'RETENCION', 1, 0, 'C');
$pdf->Cell(30, 4, 'BASE', 1, 0, 'R');
$pdf->Cell(30, 4, 'VALOR', 1, 0, 'R');
$pdf->Cell(60, 4, 'DETALLE', 1, 0, 'C');
$pdf->Cell(35, 4, 'VALOR', 1, 1, 'R');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(35, 4, 'RETEFUENTE', 1, 0, 'L');
$pdf->Cell(30, 4, number_format($baseRete, 2), 1, 0, 'R');
$pdf->Cell(30, 4, number_format($retefuente, 2), 1, 1, 'R');
$pdf->Cell(35, 4, 'RETEIVA', 1, 0, 'L');
$pdf->Cell(30, 4, number_format($baseIva, 2), 1, 0, 'R');
$pdf->Cell(30, 4, number_format($reteiva, 2), 1, 1, 'R');
$pdf->Cell(35, 4, 'RETEICA', 1, 0, 'L');
$pdf->Cell(30, 4, number_format($baseIca, 2), 1, 0, 'R');
$pdf->Cell(30, 4, number_format($reteica, 2), 1, 1, 'R');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(50, 4, 'TOTAL RETENCIONES', 1, 0, 'L');
$pdf->Cell(45, 4, number_format($reteiva + $reteica + $retefuente, 2), 1, 1, 'R');
$pdf->SetFont('Arial', '', 8);

$pagos = 0;
$pdf->setY(163);
$pdf->setX(105);

$pdf->SetFont('Arial', '', 8);
foreach ($pagosfolio as $pagofolio) {
    $pdf->setX(105);
    $pagos = $pagos + $pagofolio['pagos'];
    $pdf->Cell(60, 4, $pagofolio['descripcion_cargo'], 0, 0, 'L');
    $pdf->Cell(35, 4, number_format($pagofolio['pagos'], 2), 0, 1, 'R');
}
$pdf->Cell(95, 4, '', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(60, 4, 'TOTAL ', 1, 0, 'C');
$pdf->Cell(35, 4, number_format($pagos, 2), 1, 1, 'R');
$pdf->setY(190);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(95, 5, 'IMPUESTOS', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(45, 5, 'TIPO IMPUESTO', 1, 0, 'C');
$pdf->Cell(20, 5, 'BASE', 1, 0, 'C');
$pdf->Cell(30, 5, 'VALOR', 1, 1, 'C');

foreach ($tipoimptos as $tipoimpto) {
    $pdf->Cell(45, 4, $tipoimpto['descripcion_cargo'], 0, 0, 'L');
    $pdf->Cell(20, 4, number_format($tipoimpto['cargos'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($tipoimpto['imptos'], 2), 0, 1, 'R');
}
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(190, 4, 'SON :'.numtoletras($total), 1, 'L');
$pdf->SetFont('Arial', '', 6);
$pdf->MultiCell(190, 4, ('Factura Nro : ').$prefijo.' '.$factura.' '.(' Fecha Validación Dian ').$timeCreated.' CUFE '.$cufe, 1, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->MultiCell(190, 5, ('Observaciones ').(strtoupper($detalle)).' '.(strtoupper($refer)), 1, 'L');
$pdf->setY(226);
$pdf->SetFont('Arial', '', 7);
$pdf->MultiCell(95, 4, (TEXTOBANCO).', '.(TEXTOFACTURA), 1, 'C');
$y = $pdf->GetY();
$pdf->SetY(226);
$pdf->SetX(105);
$pdf->SetFont('Arial', '', 8);

$pdf->MultiCell(95, 6, '
                        Nombre                                             Identificacion

                        Firma                                              Fecha', 1, 'L');
$pdf->SetY(245);
$pdf->Cell(40, 5, 'FACTURADO POR :', 1, 0, 'C');
$pdf->Cell(55, 5, $usuario, 1, 1, 'L');

$pdf->SetY(250);

$pdf->Ln(1);

$pdf->SetFont('Arial', '', 6);

$pdf->MultiCell(190, 4, (PIEFACTURA), 0, 'C');

$file = '../../imprimir/facturas/FES-' . $prefijo . $factura . '.pdf';

$pdf->Output($file, 'F');
$oFile = 'FES-' . $prefijo . $factura . '.pdf';

$pdfFile = $pdf->Output('', 'S');
$base64Factura = chunk_split(base64_encode($pdfFile));

?>

