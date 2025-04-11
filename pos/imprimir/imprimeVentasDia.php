<?php

require_once '../../res/fpdf/fpdf.php';

$ventas = $pos->getVentasdelDia($idamb);

$pdf = new FPDF();
$pdf->AddPage('L', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(260, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(260, 5, 'VENTAS DEL DIA ', 0, 1, 'C');
$pdf->Cell(260, 5, 'Fecha '.$fecha, 0, 1, 'C');
$pdf->Ln(1);
$pers = 0;
$neto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$propina = 0;
$servicio = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, 'Cuenta.', 1, 0, 'C');
$pdf->Cell(20, 6, 'Comanda ', 1, 0, 'C');
$pdf->Cell(10, 6, 'Mesa ', 1, 0, 'C');
$pdf->Cell(10, 6, 'Pers. ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Val Neto ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Room Serv.', 1, 0, 'C');
$pdf->Cell(20, 6, 'Propina', 1, 0, 'C');
$pdf->Cell(20, 6, 'Impuesto', 1, 0, 'C');
$pdf->Cell(20, 6, 'Val Total ', 1, 0, 'C');
$pdf->Cell(40, 6, 'Forma de Pago. ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Estado ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Usuario ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Hora ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

if (count($ventas) == 0) {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(255, 5, 'SIN VENTAS EN EL DIA', 1, 1, 'C');
} else {
    foreach ($ventas as $comanda) {
        if ($comanda['estado'] != 'A') {
            $pdf->SetTextColor(127, 5, 42);
        } else {
            $pdf->SetTextColor(0, 0, 0);
        }
        $pdf->Cell(20, 5, $comanda['factura'], 0, 0, 'L');
        $pdf->Cell(20, 5, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(10, 5, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(10, 5, $comanda['pax'], 0, 0, 'C');
        $pdf->Cell(20, 5, number_format($comanda['valor_neto'], 2), 0, 0, 'R');
        $pdf->Cell(20, 5, number_format($comanda['servicio'], 2), 0, 0, 'R');
        $pdf->Cell(20, 5, number_format($comanda['propina'], 2), 0, 0, 'R');
        $pdf->Cell(20, 5, number_format($comanda['impuesto'], 2), 0, 0, 'R');
        $pdf->Cell(20, 5, number_format($comanda['pagado'] - $comanda['cambio'], 2), 0, 0, 'R');
        $pdf->Cell(40, 5, substr($comanda['descripcion'], 0, 18), 0, 0, 'L');
        $pdf->Cell(20, 5, estadoFacturaInf($comanda['estado']), 0, 0, 'L');
        $pdf->Cell(25, 5, $comanda['usuario_factura'], 0, 0, 'L');
        $pdf->Cell(20, 5, date('H:m:i', strtotime($comanda['fecha_factura'])), 0, 1, 'R');
        if ($comanda['estado'] == 'A') {
            $pers += $comanda['pax'];
            $neto += $comanda['valor_neto'];
            $impto += $comanda['impuesto']; 
            $propina += $comanda['propina'];
            $servicio += $comanda['servicio'];
            $total = $total + ($comanda['pagado'] - $comanda['cambio']);
        }
        $pdf->SetTextColor(0, 0, 0);
    }
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 6, '', 1, 0, 'L');
    $pdf->Cell(20, 6, 'Pers ', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Valor Neto ', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Room Service ', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Propinas ', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Impuesto ', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Total Factura ', 1, 1, 'C');
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 6, 'TOTALES ', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(20, 6, number_format($pers, 0), 1, 0, 'R');
    $pdf->Cell(30, 6, number_format($neto, 2), 1, 0, 'R');
    $pdf->Cell(30, 6, number_format($servicio, 2), 1, 0, 'R');
    $pdf->Cell(30, 6, number_format($propina, 2), 1, 0, 'R');
    $pdf->Cell(30, 6, number_format($impto, 2), 1, 0, 'R');
    $pdf->Cell(30, 6, number_format($total, 2), 1, 1, 'R');
}
$pdf->Ln(1);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
