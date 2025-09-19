<?php
require_once '../../res/php/app_topPos.php';
require_once '../../res/fpdf/fpdf.php';
extract($_POST);

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 4, NAME_EMPRESA, 0, 1, 'C');
$pdf->Cell(195, 4, $nombre, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 4, 'COMANDAS ANULADAS '.$usuario, 0, 1, 'C');
$pdf->Cell(195, 4, 'Fecha: '.$fecha_auditoria, 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Mesa ', 1, 0, 'C');
$pdf->Cell(20, 5, 'PAX. ', 1, 0, 'C');
$pdf->Cell(15, 5, 'Hora', 1, 0, 'C');
$pdf->Cell(90, 5, 'Motivo Anulacion', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$comandas = $pos->getComandasAnuladasCajero($id_ambiente, 'X', $usuario_id);

$monto = 0; 
$impto = 0;
$total = 0;
if (count($comandas) == 0) {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(165, 5, 'SIN COMANDAS ANULADAS', 1, 1, 'C');
} else {
    foreach ($comandas as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['pax'], 0, 0, 'C');
        $pdf->Cell(15, 5, substr($comanda['fecha_comanda_anulada'], 11, 5), 0, 0, 'R');
        $pdf->Cell(90, 5, (substr($comanda['motivo_anulada'], 0, 43)), 0, 1, 'L');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
