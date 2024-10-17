<?php

require '../../res/php/titles.php';
require '../../res/php/app_topPos.php';

$idamb = $_POST['idamb'];
$nomamb = $_POST['amb'];
$user = $_POST['user'];
$iduser = $_POST['iduser'];

$logo = $_POST['logo'];
$desdefe = $_POST['desdeFe'];
$hastafe = $_POST['hastaFe'];

$ventas = $pos->getTotalFormaPagoVendidosMes($idamb, $desdefe, $hastafe);
// $cantidad = $pos->getCantidadFormasPagoVendidosMes($idamb, $desdefe, $hastafe);

/* if (count($cantidad) == 0) {
    $canProd = 0;
    $valProd = 0;
    $perProd = 0;
} else {
    $canProd = $cantidad[0]['cant'];
    $valProd = $cantidad[0]['ventas'];
    $perProd = $cantidad[0]['pers'];
} */

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 4, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 5, 'HISTORICO FORMAS DE PAGO', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(195, 5, 'Desde  Fecha '.$desdefe.' Hasta Fecha '.$hastafe, 0, 1, 'C');
$pdf->Ln(2);
$monto = 0;
$prop = 0;
$serv = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$canti = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(45, 6, 'Forma de Pago', 1, 0, 'C');
$pdf->Cell(10, 6, 'Cant ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Valor. ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Propina. ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Room Serv.. ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Impuesto. ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Total. ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($ventas) == 0) {
    $pdf->Cell(195, 5, 'SIN PRODUCTOS VENDIDOS', 1, 1, 'C');
} else {
    foreach ($ventas as $comanda) {
        $pdf->Cell(45, 4, ($comanda['descripcion']), 0, 0, 'L');
        $pdf->Cell(10, 4, $comanda['cant'], 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['ventas'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['propina'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['servicio'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['imptos'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($comanda['pagado']-$comanda['cambio'], 2), 0, 1, 'R');
        $valprod = $valprod + $comanda['ventas'];
        $canti = $canti + $comanda['cant'];
        $monto = $monto + $comanda['ventas'];
        $prop = $prop + $comanda['propina'];
        $serv = $serv + $comanda['servicio'];
        $impto = $impto + $comanda['imptos'];
        $total = $total + $comanda['pagado']-$comanda['cambio'];
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(45, 5, 'Total ', 1, 0, 'L');
    $pdf->Cell(10, 5, number_format($canti, 0), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($monto, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($prop, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($serv, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($impto, 2), 1, 0, 'R');
    $pdf->Cell(25, 5, number_format($total, 2), 1, 1, 'R');
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));
echo $base64String;
