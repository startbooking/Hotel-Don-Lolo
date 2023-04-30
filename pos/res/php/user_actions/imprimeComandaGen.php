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

$pdf = new FPDF('P', 'mm', [76, 350]);
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(65, 4, utf8_decode(NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 4, $nomamb, 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(65, 4, 'Fecha '.$fec.' Mesa '.$mesa, 0, 1, 'L');
$pdf->Cell(65, 4, 'Comanda Nro: '.$pref.'-'.str_pad($numerocomanda, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(55, 4, 'PRODUCTO', 0, 0, 'C');
$pdf->Cell(10, 4, 'CANT.', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 10);

foreach ($productos as $producto) {
    $pdf->Cell(55, 4, utf8_decode(substr($producto['producto'], 0, 23)), 0, 0, 'L');
    $pdf->Cell(10, 4, $producto['cant'], 0, 1, 'R');
}

$pdf->Ln(3);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 4, 'Mesero : '.$user, 0, 1, 'L');
$pdf->Ln(3);

$file = '../../../impresiones/comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
$pdf->Output($file, 'F');
echo 'comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
