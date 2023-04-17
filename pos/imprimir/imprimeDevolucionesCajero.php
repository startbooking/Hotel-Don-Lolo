<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.LOGO, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 5, 'DEVOLUCION DE PRODUCTOS ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(195, 5, 'USUARIO '.$user.' FECHA '.$fecha, 0, 1, 'C');
$pdf->Ln(5);

$devoluciones = $pos->getDevolucionUsuario($idamb, $user);

$monto = 0;
$impto = 0;
$total = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
$pdf->Cell(10, 5, 'Mesa ', 1, 0, 'C');
$pdf->Cell(80, 5, 'Producto. ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Cantidad', 1, 0, 'C');
$pdf->Cell(65, 5, 'Motivo Devolucion', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($devoluciones) == 0) {
    $pdf->Cell(195, 5, 'SIN DEVOLUCION DE PRODUCTOS ', 1, 1, 'C');
} else {
    foreach ($devoluciones as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(10, 5, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(80, 5, substr($comanda['nom'], 0, 40), 0, 0, 'L');
        $pdf->Cell(20, 5, $comanda['cantidad_devo'], 0, 0, 'C');
        $pdf->Cell(65, 5, $comanda['motivo_devo'], 0, 1, 'L');
    }
}
$pdf->Ln(3);

/*   $file = '../imprimir/informes/'.$file.'.pdf';
  $pdf->Output($file,'F'); */

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
