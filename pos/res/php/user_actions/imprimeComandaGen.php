<?php

require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

clearstatcache();
$amb = $_POST['idamb'];
$nomamb = $_POST['nomamb'];
$nComa = $_POST['numComa'];
$productos = $_POST['productos'];
$user = $_POST['user'];

$numerocomanda = $nComa;

$pref = $pos->getPrefijoAmbiente($amb);
$datosmesa = $pos->getDatosComanda($numerocomanda, $amb);

$pax = $datosmesa[0]['pax'];
$mesa = $datosmesa[0]['mesa'];
$fec = $datosmesa[0]['fecha'];

$pdf = new FPDF('P', 'mm', [50, 350]);
$pdf->AddPage();
$pdf->SetMargins(0, 3, 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Ln(2);
$pdf->Cell(50, 4, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(50, 4, 'Fecha '.$fec.' Mesa '.$mesa, 0, 1, 'L');
$pdf->Cell(50, 4, 'Comanda Nro: '.$pref.'-'.str_pad($numerocomanda, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(35, 4, 'PRODUCTO', 0, 0, 'C');
$pdf->Cell(10, 4, 'CANT.', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 6);

foreach ($productos as $producto) {
    $pdf->Cell(35, 3, utf8_decode(substr($producto['producto'], 0, 28)), 0, 0, 'L');
    $pdf->Cell(10, 3, substr($producto['cant'], 0, 23), 0, 1, 'R');
}

$pdf->Ln(3);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(50, 4, 'Usuario: '.$user, 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 6);

$file = '../../../impresiones/comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
$pdf->Output($file, 'F');
echo 'comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
