<?php

require_once '../../res/php/app_topPos.php';
require_once '../../res/fpdf/fpdf.php';

extract($_POST);

$productos = $pos->getDevolucionProductos($id_ambiente);
$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(195, 4, NAME_EMPRESA, 0, 1, 'C');
$pdf->Cell(195, 4, $nombre, 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(195, 4, 'DEVOLUCION PRODUCTOS ', 0, 1, 'C');
$pdf->Cell(195, 4, 'Fecha '.$fecha_auditoria, 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 9);

$monto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$canti = 0;
$pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
$pdf->Cell(60, 5, 'Producto.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Cantidad ', 1, 0, 'C');
$pdf->Cell(70, 5, 'Motivo Devolucion ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Usuario ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

if (count($productos) == 0) {
    $pdf->Cell(195, 5, 'SIN PRODUCTOS DEVUELTOS EN EL DIA', 1, 1, 'C');
} else {
    foreach ($productos as $comanda) {
        $pdf->Cell(20, 4, $comanda['comanda'], 0, 0, 'R');
        $pdf->Cell(60, 4, substr($comanda['nom'],0,31), 0, 0, 'L');
        $pdf->Cell(20, 4, $comanda['cantidad_devo'], 0, 0, 'C');
        $pdf->Cell(70, 4, ($comanda['motivo_devo']), 0, 0, 'L');
        $pdf->Cell(25, 4, $comanda['usuario_devo'], 0, 1, 'L');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
