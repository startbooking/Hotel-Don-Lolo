<?php

require '../../../res/fpdf/fpdf.php';
require '../../../res/phpqrcode/qrlib.php';

if ($tipofac == 2) {
    $datosCompania = $hotel->getSeleccionaCompania($idperfil);
} else {
    $datosHuesped = $hotel->getbuscaDatosHuesped($idperfil);
}

$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($numero, $reserva, $nroFolio, 1);

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 43, 190, 105);
$pdf->Image('../../../img/'.LOGO, 10, 5, 35);
// $pdf->Image($filename, 173, 5, 25);
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
$pdf->Cell(110, 4, (MAIL_HOTEL), 0, 0, 'C');
$pdf->MultiCell(40, 4, 'NOTA CREDITO', 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(40, 4, 'Nro '.$prefNC.'-'.str_pad($numDoc, 4, '0', STR_PAD_LEFT), 1, 'C');
$pdf->SetFont('Arial', '', 7);

$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (ACTIVIDAD), 0, 0, 'C');
$pdf->MultiCell(40, 4, 'Fecha / Hora '.date('Y-m-d H:m:s'), 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->setY(42);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Ln(1);

if ($tipofac == 2) {
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'RAZON SOCIAL', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(120, 4, ($datosCompania[0]['empresa']), 0, 0, 'L');
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

$pdf->Cell(15, 6, 'CANT', 1, 0, 'C');
$pdf->Cell(65, 6, 'CONCEPTO', 1, 0, 'C');
$pdf->Cell(30, 6, 'VALOR', 1, 0, 'C');
$pdf->Cell(20, 6, '% IMPTO', 1, 0, 'C');
$pdf->Cell(30, 6, 'IMPTO', 1, 0, 'C');
$pdf->Cell(30, 6, 'TOTAL', 1, 1, 'C');
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
$pdf->SetFont('Arial', '', 7);

$pdf->MultiCell(190, 4, 'SON :'.numtoletras($total), 1, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->MultiCell(190, 4, ('FACTURA ANULADA NRO: '.$prefijo.' '.$numero.' MOTIVO : '.$motivo), 1, 'J');
/* $pdf->MultiCell(190, 4, ('CUFE: '.$uuid), 1, 'J');
$pdf->MultiCell(190, 4, ('CUDE: '.$cude), 1, 'J'); */

$pdf->SetFont('Arial', '', 8);

$pdf->SetY(133);
$pdf->Cell(95, 5, 'ELABORADO POR ', 0, 0, 'C');
$pdf->Cell(95, 5, 'RECIBO ', 0, 1, 'C');
$pdf->Cell(95, 5, $usuario, 0, 0, 'C');
$pdf->Cell(95, 5, 'C.C - NIT.', 0, 1, 'C');
$arcPdf = 'NotaCredito_'.$numDoc.'.pdf';

$file = '../../imprimir/notas/'.$arcPdf;

$pdf->Output($file, 'F');

$pdfFile = $pdf->Output('', 'S');
$base64NC = chunk_split(base64_encode($pdfFile));

echo $file;

?>

