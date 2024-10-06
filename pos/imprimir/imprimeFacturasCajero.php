<?php

$detalles = $pos->getDetalleFacturaCajerosDia('A', $user, $idamb);

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('L', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(260, 5, 'Usuario '.$user.' Fecha '.$fecha, 0, 1, 'C');
$pdf->Cell(260, 5, 'FACTURAS GENERADAS POR CAJERO', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 5, 'Fact.', 1, 0, 'C');
$pdf->Cell(15, 5, 'Com. ', 1, 0, 'C');
$pdf->Cell(15, 5, 'Mesa ', 1, 0, 'C');
$pdf->Cell(15, 5, 'Pax ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Neto ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Impuesto ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Propina ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Room Service ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Total Fact ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Usuario ', 1, 0, 'C');
$pdf->Cell(40, 5, 'Forma de Pago ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Hora ', 1, 1, 'C'); 

$pdf->SetFont('Arial', '', 9);
$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$serv = 0;

if (count($detalles) == 0) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(260, 5, 'SIN VENTAS EN EL DIA ', 1, 1, 'C');
} else {
    foreach ($detalles as $detalle) {
        $fact += 1;
        $neto += $detalle['valor_neto'];
        $impt += $detalle['impuesto'];
        $prop += $detalle['propina'];
        $serv += $detalle['servicio'];
        $tota = $tota + $detalle['pagado'] - $detalle['cambio'];

        $pdf->Cell(15, 4, $detalle['factura'], 0, 0, 'R');
        $pdf->Cell(15, 4, $detalle['comanda'], 0, 0, 'R');
        $pdf->Cell(15, 4, $detalle['mesa'], 0, 0, 'R');
        $pdf->Cell(15, 4, $detalle['pax'], 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($detalle['valor_neto'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($detalle['impuesto'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($detalle['propina'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($detalle['servicio'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($detalle['pagado'] - $detalle['cambio'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, $detalle['usuario'], 0, 0, 'L');
        $pdf->Cell(40, 4, substr($pos->nombrePago($detalle['forma_pago']), 0, 19), 0, 0, 'L');
        $pdf->Cell(20, 4, substr($detalle['fecha_factura'], 11, 8), 0, 1, 'R');
    }
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 6, 'Total', 1, 0, 'L');
    $pdf->Cell(25, 6, number_format($neto, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($impt, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($prop, 2), 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($serv, 2), 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($tota, 2), 1, 1, 'R');
    $pdf->SetFont('Arial', '', 10);

}

$pdf->Ln(5);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
