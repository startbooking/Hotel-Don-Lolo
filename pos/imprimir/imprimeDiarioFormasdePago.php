<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 13);

$pdf->Cell(195, 6, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(195, 5, 'ACUMULADO FORMAS DE PAGO  ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(195, 4, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, 'FORMA DE PAGO ', 0, 0, 'C');
$pdf->Cell(40, 5, 'VENTAS DIA', 0, 0, 'C');
$pdf->Cell(40, 5, 'VENTAS MES', 0, 0, 'C');
$pdf->Cell(40, 5, utf8_decode('VENTAS AÑO'), 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$codigos = $pos->getFormasdePago();

$sdia = 0;
$smes = 0;
$sanio = 0;

$pagodia = $pos->getPagosDia($fecha, $idamb);
$pagomes = $pos->getPagosMes($anio, $mes, $idamb);
$pagoanio = $pos->getPagosAnio($anio, $idamb);

foreach ($codigos as $codigo) {
    $pdf->Cell(60, 6, utf8_decode(substr($codigo['descripcion'], 0, 30)), 0, 0, 'L');
    $idforma = $codigo['id_pago'];

    $nomdia = array_search($idforma, array_column($pagodia, 'id_pago'));
    $nommes = array_search($idforma, array_column($pagomes, 'id_pago'));
    $nomanio = array_search($idforma, array_column($pagoanio, 'id_pago'));

    $pdia = 0;
    $pmes = 0;
    $panio = 0;

    if ($nomdia != '') {
        $pdia = $pagodia[$nomdia]['pago'] - $pagodia[$nomdia]['cambio'];
    }
    if ($nommes != '') {
        $pmes = $pagomes[$nommes]['pagomes'] - $pagomes[$nommes]['cambiomes'];
    }
    if ($nomanio != '') {
        $panio = $pagoanio[$nomanio]['pagoanio'] - $pagoanio[$nomanio]['cambioanio'];
    }

    $pdf->Cell(40, 4, number_format($pdia, 2), 0, 0, 'R');
    $pdf->Cell(40, 4, number_format($pmes, 2), 0, 0, 'R');
    $pdf->Cell(40, 4, number_format($panio, 2), 0, 1, 'R');
    $sdia = $sdia + $pdia;
    $smes = $smes + $pmes;
    $sanio = $sanio + $panio;
}

$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(60, 5, utf8_decode(substr('TOTAL PAGOS', 0, 30)), 0, 0, 'L');
$pdf->Cell(40, 5, number_format($sdia, 2), 0, 0, 'R');
$pdf->Cell(40, 5, number_format($smes, 2), 0, 0, 'R');
$pdf->Cell(40, 5, number_format($sanio, 2), 0, 1, 'R');
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 9);
$file = '../imprimir/auditorias/acumuladoDiarioPagos_'.$pref.'_'.$fecha.'.pdf';
$pdf->Output($file, 'F');
