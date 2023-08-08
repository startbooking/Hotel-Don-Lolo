<?php

require '../../../res/fpdf/fpdf.php';

$mmto = $hotel->getInformacionMantenimiento($adicional);
$numHab = $hotel->getNumeroHab($mmto[0]['id_habitacion']);
$infommto = $hotel->descripcionGrupo($mmto[0]['id_mantenimiento']);
$fecha = $hotel->getDatePms();

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 52, 195, 80);
$pdf->Image('../../../img/'.LOGO, xPOS, yPOS, tPOS);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(195, 7, utf8_decode(NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(195, 5, REGIMEN, 0, 1, 'C');
$pdf->Cell(195, 5, utf8_decode(ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(195, 5, utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA, 0, 1, 'C');
$pdf->Cell(40, 5, '', 0, 0, 'C');
$pdf->Cell(110, 5, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, NAME_HOTEL, 0, 1, 'C');
$pdf->Ln(5);
$pdf->Cell(195, 5, 'ORDER DE TRABAJO ', 1, 1, 'C');
$pdf->Ln(2);
$pdf->Cell(20, 5, 'Fecha ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, FECHA_PMS, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, 'Nro ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(15, 5, str_pad($numero, 5, '0', STR_PAD_LEFT), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, 'Desde ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 5, $mmto[0]['desde_fecha'], 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, 'Hasta ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 5, $mmto[0]['hasta_fecha'], 0, 0, 'L');
// / $pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, 'Habitacion', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, $numHab, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 5, 'Mantenimiento ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80, 5, utf8_decode($infommto), 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, 'Observaciones', 0, 1, 'L');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(195, 5, utf8_decode($mmto[0]['observaciones']), 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, 'Comentarios', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(16);

$pdf->Cell(40, 5, 'USUARIO ', 1, 0, 'L');
$pdf->Cell(30, 5, $usuario, 1, 0, 'C');
$pdf->Cell(35, 5, '', 1, 0, 'C');
$pdf->Cell(40, 5, 'Fecha Ingreso ', 1, 0, 'L');
$pdf->Cell(50, 5, $mmto[0]['fecha_mmto'], 1, 1, 'C');

$file = '../../imprimir/mmtos/order_Mantenimiento_'.$numero.'.pdf';

$pdf->Output($file, 'F');

echo 'order_Mantenimiento_'.$numero.'.pdf';
