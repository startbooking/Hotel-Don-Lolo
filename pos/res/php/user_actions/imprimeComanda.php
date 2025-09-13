<?php

require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

clearstatcache();
$nComa     = $_SESSION['NUMERO_COMANDA'];
$amb       = $_SESSION['AMBIENTE_ID'];
$nomamb    = $_SESSION['NOMBRE_AMBIENTE'];
$productos = $_POST['productos'];

$numerocomanda = $nComa;

$pref = $pos->getPrefijoAmbiente($amb);
$datosmesa = $pos->getDatosComanda($numerocomanda, $amb);

$pax = $datosmesa['pax'];
$mesa = $datosmesa['mesa'];
$fec = $datosmesa['fecha'];

$pdf = new FPDF('P', 'mm', [76, 250]);
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(65, 4, (NAME_EMPRESA), 0, 1, 'C');

// $pdf->Cell(65, 6, $nomamb, 1, 1, 'C');
$pdf->MultiCell(65, 6, $nomamb, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 4, 'Fecha ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 4, $fec, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 4, 'Mesa ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 4, $mesa, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 4, 'Comanda Nro: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 4, $pref.'-'.str_pad($numerocomanda, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);

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
$pdf->Cell(65, 4, 'Mesero: '.$_SESSION['usuario'], 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 6);
$file = '../../../impresiones/comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
$pdf->Output($file, 'F');
echo 'comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
?>
 