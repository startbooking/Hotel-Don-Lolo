<?php

$ventas = $pos->getTotalFormaPagoVendidos($idamb);
$cantidad = $pos->getCantidadFormasPagoVendidos($idamb);

if (count($cantidad) == 0) {
    $canProd = 0;
    $valProd = 0;
    $perProd = 0;
} else {
    $canProd = $cantidad[0]['cant'];
    $valProd = $cantidad[0]['ventas'];
    $perProd = $cantidad[0]['pers'];
}

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 5, $_SESSION['NOMBRE_AMBIENTE'], 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'VENTAS POR FORMA DE PAGO ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(2);

$monto = 0;
$neto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$descuen = 0;
$pagado = 0;
$cambio = 0;
$abono = 0;
$canti = 0;
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(60, 5, 'Forma de Pago', 1, 0, 'C');
$pdf->Cell(10, 5, 'Cant', 1, 0, 'C');
$pdf->Cell(20, 5, 'Valor', 1, 0, 'C');
$pdf->Cell(20, 5, 'Impuesto', 1, 0, 'C');
$pdf->Cell(20, 5, 'Pagado', 1, 0, 'C');
$pdf->Cell(15, 5, '% Cant', 1, 0, 'C');
$pdf->Cell(15, 5, '% Valor', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
if (count($ventas) == 0) {
    $pdf->Cell(200, 5, 'SIN PRODUCTOS VENDIDOS EN EL DIA', 1, 1, 'C');
} else {
    foreach ($ventas as $comanda) {
        $pdf->Cell(60, 4, substr(($comanda['descripcion']), 0, 32), 0, 0, 'L');
        $pdf->Cell(10, 4, $comanda['cant'], 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['neto'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['imptos'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['pagado'], 2), 0, 0, 'R');
        $pdf->Cell(15, 4, number_format(($comanda['cant'] / $canProd) * 100, 2), 0, 0, 'R');
        $pdf->Cell(15, 4, number_format(($comanda['ventas'] / $valProd) * 100, 2), 0, 1, 'R');
        $valprod += $comanda['ventas'];
        $descuen += $comanda['descuento'];
        $canti += $comanda['cant'];
        $monto += $comanda['ventas'];
        $neto += $comanda['neto'];
        $impto += $comanda['imptos'];
        $pagado += $comanda['pagado'];
        $cambio += $comanda['cambio'];
        $abono += $comanda['abonos'];
        $total += $comanda['total'];
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(60, 5, 'Total ', 1, 0, 'L');
    $pdf->Cell(10, 5, number_format($canti, 0), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($neto, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($impto, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($pagado, 2), 1, 1, 'R');
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));
echo $base64String;
