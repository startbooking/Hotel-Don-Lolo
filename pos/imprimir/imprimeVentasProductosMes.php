<?php
require '../../res/php/app_topPos.php';
extract($_POST);
$ventas = $pos->getTotalProductosVendidosMes($id_ambiente, $desdeFe, $hastaFe);
$kardexs = [];

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(195, 5, NAME_EMPRESA, 0, 1, 'C');
$pdf->Cell(195, 5, $nombre, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'HISTORICO VENTAS POR PRODUCTO ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Desde  Fecha '.$desdeFe.' Hasta Fecha '.$hastaFe, 0, 1, 'C');
$pdf->Ln(2);

$monto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$descuen = 0;
$canti = 0;
$impu = 0;
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(60, 6, 'Producto.', 1, 0, 'C');
$pdf->Cell(20, 6, 'Valor Unit. ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Cantidad ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Sub Total. ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Impuesto ', 1, 0, 'C'); 
$pdf->Cell(20, 6, 'Total ', 1, 1, 'C'); 
$pdf->SetFont('Arial', '', 8);

if (count($ventas) == 0) {
    $pdf->Ln(2);
    $pdf->Cell(200, 5, 'SIN PRODUCTOS VENDIDOS EN EL DIA', 1, 1, 'C');
    $pdf->Ln(2);
} else {
    foreach ($ventas as $comanda) {
        $costoPro = 0;
        $idprod = $comanda['id_receta'];
        $regis = array_search($idprod, array_column($kardexs, 'id_producto'));

        $pdf->Cell(60, 4, substr(($comanda['nom']), 0, 32), 0, 0, 'L');
        $pdf->Cell(20, 4, number_format($comanda['unitario'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, $comanda['cant'], 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['ventas'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($comanda['imptos'], 2), 0, 0, 'R'); 
        $pdf->Cell(20, 4, number_format($comanda['ventas']+$comanda['imptos'], 2), 0, 1, 'R'); 
        $valprod = $valprod + $comanda['ventas'];
        $descuen = $descuen + $comanda['descuento'];
        $canti = $canti + $comanda['cant'];
        $monto = $monto + $comanda['ventas'];
        $impu = $impu + $comanda['imptos'];
        $total = $total + $comanda['total'];
    }

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(80, 5, 'Total ', 1, 0, 'L');
    $pdf->Cell(20, 5, number_format($canti, 0), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($monto, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($impu, 2), 1, 0, 'R');
    $pdf->Cell(20, 5, number_format($monto+$impu, 2), 1, 1, 'R');
}

$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

$resp = [
    'reporte' => $base64String,
    'tabla' => $ventas,
    'inventario' => $kardexs,
];

echo json_encode($resp);
