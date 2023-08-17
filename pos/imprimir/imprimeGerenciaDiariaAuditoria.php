<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 6, $nomamb, 0, 1, 'C');
$pdf->Cell(190, 5, 'INFORME DIARIO DE GERENCIA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(190, 5, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(3);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(45, 6, 'Mesas Vendidas', 1, 0, 'L');
$pdf->Cell(25, 6, $ventasDia[0]['mesas_ocupadas'], 1, 1, 'R');
$pdf->Cell(45, 6, 'Ventas del Dia', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_ventas'], 2), 1, 1, 'R');
$pdf->Cell(45, 6, 'Impuestos del Dia', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_impto'], 2), 1, 1, 'R');
$pdf->Cell(45, 6, 'Propinas del Dia', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_propina'], 2), 1, 1, 'R');
$pdf->Cell(45, 6, 'Room Service del Dia', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_servicio'], 2), 1, 1, 'R');
$pdf->Ln(2);
$pdf->Cell(45, 6, 'Factuas Anuladas', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ventas_anuladas'], 0), 1, 1, 'R');
$pdf->Cell(45, 6, 'Comandas Anuladas', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['cuentas_anuladas'], 0), 1, 1, 'R');
$pdf->Ln(5);

$pdf->Cell(45, 6, 'Descripcion', 1, 0, 'C');
$pdf->Cell(25, 6, 'Acumulado Dia', 1, 0, 'C');
$pdf->Cell(25, 6, 'Acumulado Mes', 1, 0, 'C');
$pdf->Cell(25, 6, utf8_decode('Acumulado Año'), 1, 1, 'C');
$pdf->Cell(45, 6, 'Ventas', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_ventas'], 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasMes[0]['mesVta'], 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasAnio[0]['anioVta'], 2), 1, 1, 'R');
$pdf->Cell(45, 6, 'Impuestos', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_impto'], 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasMes[0]['mesImp'], 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasAnio[0]['anioImp'], 2), 1, 1, 'R');
$pdf->Cell(45, 6, 'Propinas', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_propina'], 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasMes[0]['mesPro'], 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasAnio[0]['anioPro'], 2), 1, 1, 'R');
$pdf->Cell(45, 6, 'Room Service', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_servicio'], 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasMes[0]['mesSer'], 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasAnio[0]['anioSer'], 2), 1, 1, 'R');
$pdf->Ln(2);
$pdf->Cell(45, 6, 'Mesas', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['mesas_ocupadas'], 0), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasMes[0]['mesOcu'], 0), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($ventasAnio[0]['anioOcu'], 0), 1, 1, 'R');
$pdf->Cell(45, 6, 'Promedio Mesa', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_promedio_mesa'], 2), 1, 0, 'R');
if ($ventasMes[0]['mesOcu'] == 0) {
    $pdf->Cell(25, 6, number_format(round(0, 0), 2), 1, 0, 'R');
} else {
    $pdf->Cell(25, 6, number_format(round($ventasMes[0]['mesVta'] / $ventasMes[0]['mesOcu'], 0), 2), 1, 0, 'R');
}
if ($ventasMes[0]['mesCve'] == 0) {
    $pdf->Cell(25, 6, number_format(round(0, 0), 2), 1, 1, 'R');
} else {
    $pdf->Cell(25, 6, number_format(round($ventasAnio[0]['anioVta'] / $ventasAnio[0]['anioOcu'], 0), 2), 1, 1, 'R');
}

$pdf->Cell(45, 6, 'Promedio PAX', 1, 0, 'L');
$pdf->Cell(25, 6, number_format($ventasDia[0]['ingreso_promedio_cliente'], 2), 1, 0, 'R');
if ($ventasMes[0]['mesCve'] == 0) {
    $pdf->Cell(25, 6, number_format(round(0, 0), 2), 1, 0, 'R');
} else {
    $pdf->Cell(25, 6, number_format(round($ventasMes[0]['mesVta'] / $ventasMes[0]['mesCve'], 0), 2), 1, 0, 'R');
}
if ($ventasAnio[0]['anioCve'] == 0) {
    $pdf->Cell(25, 6, number_format(round(0, 0), 2), 1, 1, 'R');
} else {
    $pdf->Cell(25, 6, number_format(round($ventasAnio[0]['anioVta'] / $ventasAnio[0]['anioCve'], 0), 2), 1, 1, 'R');
}
$pdf->Ln(5);

$file = '../imprimir/auditorias/Informe_Diario_Gerencia_'.$pref.'_'.$fecha.'.pdf';

$pdf->Output($file, 'F');
?>
 