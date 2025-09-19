<?php
  require_once '../../res/php/app_topPos.php'; 
require_once '../../res/fpdf/fpdf.php';
extract($_POST);

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 5, NAME_EMPRESA, 0, 1, 'C');
$pdf->Cell(195, 5, $nombre, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 4, 'DEVOLUCION DE PRODUCTOS ', 0, 1, 'C');
$pdf->Cell(195, 4, 'Fecha '.$fecha_auditoria, 0, 1, 'C');
$pdf->ln(1);
$devoluciones = $pos->getDevolucionesDia($id_ambiente);

$monto = 0;
$impto = 0; 
$total = 0;

if (count($devoluciones) == 0) {
  $pdf->Cell(190, 5, 'SIN DEVOLUCION DE PRODUCTOS  ', 1, 1, 'C');
} else {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Mesa ', 1, 0, 'C');
    $pdf->Cell(55, 5, 'Producto. ', 1, 0, 'C');
    $pdf->Cell(15, 5, 'Cant.', 1, 0, 'C');
    $pdf->Cell(65, 5, 'Motivo Devolucion', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Usuario', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    foreach ($devoluciones as $comanda) {
      $pdf->Cell(20, 5, $comanda['comanda'], 0, 0, 'C');
      $pdf->Cell(20, 5, $comanda['mesa'], 0, 0, 'C');
      $pdf->Cell(55, 5, substr($comanda['nom'],0,28), 0, 0, 'L');
      $pdf->Cell(15, 5, $comanda['cantidad_devo'], 0, 0, 'C');
      $pdf->Cell(65, 5, ($comanda['motivo_devo']), 0, 0, 'L');
      $pdf->Cell(25, 5, $comanda['usuario_devo'], 0, 1, 'L');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
