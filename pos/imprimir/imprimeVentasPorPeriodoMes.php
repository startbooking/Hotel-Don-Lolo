<?php
require '../../res/php/app_topPos.php';

$idamb = $_POST['id_ambiente'];
$nomamb = $_POST['nombre'];
$user = $_POST['usuario'];
$iduser = $_POST['usuario_id'];
$logo = $_POST['logo'];
$desdefe = $_POST['desdeFe'];
$hastafe = $_POST['hastaFe'];

$periodos = $pos->getVentasPeriodosMes($idamb, $desdefe, $hastafe);

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 5, $nomamb, 0, 1, 'C');
$pdf->Cell(195, 5, 'HISTORICO VENTAS POR PERIODOS DE SERVICIO ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Desde  Fecha '.$desdefe.' Hasta Fecha '.$hastafe, 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Arial', '', 9);

$monto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$canti = 0;
$descu = 0;
$prop = 0;
$serv = 0;
if (count($periodos) == 0) {
    $pdf->Ln(2);
    $pdf->Cell(190, 5, 'SIN PRODUCTOS VENDIDOS EN EL DIA', 0, 0, 'C');
    $pdf->Ln(2);
} else {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 6, 'Periodo de Servicio', 1, 0, 'C');
    $pdf->Cell(25, 6, 'Valor', 1, 0, 'C');
    $pdf->Cell(25, 6, 'Propina', 1, 0, 'C');
    $pdf->Cell(25, 6, 'Room Serv.', 1, 0, 'C');
    $pdf->Cell(25, 6, 'Impuesto', 1, 0, 'C');
    $pdf->Cell(25, 6, 'Total', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    foreach ($periodos as $comanda) {
        $pdf->Cell(70, 4, ($comanda['descripcion_periodo']), 0, 0, 'L');
        $pdf->Cell(25, 4, number_format($comanda['neto'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['prop'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['serv'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['imptos'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['pagado']-$comanda['cambio'], 2), 0, 1, 'R');
        $valprod = $valprod + $comanda['neto'];
        $monto = $monto + $comanda['neto'];
        $prop = $prop + $comanda['prop'];
        $serv = $serv + $comanda['serv'];
        $impto = $impto + $comanda['imptos'];
        $total = $total + $comanda['pagado']-$comanda['cambio'];
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'Total ', 1, 0, 'L');
    $pdf->Cell(25, 5, number_format($monto, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($prop, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($serv, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($impto, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($total, 2), 1, 1, 'R');
    $pdf->SetFont('Arial', '', 9);
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));
echo $base64String;
