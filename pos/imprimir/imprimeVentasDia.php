<?php

require_once '../../res/fpdf/fpdf.php';

$ventas = $pos->getVentasdelDia($idamb);

$pdf = new FPDF();
$pdf->AddPage('L', 'letter');
$pdf->Image('../../img/'.LOGO, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 6, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(260, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(260, 5, 'VENTAS DEL DIA ', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(260, 5, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(2);

$pers = 0;
$neto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$propina = 0;
$descuento = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 6, 'Fact.', 1, 0, 'C');
$pdf->Cell(25, 6, 'Neto ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Impuesto ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Propina ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Descuento ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Abonos ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Pagado ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Total ', 1, 0, 'C');
$pdf->Cell(30, 6, 'Usuario ', 1, 0, 'C');
$pdf->Cell(40, 6, 'Forma de Pago ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Hora ', 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);

if (count($ventas) == 0) {
    $pdf->Cell(260, 5, 'SIN VENTAS EN EL DIA', 1, 1, 'C');
} else {
    $fact = 0;
    $neto = 0;
    $impt = 0;
    $prop = 0;
    $tota = 0;
    $desc = 0;
    $abon = 0;
    $pago = 0;

    foreach ($ventas as $detalle) {
        if ($detalle['estado'] != 'X') {
            $pdf->SetTextColor(0, 0, 0);
            $fact = $fact + 1;
            $neto = $neto + $detalle['valor_neto'];
            $impt = $impt + $detalle['impuesto'];
            $prop = $prop + $detalle['propina'];
            $desc = $desc + $detalle['descuento'];
            $abon = $abon + $detalle['abonos'];
            $pago = $pago + $detalle['pagado'];
            $tota = $tota + $detalle['pagado'] + $detalle['abonos'];
        } else {
            $pdf->SetTextColor(150, 25, 0);
        }

        $pdf->Cell(15, 6, $detalle['factura'], 1, 0, 'R');
        $pdf->Cell(25, 6, number_format($detalle['valor_neto'], 2), 1, 0, 'R');
        $pdf->Cell(20, 6, number_format($detalle['impuesto'], 2), 1, 0, 'R');
        $pdf->Cell(20, 6, number_format($detalle['propina'], 2), 1, 0, 'R');
        $pdf->Cell(20, 6, number_format($detalle['descuento'], 2), 1, 0, 'R');
        $pdf->Cell(20, 6, number_format($detalle['abonos'], 2), 1, 0, 'R');
        $pdf->Cell(25, 6, number_format($detalle['pagado'], 2), 1, 0, 'R');
        $pdf->Cell(25, 6, number_format($detalle['pagado'] + $detalle['abonos'], 2), 1, 0, 'R');
        $pdf->Cell(30, 6, $detalle['usuario'], 1, 0, 'L');
        $pdf->Cell(40, 6, substr($pos->nombrePago($detalle['forma_pago']), 0, 19), 1, 0, 'L');
        $pdf->Cell(20, 6, substr($detalle['fecha_factura'], 11, 8), 1, 1, 'R');
    }
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 6, 'Total', 1, 0, 'C');
    $pdf->Cell(25, 6, number_format($neto, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($impt, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($prop, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($desc, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($abon, 2), 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($pago, 2), 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($tota, 2), 1, 1, 'R');
}
$pdf->Ln(3);


$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
