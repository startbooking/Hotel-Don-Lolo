<?php

require_once '../../res/fpdf/fpdf.php';

$ventas = $pos->getVentasCreditodelDia($idamb);

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'VENTAS CREDITO ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Fecha'.$fecha, 0, 1, 'C');
$pdf->Ln(2);

$pers = 0;
$neto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$propina = 0;
$descuento = 0;
$canti = 0;
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 6, 'Factura.', 1, 0, 'C');
$pdf->Cell(90, 6, 'Cliente ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Val Total ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Estado ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Usuario ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Hora ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

if (count($ventas) == 0) {
    $pdf->Cell(195, 5, 'SIN VENTAS CREDITO EN EL DIA', 1, 1, 'C');
} else {
    foreach ($ventas as $comanda) {
        ++$canti;
        if ($comanda['estado'] != 'A') {
            $pdf->SetTextColor(127, 5, 42);
        } else {
            $pdf->SetTextColor(0, 0, 0);
        }
        $pdf->Cell(20, 5, $comanda['factura'], 0, 0, 'R');
        $pdf->Cell(90, 5, utf8_decode($comanda['apellido1'].' '.$comanda['apellido2'].' '.$comanda['nombre1'].' '.$comanda['nombre2']), 0, 0, 'L');
        $pdf->Cell(20, 5, number_format($comanda['pagado'], 2), 0, 0, 'R');
        $pdf->Cell(20, 5, estadoFacturaInf($comanda['estado']), 0, 0, 'L');
        $pdf->Cell(25, 5, $comanda['usuario_factura'], 0, 0, 'L');
        $pdf->Cell(20, 5, substr($comanda['fecha_factura'], 11, 9), 0, 1, 'L');
        if ($comanda['estado'] == 'A') {
            $pers = $pers + $comanda['pax'];
            $neto = $neto + $comanda['valor_neto'];
            $impto = $impto + $comanda['impuesto'];
            $propina = $propina + $comanda['propina'];
            $descuento = $descuento + $comanda['descuento'];
            $total = $total + $comanda['pagado'];
        }
    }
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 6, '', 1, 0, 'L');
    $pdf->Cell(20, 6, 'Facturas ', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Valor Facturas ', 1, 1, 'C');
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 6, 'TOTALES ', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(20, 6, $canti, 1, 0, 'R');
    $pdf->Cell(30, 6, number_format($total, 2), 1, 1, 'R');
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));
echo $base64String;
