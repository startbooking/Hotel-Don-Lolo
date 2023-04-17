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
$pdf->Cell(195, 5, 'COMANDAS ACTIVAS Usuario '.$user, 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(195, 5, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 5, 'Cliente', 1, 0, 'C');
$pdf->Cell(25, 5, 'Comanda', 1, 0, 'C');
$pdf->Cell(20, 5, 'Mesa ', 1, 0, 'C');
$pdf->Cell(20, 5, 'PAX. ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Usuario', 1, 0, 'C');
$pdf->Cell(10, 5, 'Hora', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$comandas = $pos->getComandasActivasCajero($idamb, 'A', $user);

$monto = 0;
$impto = 0;
$total = 0;
if (count($comandas) == 0) {
    $pdf->Cell(175, 5, 'SIN COMANDAS ACTIVAS', 1, 1, 'C');
    $pdf->Ln(2);
} else {
    foreach ($comandas as $comanda) {
        $pdf->Cell(70, 5, $comanda['cliente'], 0, 0, 'L');
        $pdf->Cell(25, 5, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['pax'], 0, 0, 'C');
        $pdf->Cell(30, 5, $comanda['usuario'], 0, 0, 'R');
        $pdf->Cell(10, 5, substr($comanda['fecha_comanda'], 11, 5), 0, 1, 'R');
    }
}
$pdf->Ln(3);

/*
  $file = '../imprimir/informes/cuentasActivas_Cajero_'.$file.'.pdf';
  $pdf->Output($file,'F');
*/

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
