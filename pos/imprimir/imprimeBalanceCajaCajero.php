<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
// $pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
// $pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'BALANCE CAJA '.$user, 0, 1, 'C');
// $pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 4, 'Fecha '.$fecha, 0, 1, 'C');
$pdf->Ln(5);

$bases = $pos->traeMovimientosCaja($fecha, $iduser, 0);
$cajas = $pos->traeMovimientosCaja($fecha, $iduser, 1);
$carteras = $pos->traeCarteraCaja($fecha, $iduser, 2);
$abonos = $pos->getDetalleAbonosFormasdePagoCajero($iduser, $idamb);
$pagos = $pos->getDetalleFormasdePagoCajero('A', $user, $idamb);

$totbase = 0;
$totcaja = 0;
$totcart = 0;
$totefec = 0;
$totvent = 0;
$efecart = 0;
$totabono = 0;
$abonoefec = 0;

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(160, 5, 'BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(70, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(70, 5, 'Cajero. ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Monto', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($bases) == 0) {
    $pdf->Cell(160, 5, 'SIN BASE DE CAJA', 1, 1, 'C');
} else {
    foreach ($bases as $caja) {
        $totbase = $totbase + $caja['monto'];
        $pdf->Cell(70, 5, utf8_decode($caja['concepto']), 0, 0, 'l');
        $pdf->Cell(70, 5, utf8_decode($caja['proveedor']), 0, 0, 'L');
        $pdf->Cell(20, 5, number_format($caja['monto'], 2), 0, 1, 'R');
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'Total Base Caja', 1, 0, 'L');
    $pdf->Cell(30, 5, number_format($totbase, 2), 1, 1, 'C');
}
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 5, 'COMPRAS BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(90, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Doc ', 1, 0, 'C');
$pdf->Cell(60, 5, 'Proveedor ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Valor', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

if (count($cajas) == 0) {
    $pdf->Cell(190, 5, 'SIN COMPRAS POR BASE DE CAJA', 1, 1, 'C');
} else {
    foreach ($cajas as $caja) {
        $totcaja = $totcaja + $caja['monto'];
        $pdf->Cell(90, 5, utf8_decode(substr($caja['concepto'], 0, 45)), 0, 0, 'L');
        $pdf->Cell(20, 5, $caja['documento'], 0, 0, 'L');
        $pdf->Cell(60, 5, utf8_decode($caja['proveedor']), 0, 0, 'L');
        $pdf->Cell(20, 5, number_format($caja['monto'], 2), 0, 1, 'R');
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'Total Compras Por Caja', 1, 0, 'L');
    $pdf->Cell(30, 5, number_format($totcaja, 2), 1, 1, 'C');
    $pdf->Ln(5);
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 5, 'RECAUDOS DE CARTERA  BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(50, 6, 'Cliente ', 1, 0, 'C');
$pdf->Cell(60, 6, 'Descripcion. ', 1, 0, 'C');
$pdf->Cell(50, 6, 'Forma de Pago. ', 1, 0, 'C');
$pdf->Cell(30, 6, 'Valor Pagado', 1, 1, 'C');
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
        $pdf->Cell(60, 5, $caja['concepto'], 0, 0, 'L');
        $pdf->Cell(50, 5, $caja['descripcion'], 0, 0, 'L');
        $pdf->Cell(30, 5, number_format($caja['monto'], 2), 0, 1, 'R');
    }
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(70, 5, 'Total Recuados de Cartera Por Caja', 1, 0, 'L');
    $pdf->Cell(30, 5, number_format($totcart, 2), 1, 1, 'C');
}
$pdf->Ln(5);
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
        $pdf->Cell(70, 5, $caja['descripcion'], 0, 0, 'L');
        $pdf->Cell(30, 5, number_format($caja['pagado'], 2), 0, 1, 'R');
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
