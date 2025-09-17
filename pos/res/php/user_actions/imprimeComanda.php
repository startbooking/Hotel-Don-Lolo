<?php

// require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';
extract($_POST);

clearstatcache();
$datosmesa = $pos->getDatosComanda($comanda, $id_ambiente);

$pax = $datosmesa['pax'];
$mesa = $datosmesa['mesa'];
$fec = $datosmesa['fecha'];

$pdf = new FPDF('P', 'mm', [76, 250]);
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(65, 4, (NAME_EMPRESA), 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(65, 4, $nombre, 0, 'C');
$pdf->Ln(1);
$pdf->Cell(65, 4, 'Fecha '.$fec.' Mesa '.$mesa, 0, 1, 'L');
$pdf->Cell(65, 4, 'Comanda Nro: '.$prefijo.'-'.str_pad($comanda, 5, '0', STR_PAD_LEFT), 0, 1, 'L');

$pdf->Ln(2);
$pdf->Cell(55, 4, 'PRODUCTO', 0, 0, 'C');
$pdf->Cell(10, 4, 'CANT.', 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 10);

foreach ($productos as $producto) {
    $pdf->Cell(55, 4, (substr($producto['producto'], 0, 23)), 0, 0, 'L');
    $pdf->Cell(10, 4, $producto['cant'], 0, 1, 'R');
}

$pdf->Ln(3);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 4, 'Mesero: '.$usuario, 0, 1, 'L');
$pdf->Ln(3);
$file = '../../../impresiones/comandaCocina_'.$prefijo.'_'.$comanda.'.pdf';
$pdf->Output($file, 'F');
echo 'comandaCocina_'.$prefijo.'_'.$comanda.'.pdf';
?>
 