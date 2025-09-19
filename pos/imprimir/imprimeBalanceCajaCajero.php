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
$pdf->Cell(195, 4, 'BALANCE CAJA '.$usuario, 0, 1, 'C');
$pdf->Cell(195, 4, 'Fecha '.$fecha_auditoria, 0, 1, 'C');
$pdf->Ln(2);

$bases = $pos->traeMovimientosCaja($fecha_auditoria, $usuario_id, 0);
$cajas = $pos->traeMovimientosCaja($fecha_auditoria, $usuario_id, 1);
$carteras = $pos->traeCarteraCaja($fecha_auditoria, $usuario_id, 2);
$abonos = $pos->getDetalleAbonosFormasdePagoCajero($usuario_id, $id_ambiente);
$pagos = $pos->getDetalleFormasdePagoCajero('A', $usuario, $id_ambiente);

$totbase = 0;
$totcaja = 0;
$totcart = 0;
$totefec = 0;
$totvent = 0;
$efecart = 0;
$totabono = 0;
$abonoefec = 0;

// $pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(100, 5, 'VENTAS DEL DIA BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(70, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Valor Facturado', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($pagos) == 0) {
    $pdf->Cell(100, 5, 'SIN VENTAS DEL DIA', 1, 1, 'C');
} else {
    foreach ($pagos as $caja) {
        if ($caja['id_pago'] == 1) {
            $totefec = $totefec + $caja['pagado'];
        }
        $totvent = $totvent + $caja['pagado'];
        $pdf->Cell(70, 4, $caja['descripcion'], 0, 0, 'L');
        $pdf->Cell(30, 4, number_format($caja['pagado'], 2), 0, 1, 'R');
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'Total Ventas del Dia', 1, 0, 'L');
    $pdf->Cell(30, 5, number_format($totvent, 2), 1, 1, 'R');
    $pdf->SetFont('Arial', '', 9);
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 5, strtoupper('Saldo Total Efectivo Caja'), 1, 0, 'L');
$pdf->Cell(30, 5, number_format($totbase - $totcaja + $totefec + $efecart + $abonoefec, 2), 1, 1, 'R');
$pdf->SetFont('Arial', '', 9);

$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
