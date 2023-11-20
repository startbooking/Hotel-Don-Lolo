<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 6, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 4, 'COMANDAS ANULADAS ', 0, 1, 'C');
$pdf->Cell(195, 4, 'Fecha '.$fecha, 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Mesa ', 1, 0, 'C');
$pdf->Cell(20, 5, 'PAX. ', 1, 0, 'C');
$pdf->Cell(40, 5, 'Usuario', 1, 0, 'C');
$pdf->Cell(10, 5, 'Hora', 1, 0, 'C');
$pdf->Cell(80, 5, 'Motivo', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$comandas = $pos->getComandasActivas($idamb, 'X');

$monto = 0;
$impto = 0;
$total = 0;
if (count($comandas) == 0) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(190, 5, 'SIN COMANDAS ANULADAS', 1, 1, 'C');
} else {
    foreach ($comandas as $comanda) {
        $pdf->Cell(20, 4, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(20, 4, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(20, 4, $comanda['pax'], 0, 0, 'C');
        $pdf->Cell(40, 4, $pos->nombreUsuario($comanda['id_usuario_anula']), 0, 0, 'R');
        $pdf->Cell(10, 4, substr($comanda['fecha_comanda_anulada'], 11, 5), 0, 0, 'R');
        $pdf->Cell(80, 4, utf8_decode($comanda['motivo_anulada']), 0, 1, 'L');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
