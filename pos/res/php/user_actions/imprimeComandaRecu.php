<?php

require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

clearstatcache();
$nComa = $_SESSION['NUMERO_COMANDA'];
$amb = $_SESSION['AMBIENTE_ID'];
$nomamb = $_SESSION['NOMBRE_AMBIENTE'];

/* Productos a Imprimir */

$numerocomanda = $nComa;

$pref = $pos->getPrefijoAmbiente($amb);
$datosmesa = $pos->getDatosComanda($numerocomanda, $amb);

$pax = $datosmesa[0]['pax'];
$mesa = $datosmesa[0]['mesa'];
$fec = $datosmesa[0]['fecha'];

$ventasdia = $pos->getProductosVentaComanda($numerocomanda, $amb);

$pdf = new FPDF('P', 'mm', [50, 250]);
$pdf->AddPage();
$pdf->SetMargins(0, 3, 0);
$pdf->SetFont('Times', 'B', 8);
$pdf->Cell(50, 7, utf8_decode($nomamb), 0, 1, 'C');
$pdf->Cell(50, 5, 'Fecha '.$fec.' Mesa '.$mesa, 0, 1, 'L');
$pdf->Cell(50, 5, 'Comanda Nro: '.$pref.'-'.str_pad($numerocomanda, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 7);

$pdf->Ln(2);

$pdf->Cell(35, 5, 'PRODUCTO', 0, 0, 'C');
$pdf->Cell(10, 5, 'CANT.', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Times', '', 10);

foreach ($ventasdia as $producto) {
    $pdf->Cell(35, 6, utf8_decode(substr($producto['nom'], 0, 20)), 0, 0, 'L');
    $pdf->Cell(10, 6, $producto['cant'], 0, 1, 'R');
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
 