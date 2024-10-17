<?php

$detallesCaj = $pos->getDetalleFacturaCajeroDia('A', $user, $idamb);
$detalleAnuladasCaj = $pos->getDetalleFacturaAnuladaCajeroDia('X', $user, $idamb);
$pagosCaj = $pos->getDetalleFormasdePagoCajero('A', $user, $idamb);
$pagosAnuladosCaj = $pos->getDetalleFormasdePagoAnuladasCajero('X', $user, $idamb);
$devolucionesCaj = $pos->getDevolucionUsuario($idamb, $user);

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('L', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 25);

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(260, 5, $amb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(260, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(1);
$pdf->Cell(260, 7, 'INFORME DE VENTAS - BALANCE DIARIO', 0, 1, 'C');
$pdf->Cell(260, 7, 'BALANCE GENERADO EN AUDITORIA ', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 5, 'USUARIO : '.$user, 0, 1, 'C');
$pdf->Cell(260, 5, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(215, 7, 'DETALLE FACTURAS GENERADAS ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(15, 6, 'Fact.', 1, 0, 'C');
$pdf->Cell(25, 6, 'Neto ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Impuesto ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Propina ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Room Service ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Total ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Usuario ', 1, 0, 'C');
$pdf->Cell(40, 6, 'Forma de Pago ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Hora ', 1, 1, 'C');

$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$serv = 0;
$abon = 0;
$pago = 0;

foreach ($detallesCaj as $detalle) {
    $fact += 1;
    $neto += $detalle['valor_neto'];
    $impt += $detalle['impuesto'];
    $prop += $detalle['propina'];
    $serv += $detalle['servicio'];
    $pago += $detalle['pagado'];
    $tota = $tota + $detalle['pagado'];

    $pdf->Cell(15, 6, $detalle['factura'], 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($detalle['valor_neto'], 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($detalle['impuesto'], 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($detalle['propina'], 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($detalle['servicio'], 2), 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($detalle['pagado'], 2), 1, 0, 'R');
    $pdf->Cell(30, 6, $detalle['usuario'], 1, 0, 'L');
    $pdf->Cell(40, 6, substr($pos->nombrePago($detalle['forma_pago']), 0, 19), 1, 0, 'L');
    $pdf->Cell(20, 6, substr($detalle['fecha_factura'], 11, 8), 1, 1, 'R');
}
$pdf->Cell(15, 6, 'Total', 1, 0, 'C');
$pdf->Cell(25, 6, number_format($neto, 2), 1, 0, 'R');
$pdf->Cell(20, 6, number_format($impt, 2), 1, 0, 'R');
$pdf->Cell(20, 6, number_format($prop, 2), 1, 0, 'R');
$pdf->Cell(20, 6, number_format($serv, 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($tota, 2), 1, 1, 'R');

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 7, 'DETALLE FACTURAS ANULADAS ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 6, 'Fact.', 1, 0, 'C');
$pdf->Cell(25, 6, 'Com. ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Mesa ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Pax ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Total Fact ', 1, 0, 'C');
$pdf->Cell(30, 6, 'Usuario ', 1, 0, 'C');
$pdf->Cell(95, 6, 'Motivo Anulacion ', 1, 1, 'C');

foreach ($detalleAnuladasCaj as $detalle) {
    $pdf->Cell(25, 6, $detalle['factura'], 1, 0, 'R');
    $pdf->Cell(25, 6, $detalle['comanda'], 1, 0, 'R');
    $pdf->Cell(25, 6, $detalle['mesa'], 1, 0, 'R');
    $pdf->Cell(25, 6, $detalle['pax'], 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['valor_total'], 2), 1, 0, 'R');
    $pdf->Cell(30, 6, $detalle['usuario_anulada'], 1, 0, 'L');
    $pdf->Cell(95, 6, substr($detalle['motivo_anulada'], 0, 40), 1, 1, 'L');
}

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 6, 'DETALLE FORMAS DE PAGO ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 6, 'Forma de pago.', 1, 0, 'C');
$pdf->Cell(25, 6, 'Cant. ', 1, 0, 'C');
$pdf->Cell(35, 6, 'SubTotal ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Propina ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Room Service ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Impuestos  ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Total Fact ', 1, 1, 'C');

$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$serv = 0;

foreach ($pagosCaj as $detalle) {
    $fact += 1;
    $neto += $detalle['neto'];
    $impt += $detalle['impto'];
    $prop += $detalle['prop'];
    $serv += $detalle['serv'];
    $tota = $tota + $detalle['pagado'];

    $pdf->Cell(60, 4, $detalle['descripcion'], 1, 0, 'L');
    $pdf->Cell(25,4, $detalle['cant'], 1, 0, 'R');
    $pdf->Cell(35, 4, number_format($detalle['neto'], 2), 1, 0, 'R');
    $pdf->Cell(35, 4, number_format($detalle['prop'], 2), 1, 0, 'R');
    $pdf->Cell(35, 4, number_format($detalle['servivio'], 2), 1, 0, 'R');
    $pdf->Cell(35, 4, number_format($detalle['impto'], 2), 1, 0, 'R');
    $pdf->Cell(35, 4, number_format($detalle['pagado'], 2), 1, 1, 'R');
}
$pdf->Cell(85, 5, 'Total', 1, 0, 'C');
$pdf->Cell(35, 5, number_format($neto, 2), 1, 0, 'R');
$pdf->Cell(35, 5, number_format($prop, 2), 1, 0, 'R');
$pdf->Cell(35, 5, number_format($serv, 2), 1, 0, 'R');
$pdf->Cell(35, 5, number_format($impt, 2), 1, 0, 'R');
$pdf->Cell(35, 5, number_format($tota, 2), 1, 1, 'R');

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 6, 'DETALLE FORMAS DE PAGO ANULADAS ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 6, 'Forma de pago.', 1, 0, 'C');
$pdf->Cell(25, 6, 'Cant. ', 1, 0, 'C');
$pdf->Cell(35, 6, 'SubTotal ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Propina ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Room Service ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Impuestos  ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Total Fact ', 1, 1, 'C');

$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$serv = 0;
$canti = 0;

foreach ($pagosAnuladosCaj as $detalle) {
    $fact += 1;
    $canti += $detalle['cant'];
    $neto += $detalle['neto'];
    $impt += $detalle['impto'];
    $prop += $detalle['prop'];
    $serv += $detalle['serv'];
    $tota = $tota + $detalle['pagado'];

    $pdf->Cell(60, 6, $detalle['descripcion'], 1, 0, 'L');
    $pdf->Cell(25, 6, $detalle['cant'], 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['neto'], 2), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['prop'], 2), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['servicio'], 2), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['impto'], 2), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['total'], 2), 1, 1, 'R');
}
$pdf->Cell(60, 6, 'Total', 1, 0, 'C');
$pdf->Cell(25, 6, number_format($canti, 0), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($neto, 2), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($prop, 2), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($serv, 2), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($impt, 2), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($tota, 2), 1, 1, 'R');
$pdf->Ln(5);

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 11);

$comandasCaj = $pos->getComandasActivasCajero($idamb, 'A', $user);

$monto = 0;
$impto = 0;
$total = 0;
if (count($comandasCaj) == 0) {
    $pdf->Ln(2);
    $pdf->Cell(260, 5, 'SIN COMANDAS ACTIVAS', 1, 1, 'C');
    $pdf->Ln(2);
} else {
    $pdf->Cell(120, 5, 'COMANDAS ACTIVAS ', 1, 1, 'C');
    $pdf->Ln(2);
    $pdf->Cell(20, 6, 'Comanda', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Mesa ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'PAX. ', 1, 0, 'C');
    $pdf->Cell(40, 6, 'Usuario', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Hora', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    foreach ($comandasCaj as $comanda) {
        $total = $total + 1;
        $pdf->Cell(20, 5, $comanda['comanda'], 1, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 1, 0, 'C');
        $pdf->Cell(20, 5, $comanda['pax'], 1, 0, 'C');
        $pdf->Cell(40, 5, $comanda['usuario'], 1, 0, 'L');
        $pdf->Cell(20, 5, substr($comanda['fecha_comanda'], 11, 5), 1, 1, 'R');
    }
    $pdf->Cell(100, 6, 'Total Comandas Activas', 1, 0, 'C');
    $pdf->Cell(20, 6, number_format($total, 0), 1, 1, 'R');
    $pdf->Ln(5);
}

$pdf->SetFont('Arial', 'B', 11);

$comandasAnu = $pos->getComandasAnuladasCajero($idamb, 'X', $user);

$monto = 0;
$impto = 0;
$total = 0;
if (count($comandasAnu) == 0) {
    $pdf->Ln(2);
    $pdf->Cell(260, 5, 'SIN COMANDAS ANULADAS', 1, 1, 'C');
    $pdf->Ln(5);
} else {
    $pdf->Cell(260, 5, 'COMANDAS ANULADAS ', 0, 1, 'C');
    $pdf->Ln(2);
    $pdf->Cell(20, 6, 'Comanda.', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Mesa ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'PAX. ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Hora', 1, 0, 'C');
    $pdf->Cell(90, 6, 'Motivo Anulacion', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    foreach ($comandasAnu as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 1, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 1, 0, 'C');
        $pdf->Cell(20, 5, $comanda['pax'], 1, 0, 'C');
        $pdf->Cell(20, 5, substr($comanda['fecha_anulada'], 11, 5), 1, 0, 'R');
        $pdf->Cell(90, 5, ($comanda['motivo_anulada']), 1, 1, 'R');
    }
}
$pdf->Ln(3);

/* $pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(180, 8, 'DETALLE VENTAS CREDITO DEL DIA ', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(120, 6, 'Cliente', 1, 0, 'C');
$pdf->Cell(25, 6, 'Factura ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Total Fact ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$desc = 0;
$canti = 0;
foreach ($creditosCaj as $detalle) {
    $fact = $fact + 1;
    $tota = $tota + $detalle['valor_total'];

    $pdf->Cell(120, 6, ($detalle['apellido1'].' '.$detalle['apellido2'].' '.$detalle['nombre1'].' '.$detalle['nombre2']), 1, 0, 'L');
    $pdf->Cell(25, 6, $detalle['factura'], 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['valor_total'], 2), 1, 1, 'R');
}
$pdf->Cell(145, 6, 'Total Ventas Credito', 1, 0, 'C');
$pdf->Cell(35, 6, number_format($tota, 2), 1, 1, 'R'); */

$pdf->Ln(5);

$monto = 0;
$impto = 0;
$total = 0;

if (count($devolucionesCaj) == 0) {
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(260, 5, 'SIN DEVOLUCION DE PRODUCTOS  ', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 11);

    $pdf->Ln(5);
} else {
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(195, 8, 'DEVOLUCION DE PRODUCTOS ', 1, 1, 'C');
    $pdf->Cell(20, 6, 'Comanda.', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Mesa ', 1, 0, 'C');
    $pdf->Cell(70, 6, 'Producto. ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Cantidad', 1, 0, 'C');
    $pdf->Cell(65, 6, 'Motivo Devolucion', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    foreach ($devolucionesCaj as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 1, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 1, 0, 'C');
        $pdf->Cell(70, 5, $comanda['nom'], 1, 0, 'L');
        $pdf->Cell(20, 5, $comanda['cant'], 1, 0, 'C');
        $pdf->Cell(65, 5, $comanda['motivo_devo'], 1, 1, 'L');
    }
}

$pdf->Ln(3);
$file = '../imprimir/cierres/cierre_Cajero_'.$user.'_'.$fecha.'.pdf';
$pdf->Output($file, 'F');
