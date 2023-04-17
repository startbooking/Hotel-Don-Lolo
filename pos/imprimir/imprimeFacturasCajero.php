<?php

$detalles = $pos->getDetalleFacturaCajerosDia('A', $user, $idamb);

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('L', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 22);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(260, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 6, 'FACTURAS DIA CAJERO ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(260, 5, 'Usuario '.$user.' Fecha '.$fecha, 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 5, 'Fact.', 1, 0, 'C');
$pdf->Cell(25, 5, 'Neto ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Impuesto ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Propina ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Descuento ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Abonos ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Pagado ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Total ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Usuario ', 1, 0, 'C');
$pdf->Cell(40, 5, 'Forma de Pago ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Hora ', 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$desc = 0;
$abon = 0;
$pago = 0;
if (count($detalles) == 0) {
    $pdf->Cell(260, 5, 'SIN FACTURAS GENERADAS', 1, 1, 'C');
} else {
    foreach ($detalles as $detalle) {
        $fact = $fact + 1;
        $neto = $neto + $detalle['valor_neto'];
        $impt = $impt + $detalle['impuesto'];
        $prop = $prop + $detalle['propina'];
        $desc = $desc + $detalle['descuento'];
        $abon = $abon + $detalle['abonos'];
        $pago = $pago + $detalle['pagado'];
        $tota = $tota + $detalle['pagado'] + $detalle['abonos'];

        $pdf->Cell(15, 5, $detalle['factura'], 1, 0, 'R');
        $pdf->Cell(25, 5, number_format($detalle['valor_neto'], 2), 1, 0, 'R');
        $pdf->Cell(20, 5, number_format($detalle['impuesto'], 2), 1, 0, 'R');
        $pdf->Cell(20, 5, number_format($detalle['propina'], 2), 1, 0, 'R');
        $pdf->Cell(20, 5, number_format($detalle['descuento'], 2), 1, 0, 'R');
        $pdf->Cell(20, 5, number_format($detalle['abonos'], 2), 1, 0, 'R');
        $pdf->Cell(25, 5, number_format($detalle['pagado'], 2), 1, 0, 'R');
        $pdf->Cell(25, 5, number_format($detalle['pagado'] + $detalle['abonos'], 2), 1, 0, 'R');
        $pdf->Cell(30, 5, $detalle['usuario'], 1, 0, 'L');
        $pdf->Cell(40, 5, substr($pos->nombrePago($detalle['forma_pago']), 0, 19), 1, 0, 'L');
        $pdf->Cell(20, 5, substr($detalle['fecha_factura'], 11, 8), 1, 1, 'R');
    }
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(15, 5, '', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Neto', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Impuesto', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Propina', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Descuentos', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Abonos', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Pagado', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Total', 1, 1, 'C');
    $pdf->Cell(15, 5, 'Total', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(25, 5, number_format($neto, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($impt, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($prop, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($desc, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($abon, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($pago, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($tota, 2), 1, 1, 'R');
}
$pdf->Ln(5);

/*   $file = '../imprimir/informes/'.$file.'.pdf';
  $pdf->Output($file,'F');
 */
$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
