<?php
require_once '../../res/php/app_topPos.php';
require_once '../../res/fpdf/fpdf.php';
extract($_POST);

$ventas = $pos->getTotalProductosVendidos($id_ambiente);
$cantidad = $pos->getCantidadProductosVendidos($id_ambiente);

if (count($cantidad) == 0) {
    $canProd = 0;
    $valProd = 0;
    $perProd = 0;
} else {
    $canProd = $cantidad[0]['cant'];
    $valProd = $cantidad[0]['ventas'];
    $perProd = $cantidad[0]['pers'];
}


$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(195, 4, NAME_EMPRESA, 0, 1, 'C');
$pdf->Cell(195, 4, $nombre, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 4, 'VENTAS POPULARIDAD DE PRODUCTOS ', 0, 1, 'C');
$pdf->Cell(195, 4, 'Fecha '.$fecha_auditoria, 0, 1, 'C');
$monto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$descuen = 0;
$canti = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(60, 5, 'Producto.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Cantidad ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Valor. ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Impuesto. ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Total. ', 1, 0, 'C');
$pdf->Cell(20, 5, '% Cant. ', 1, 0, 'C');
$pdf->Cell(20, 5, '% Valor. ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($ventas) == 0) {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(200, 5, 'SIN PRODUCTOS VENDIDOS EN EL DIA', 1, 1, 'C');
} else {
    foreach ($ventas as $comanda) {
        $pdf->Cell(60, 4, substr(($comanda['nom']), 0, 32), 0, 0, 'L');
        $pdf->Cell(20, 4, $comanda['cant'], 0, 0, 'C');
        $pdf->Cell(20, 4, number_format($comanda['ventas'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['imptos'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['total'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format(($comanda['cant'] / $canProd) * 100, 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format(($comanda['ventas'] / $valProd) * 100, 2), 0, 1, 'R');
        $valprod = $valprod + $comanda['ventas'];
        $descuen = $descuen + $comanda['descuento'];
        $canti = $canti + $comanda['cant'];
        $monto = $monto + $comanda['ventas'];
        $impto = $impto + $comanda['imptos'];
        $total = $total + $comanda['total'];
    }
    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 9);

    $pdf->Cell(60, 5, 'Total ', 1, 0, 'L');
    $pdf->Cell(20, 5, number_format($canti, 0), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($monto, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($impto, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($total - $descuen, 2), 1, 1, 'R');
    $pdf->SetFont('Arial', '', 9);
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
