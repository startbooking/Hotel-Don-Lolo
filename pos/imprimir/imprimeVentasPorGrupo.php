<?php

$ventas = $pos->getTotalGruposVendidos($idamb);
$cantidad = $pos->getCantidadProductosVendidos($idamb);

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
$pdf->Image('../../img/'.LOGO, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(195, 5, $_SESSION['NOMBRE_AMBIENTE'], 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'VENTAS GRUPOS DE PRODUCTOS ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 9);

$monto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$canti = 0;
$desc = 0;
$pdf->Cell(60, 6, 'Grupo Productos', 1, 0, 'C');
$pdf->Cell(10, 6, 'Cant ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Valor. ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Impuesto. ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Descuento. ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Total. ', 1, 0, 'C');
$pdf->Cell(20, 6, '% Cant. ', 1, 0, 'C');
$pdf->Cell(20, 6, '% Valor. ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
if (count($ventas) == 0) {
    $pdf->Cell(190, 5, 'SIN PRODUCTOS VENDIDOS EN EL DIA', 1, 1, 'C');
} else {
    foreach ($ventas as $comanda) {
        $pdf->Cell(60, 4, utf8_decode($comanda['nombre_seccion']), 0, 0, 'L');
        $pdf->Cell(10, 4, $comanda['cant'], 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['ventas'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['imptos'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['descuento'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['total'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format(($comanda['cant'] / $canProd) * 100, 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format(($comanda['ventas'] / $valProd) * 100, 2), 0, 1, 'R');
        $valprod = $valprod + $comanda['ventas'];
        $canti = $canti + $comanda['cant'];
        $monto = $monto + $comanda['ventas'];
        $impto = $impto + $comanda['imptos'];
        $desc = $desc + $comanda['descuento'];
        $total = $total + $comanda['total'];
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Ln(2);
    $pdf->Cell(60, 6, 'Total ', 1, 0, 'L');
    $pdf->Cell(10, 6, number_format($canti, 0), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($monto, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($impto, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($desc, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($monto + $impto - $desc, 2), 1, 1, 'R');
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));
echo $base64String;
