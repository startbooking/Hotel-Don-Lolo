<?php

$periodos = $pos->getVentasPeriodosDia($idamb);

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 11);

$pdf->Cell(195, 5, $nomamb, 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'VENTAS POR PERIODOS DE SERVICIO ', 0, 1, 'C');
$pdf->Cell(195, 5, 'Fecha '.$fecha, 0, 1, 'C');
$neto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$canti = 0;
$servi = 0;
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 5, 'Periodo de Servicio', 1, 0, 'C');
$pdf->Cell(25, 5, 'Valor ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Room Service ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Impuesto ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Total ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($periodos) == 0) {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(190, 5, 'SIN PRODUCTOS VENDIDOS EN EL DIA', 1, 1, 'C');
} else {
    foreach ($periodos as $comanda) {
        $pdf->Cell(90, 4, utf8_decode($comanda['descripcion_periodo']), 0, 0, 'L');
        $pdf->Cell(25, 4, number_format($comanda['neto'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['servicio'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['imptos'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($comanda['total'], 2), 0, 1, 'R');
        // $valprod = $valprod + $comanda['ventas'];
        $neto += $comanda['neto'];
        $servi += $comanda['servicio'];
        $impto += $comanda['imptos'];
        $total += $comanda['total'];
    }
    // $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(90, 5, 'Total ', 1, 0, 'L');
    $pdf->Cell(25, 5, number_format($neto, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($servi, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($impto, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($total, 2), 1, 1, 'R');
    $pdf->SetFont('Arial', '', 9);
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));
echo $base64String;
