<?php

require_once '../../res/fpdf/fpdf.php';
require_once '../../res/php/titles.php';
require_once '../../res/php/app_topPos.php';

extract($_POST);

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 4, NAME_EMPRESA, 0, 1, 'C');
$pdf->Cell(195, 4, $nombre, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 4, 'COMANDAS ACTIVAS '.$usuario, 0, 1, 'C');
$pdf->Cell(195, 4, ' Fecha: '.$fecha_auditoria, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(2);

$pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Mesa ', 1, 0, 'C');
$pdf->Cell(20, 5, 'PAX. ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Usuario', 1, 0, 'C');
$pdf->Cell(10, 5, 'Hora', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$comandas = $pos->getComandasActivasCajero($id_ambiente, 'A', $usuario);
$monto = 0;
$impto = 0;
$total = 0;
if (count($comandas) == 0) {
    $pdf->Cell(100, 5, 'SIN COMANDAS ACTIVAS', 1, 1, 'C');
    $pdf->Ln(2);
} else {
    foreach ($comandas as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['pax'], 0, 0, 'C');
        $pdf->Cell(30, 5, $comanda['usuario'], 0, 0, 'R');
        $pdf->Cell(10, 5, substr($comanda['fecha_comanda'], 11, 5), 0, 1, 'R');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
