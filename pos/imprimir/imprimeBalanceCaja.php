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
$pdf->Cell(195, 4, 'BALANCE DIARIO DE CAJA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(195, 4, 'Fecha : '.$fecha_auditoria, 0, 1, 'C');

$bases = $pos->traeMovimientosBalanceCaja($fecha_auditoria, 0);
$cajas = $pos->traeMovimientosBalanceCaja($fecha_auditoria, 1);
$carteras = $pos->traeCarteraBalanceCaja($fecha_auditoria, 2);
$abonos = $pos->getDetalleAbonosFormasdePago($id_ambiente);
$pagos = $pos->getDetalleFormasdePagoBalanceCaja('A', $id_ambiente);

$totbase = 0;
$totcaja = 0;
$efecart = 0;
$totefec = 0;
$totvent = 0;
$totcart = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(120, 5, 'VENTAS DEL DIA BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(90, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Valor Facturado', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

if (count($pagos) == 0) {
    $pdf->Cell(120, 5, 'SIN VENTAS DEL DIA', 1, 1, 'C');
    $pdf->Ln(2);
} else {
    foreach ($pagos as $caja) {
        if ($caja['id_pago'] === 1) {
            $totefec = $totefec + $caja['total'];
        }
        $totvent = $totvent + $caja['pagado'];
        $pdf->Cell(90, 4, $caja['descripcion'], 0, 0, 'L');
        $pdf->Cell(30, 4, number_format($caja['pagado'], 2), 0, 1, 'R');
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(90, 5, 'Total Ventas del Dia', 0, 0, 'L');
    $pdf->Cell(30, 5, number_format($totvent, 2), 0, 1, 'R');
}

$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 5, strtoupper('Saldo Total Efectivo Caja'), 1, 0, 'L');
$pdf->Cell(30, 5, number_format($totbase - $totcaja + $totefec + $efecart , 2), 1, 1, 'R');

$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
