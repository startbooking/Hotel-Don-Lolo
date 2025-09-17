<?php

// require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

clearstatcache();
/* Productos a Imprimir */

$numerocomanda = $nComa;

$datosmesa = $pos->getDatosComanda($numerocomanda, $amb);

$pax = $datosmesa['pax'];
$mesa = $datosmesa['mesa'];
$fec = $datosmesa['fecha'];

$ventasdia = $pos->getProductosVentaComanda($numerocomanda, $amb);

$pdf = new FPDF('P', 'mm', [50, 250]);
$pdf->AddPage();
$pdf->SetMargins(0, 3, 0);
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(65, 4, (NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(65, 4, $nombre, 0, 'C');
$pdf->Ln(1);
$pdf->Cell(65, 5, 'Fecha '.$fec.' Mesa '.$mesa, 0, 1, 'L');
$pdf->Cell(65, 5, 'Comanda Nro: '.$pref.'-'.str_pad($numerocomanda, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
$pdf->Ln(2);
$pdf->Cell(35, 5, 'PRODUCTO', 0, 0, 'C');
$pdf->Cell(10, 5, 'CANT.', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 10);

foreach ($productos as $producto) {
    $pdf->Cell(55, 4, (substr($producto['producto'], 0, 23)), 0, 0, 'L');
    $pdf->Cell(10, 4, $producto['cant'], 0, 1, 'R');
}

$pdf->Ln(3);
$pdf->SetFont('Times', '', 7);
$pdf->Cell(50, 4, 'Usuario: '.$_SESSION['usuario'], 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont('Times', '', 6);
$pdf->Cell(25, 4, WEB_EMPRESA, 0, 0, 'L');
$pdf->Cell(25, 4, CORREO_EMPRESA, 0, 1, 'R');

$file = '../../../impresiones/comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
$pdf->Output($file, 'F');
// $pdf->Output();
echo 'comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
?>
 