<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.LOGO, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 6, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 4, 'BALANCE DIARIO DE CAJA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190, 4, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(2);

$bases = $pos->traeMovimientosBalanceCaja($fecha, 0);
$cajas = $pos->traeMovimientosBalanceCaja($fecha, 1);
$carteras = $pos->traeCarteraBalanceCaja($fecha, 2);
$abonos = $pos->getDetalleAbonosFormasdePago($idamb);
$pagos = $pos->getDetalleFormasdePagoBalanceCaja('A', $idamb);

$totbase = 0;
$totcaja = 0;
$efecart = 0;
$totefec = 0;
$totvent = 0;
$totcart = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(2);
$pdf->Cell(190, 5, 'BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(110, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(50, 5, 'Cajero. ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Monto', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($bases) == 0) {
    $pdf->Cell(190, 5, 'SIN BASE DE CAJA', 1, 1, 'C');
} else {
    foreach ($bases as $caja) {
        $totbase = $totbase + $caja['monto'];
        $pdf->Cell(110, 5, utf8_decode($caja['concepto']), 0, 0, 'l');
        $pdf->Cell(50, 5, utf8_decode($caja['proveedor']), 0, 0, 'L');
        $pdf->Cell(30, 5, number_format($caja['monto'], 2), 0, 1, 'R');
    }
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'Total Base Caja', 1, 0, 'L');
    $pdf->Cell(25, 5, number_format($totbase, 2), 1, 1, 'C');
}
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 5, 'COMPRAS BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(70, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Documento ', 1, 0, 'C');
$pdf->Cell(50, 5, 'Proveedor. ', 1, 0, 'C');
$pdf->Cell(40, 5, 'Valor', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($cajas) == 0) {
    $pdf->Cell(190, 5, 'SIN COMPRAS POR BASE DE CAJA', 1, 1, 'C');
} else {
    foreach ($cajas as $caja) {
        $totcaja = $totcaja + $caja['monto'];
        $pdf->Cell(70, 5, utf8_decode(substr($caja['concepto'], 0, 30)), 0, 0, 'L');
        $pdf->Cell(30, 5, $caja['documento'], 0, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode($caja['proveedor']), 0, 0, 'L');
        $pdf->Cell(20, 5, '', 0, 0, 'R');
        $pdf->Cell(20, 5, number_format($caja['monto'], 2), 0, 1, 'R');
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'Total Compras Por Caja', 1, 0, 'L');
    $pdf->Cell(25, 5, number_format($totcaja, 2), 1, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 5, 'RECAUDOS DE CARTERA  BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(50, 5, 'Cliente ', 1, 0, 'C');
$pdf->Cell(50, 5, 'Forma de Pago. ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Valor Pagado', 1, 0, 'C');
$pdf->Cell(60, 5, 'Descripcion. ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($carteras) == 0) {
    $pdf->Cell(190, 5, 'SIN RECAUDOS DE CARTERA POR BASE DE CAJA', 1, 1, 'C');
} else {
    foreach ($carteras as $caja) {
        if ($caja['id_pago'] == 1) {
            $efecart = $efecart + $caja['monto'];
        }
        $totcart = $totcart + $caja['monto'];
        $pdf->Cell(50, 5, $pos->traeClienteCartera($caja['proveedor']), 0, 0, 'L');
        $pdf->Cell(50, 5, $caja['descripcion'], 0, 0, 'L');
        $pdf->Cell(30, 5, number_format($caja['monto'], 2), 0, 0, 'R');
        $pdf->MultiCell(60, 5, $caja['concepto'], 0, 'J');
    }
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'Total Recuados de Cartera Por Caja', 1, 0, 'L');
    $pdf->Cell(30, 5, number_format($totcart, 2), 1, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
}

$pdf->Ln(5);
$abonoefec = 0;
$totabono = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(100, 5, 'ABONOS DEL DIA BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(70, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Valor Abono', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

if (count($abonos) == 0) {
    $pdf->Cell(100, 5, 'SIN ABONOS EN EL DIA', 1, 1, 'C');
} else {
    foreach ($abonos as $caja) {
        if ($caja['formaPago'] == 1) {
            $abonoefec = $abonoefec + $caja['total'];
        }
        $totabono = $totabono + $caja['total'];
        $pdf->Cell(70, 5, $caja['descripcion'], 0, 0, 'L');
        $pdf->Cell(30, 5, number_format($caja['total'], 2), 0, 1, 'R');
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'Total Abonos del Dia', 1, 0, 'L');
    $pdf->Cell(30, 5, number_format($totabono, 2), 1, 1, 'R');
}
$pdf->Ln(5);
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
        $pdf->Cell(90, 5, $caja['descripcion'], 0, 0, 'L');
        $pdf->Cell(30, 5, number_format($caja['pagado'], 2), 0, 1, 'R');
    }
    $pdf->Cell(90, 5, 'ABONOS RECIBIDOS ', 0, 0, 'L');
    $pdf->Cell(30, 5, number_format($totabono, 2), 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(90, 5, 'Total Ventas del Dia', 0, 0, 'L');
    $pdf->Cell(30, 5, number_format($totvent + $totabono, 2), 0, 1, 'R');
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 6, strtoupper('Saldo Total Efectivo Caja'), 1, 0, 'L');
$pdf->Cell(30, 6, number_format($totbase - $totcaja + $totefec + $efecart + $abonoefec, 2), 1, 1, 'R');

$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
