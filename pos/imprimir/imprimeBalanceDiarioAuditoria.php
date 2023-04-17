<?php

require_once '../../res/fpdf/fpdf.php';

$detalles = $pos->getDetalleFacturaAnuladaDiaAmbiente('A', $idamb);
$detalleAnuladas = $pos->getDetalleFacturaAnuladaDiaAmbiente('X', $idamb);
$pagos = $pos->getDetalleFormasdePagoAmbiente('A', $idamb);
$pagosAnulados = $pos->getDetalleFormasdePagoAmbiente('X', $idamb);
$abonos = $pos->traeAbonosTotal($idamb);
$cajeros = $pos->getCajerosActivos($idamb);
$creditos = $pos->getVentasCreditodelDia($idamb);
$comandaAnuladas = $pos->getComandasActivas($idamb, 'X');
$populares = $pos->getPopularidadProductosAmbiente('A', $idamb);
$popularAnulados = $pos->getPopularidadProductosAmbiente('X', $idamb);
$devoluciones = $pos->getDevolucionesDia($idamb, $fecha);

$pdf = new FPDF();
$pdf->AddPage('L', 'letter');
$pdf->Image('../../img/'.LOGO, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(260, 6, $amb, 0, 1, 'C');
$pdf->Cell(260, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 6, 'INFORME DE VENTAS - BALANCE DIARIO', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(260, 6, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(260, 7, 'FACTURAS DEL DIA ', 1, 1, 'C');
$pdf->Cell(15, 6, 'Fact.', 1, 0, 'C');
$pdf->Cell(25, 6, 'Neto ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Impuesto ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Propina ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Descuento ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Abonos ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Pagado ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Total ', 1, 0, 'C');
$pdf->Cell(30, 6, 'Usuario ', 1, 0, 'C');
$pdf->Cell(60, 6, 'Forma de Pago ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);

$factVen = 0;
$netoVen = 0;
$imptVen = 0;
$propVen = 0;
$totaVen = 0;
$descVen = 0;
$abonVen = 0;
$clieVen = 0;
$pagoVen = 0;

foreach ($detalles as $detalle) {
    $factVen = $factVen + 1;
    $netoVen = $netoVen + $detalle['valor_neto'];
    $imptVen = $imptVen + $detalle['impuesto'];
    $propVen = $propVen + $detalle['propina'];
    $descVen = $descVen + $detalle['descuento'];
    $abonVen = $abonVen + $detalle['abonos'];
    $pagoVen = $pagoVen + $detalle['pagado'];
    $totaVen = $totaVen + $detalle['pagado'] + $detalle['abonos'];

    $pdf->Cell(15, 6, $detalle['factura'], 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($detalle['valor_neto'], 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($detalle['impuesto'], 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($detalle['propina'], 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($detalle['descuento'], 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($detalle['abonos'], 2), 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($detalle['pagado'], 2), 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($detalle['pagado'] + $detalle['abonos'], 2), 1, 0, 'R');
    $pdf->Cell(30, 6, $detalle['usuario'], 1, 0, 'L');
    $pdf->Cell(60, 6, $pos->nombrePago($detalle['forma_pago']), 1, 1, 'L');
}
$pdf->Ln(1);
$pdf->Cell(15, 6, 'Total', 1, 0, 'C');
$pdf->Cell(25, 6, number_format($netoVen, 2), 1, 0, 'R');
$pdf->Cell(20, 6, number_format($imptVen, 2), 1, 0, 'R');
$pdf->Cell(20, 6, number_format($propVen, 2), 1, 0, 'R');
$pdf->Cell(20, 6, number_format($descVen, 2), 1, 0, 'R');
$pdf->Cell(20, 6, number_format($abonVen, 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($pagoVen, 2), 1, 0, 'R');
$pdf->Cell(25, 6, number_format($totaVen, 2), 1, 1, 'R');

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

$factAnu = 0;
$netoAnu = 0;
$imptAnu = 0;
$propAnu = 0;
$totaAnu = 0;
$descAnu = 0;
$clieAnu = 0;

foreach ($detalleAnuladas as $detalle) {
    $factAnu = $factAnu + 1;
    $netoAnu = $netoAnu + $detalle['valor_neto'];
    $imptAnu = $imptAnu + $detalle['impuesto'];
    $propAnu = $propAnu + $detalle['propina'];
    $descAnu = $descAnu + $detalle['descuento'];
    $totaAnu = $totaAnu + $detalle['pagado'];
    $clieAnu = $clieAnu + $detalle['pax'];

    $pdf->Cell(25, 6, $detalle['factura'], 1, 0, 'R');
    $pdf->Cell(25, 6, $detalle['comanda'], 1, 0, 'R');
    $pdf->Cell(25, 6, $detalle['mesa'], 1, 0, 'R');
    $pdf->Cell(25, 6, $detalle['pax'], 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['pagado'], 2), 1, 0, 'R');
    $pdf->Cell(30, 6, $detalle['usuario_anulada'], 1, 0, 'L');
    $pdf->Cell(95, 6, $detalle['motivo_anulada'], 1, 1, 'L');
}
$pdf->Ln(1);
$pdf->Cell(75, 6, 'Total', 1, 0, 'C');
$pdf->Cell(25, 6, number_format($clieAnu, 0), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($totaAnu, 2), 1, 1, 'R');

$cajeros = $pos->getCajerosActivos($idamb);

$oldUser = $user;
$oldidUser = $iduser;

foreach ($cajeros as $key => $cajero) {
    $user = $cajero['usuario'];
    $iduser = $cajero['usuario_id'];

    $detallesCaj = $pos->getDetalleFacturaCajeroDia('A', $user, $idamb);
    $detalleAnuladasCaj = $pos->getDetalleFacturaAnuladaCajeroDia('X', $user, $idamb);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(260, 5, 'INFORME DE VENTAS - BALANCE DIARIO', 0, 1, 'C');
    $pdf->Cell(260, 5, 'BALANCE GENERADO EN AUDITORIA ', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(260, 5, 'USUARIO : '.$user, 0, 1, 'C');
    $pdf->Cell(260, 5, 'Fecha : '.$fecha, 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(260, 7, 'DETALLE FACTURAS GENERADAS ', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(15, 6, 'Fact.', 1, 0, 'C');
    $pdf->Cell(25, 6, 'Neto ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Impuesto ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Propina ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Descuento ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Abonos ', 1, 0, 'C');
    $pdf->Cell(25, 6, 'Pagado ', 1, 0, 'C');
    $pdf->Cell(25, 6, 'Total ', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Usuario ', 1, 0, 'C');
    $pdf->Cell(40, 6, 'Forma de Pago ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Hora ', 1, 1, 'C');

    $fact = 0;
    $neto = 0;
    $impt = 0;
    $prop = 0;
    $tota = 0;
    $desc = 0;
    $abon = 0;
    $pago = 0;

    foreach ($detallesCaj as $detalle) {
        $fact = $fact + 1;
        $neto = $neto + $detalle['valor_neto'];
        $impt = $impt + $detalle['impuesto'];
        $prop = $prop + $detalle['propina'];
        $desc = $desc + $detalle['descuento'];
        $abon = $abon + $detalle['abonos'];
        $pago = $pago + $detalle['pagado'];
        $tota = $tota + $detalle['pagado'] + $detalle['abonos'];

        $pdf->Cell(15, 6, $detalle['factura'], 1, 0, 'R');
        $pdf->Cell(25, 6, number_format($detalle['valor_neto'], 2), 1, 0, 'R');
        $pdf->Cell(20, 6, number_format($detalle['impuesto'], 2), 1, 0, 'R');
        $pdf->Cell(20, 6, number_format($detalle['propina'], 2), 1, 0, 'R');
        $pdf->Cell(20, 6, number_format($detalle['descuento'], 2), 1, 0, 'R');
        $pdf->Cell(20, 6, number_format($detalle['abonos'], 2), 1, 0, 'R');
        $pdf->Cell(25, 6, number_format($detalle['pagado'], 2), 1, 0, 'R');
        $pdf->Cell(25, 6, number_format($detalle['pagado'] + $detalle['abonos'], 2), 1, 0, 'R');
        $pdf->Cell(30, 6, $detalle['usuario'], 1, 0, 'L');
        $pdf->Cell(40, 6, substr($pos->nombrePago($detalle['forma_pago']), 0, 19), 1, 0, 'L');
        $pdf->Cell(20, 6, substr($detalle['fecha_factura'], 11, 8), 1, 1, 'R');
    }
    $pdf->Cell(15, 6, 'Total', 1, 0, 'C');
    $pdf->Cell(25, 6, number_format($neto, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($impt, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($prop, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($desc, 2), 1, 0, 'R');
    $pdf->Cell(20, 6, number_format($abon, 2), 1, 0, 'R');
    $pdf->Cell(25, 6, number_format($pago, 2), 1, 0, 'R');
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

    $fact = 0;
    $neto = 0;
    $impt = 0;
    $prop = 0;
    $tota = 0;
    $desc = 0;

    foreach ($detalleAnuladasCaj as $detalle) {
        $fact = $fact + 1;
        $neto = $neto + $detalle['valor_neto'];
        $impt = $impt + $detalle['impuesto'];
        $prop = $prop + $detalle['propina'];
        $desc = $desc + $detalle['descuento'];
        $tota = $tota + $detalle['valor_total'];

        $pdf->Cell(25, 6, $detalle['factura'], 1, 0, 'R');
        $pdf->Cell(25, 6, $detalle['comanda'], 1, 0, 'R');
        $pdf->Cell(25, 6, $detalle['mesa'], 1, 0, 'R');
        $pdf->Cell(25, 6, $detalle['pax'], 1, 0, 'R');
        $pdf->Cell(35, 6, number_format($detalle['valor_total'], 2), 1, 0, 'R');
        $pdf->Cell(30, 6, $detalle['usuario_anulada'], 1, 0, 'L');
        $pdf->Cell(95, 6, substr($detalle['motivo_anulada'], 0, 40), 1, 1, 'L');
    }
}

$user = $oldUser;
$iduser = $oldidUser;

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 7, 'DETALLE FORMAS DE PAGO ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 6, 'Forma de pago.', 1, 0, 'C');
$pdf->Cell(25, 6, 'Cant. ', 1, 0, 'C');
$pdf->Cell(35, 6, 'SubTotal ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Abonos ', 1, 0, 'C');
/* $pdf->Cell(35, 6, 'Descuentos ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Impuestos  ', 1, 0, 'C'); */
$pdf->Cell(35, 6, 'Total Fact ', 1, 1, 'C');

$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$desc = 0;
$canti = 0;
$abono = 0;

foreach ($pagos as $detalle) {
    // $fact = $fact + 1;
    $canti += $detalle['cant'];
    $neto += $detalle['neto'];
    // $impt += $impt + $detalle['abono'];
    $abono += $detalle['abono'];
    /* $prop = $prop + $detalle['prop'];
    $desc = $desc + $detalle['desc']; */
    $tota += $detalle['pagado'];

    $pdf->Cell(60, 6, $detalle['descripcion'], 1, 0, 'L');
    $pdf->Cell(25, 6, $detalle['cant'], 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['neto'], 2), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['abono'], 2), 1, 0, 'R');
    /* $pdf->Cell(35, 6, number_format($detalle['desc'], 2), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['impto'], 2), 1, 0, 'R') */
    $pdf->Cell(35, 6, number_format($detalle['pagado'] + $detalle['abono'], 2), 1, 1, 'R');
}
$pdf->Cell(60, 6, 'Total', 1, 0, 'C');
$pdf->Cell(25, 6, number_format($canti, 0), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($neto, 2), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($abono, 2), 1, 0, 'R');
/* $pdf->Cell(35, 6, number_format($desc, 2), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($impt, 2), 1, 0, 'R'); */
$pdf->Cell(35, 6, number_format($tota + $abono, 2), 1, 1, 'R');

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(155, 7, 'DETALLE FORMAS DE PAGO ANULADAS ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 6, 'Forma de pago.', 1, 0, 'C');
$pdf->Cell(25, 6, 'Cant. ', 1, 0, 'C');
$pdf->Cell(35, 6, 'SubTotal ', 1, 0, 'C');
/* $pdf->Cell(35, 6, 'Propina ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Descuentos ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Impuestos  ', 1, 0, 'C'); */
$pdf->Cell(35, 6, 'Total Fact ', 1, 1, 'C');

$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$desc = 0;
$cant = 0;

foreach ($pagosAnulados as $detalle) {
    // $fact = $fact + 1;
    $neto += $detalle['neto'];
    /* $impt = $impt + $detalle['impto'];
    $prop = $prop + $detalle['prop'];
    $desc = $desc + $detalle['desc']; */
    $tota += $detalle['pagado'];
    $cant += $detalle['cant'];

    $pdf->Cell(60, 6, $detalle['descripcion'], 1, 0, 'L');
    $pdf->Cell(25, 6, $detalle['cant'], 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['neto'], 2), 1, 0, 'R');
    /* $pdf->Cell(35, 6, number_format($detalle['prop'], 2), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['desc'], 2), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['impto'], 2), 1, 0, 'R'); */
    $pdf->Cell(35, 6, number_format($detalle['pagado'], 2), 1, 1, 'R');
}
$pdf->Cell(60, 6, 'Total', 1, 0, 'C');
$pdf->Cell(25, 6, number_format($cant, 0), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($neto, 2), 1, 0, 'R');
/* $pdf->Cell(35, 6, number_format($prop, 2), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($desc, 2), 1, 0, 'R');
$pdf->Cell(35, 6, number_format($impt, 2), 1, 0, 'R'); */
$pdf->Cell(35, 6, number_format($tota, 2), 1, 1, 'R');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(205, 8, 'ABONOS RECIBIDOS ', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, 'Comanda. ', 1, 0, 'C');
$pdf->Cell(40, 6, 'Forma de Pago ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Total Abono ', 1, 0, 'C');
$pdf->Cell(30, 6, 'Usuario ', 1, 0, 'C');
$pdf->Cell(70, 6, 'Detalle Abono ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Hora ', 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$desc = 0;

foreach ($abonos as $detalle) {
    $fact = $fact + 1;
    $neto = $neto + $detalle['valor'];
    $pdf->Cell(20, 6, $detalle['comanda'], 1, 0, 'R');
    $pdf->Cell(40, 6, substr($detalle['descripcion'], 0, 19), 1, 0, 'L');
    $pdf->Cell(25, 6, number_format($detalle['valor'], 2), 1, 0, 'R');
    $pdf->Cell(30, 6, $detalle['usuario'], 1, 0, 'L');
    $pdf->Cell(70, 6, substr($detalle['comentarios'], 0, 35), 1, 0, 'L');
    $pdf->Cell(20, 6, substr($detalle['created_at'], 11, 8), 1, 1, 'R');
}
$pdf->Cell(60, 6, 'Total', 1, 0, 'C');
$pdf->Cell(25, 6, number_format($neto, 2), 1, 1, 'R');

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(180, 8, 'DETALLE VENTAS CREDITO DEL DIA ', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(120, 6, 'Cliente', 1, 0, 'C');
$pdf->Cell(25, 6, 'Factura ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Total Fact ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 11);

$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$desc = 0;
$canti = 0;
foreach ($creditos as $detalle) {
    $fact = $fact + 1;
    $tota = $tota + $detalle['valor_total'];

    $pdf->Cell(120, 6, utf8_decode($detalle['apellido1'].' '.$detalle['apellido2'].' '.$detalle['nombre1'].' '.$detalle['nombre2']), 1, 0, 'L');
    $pdf->Cell(25, 6, $detalle['factura'], 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($detalle['valor_total'], 2), 1, 1, 'R');
}
$pdf->Cell(145, 6, 'Total Ventas Credito', 1, 0, 'C');
$pdf->Cell(35, 6, number_format($tota, 2), 1, 1, 'R');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(230, 7, 'COMANDAS ANULADAS ', 1, 1, 'C');
$pdf->Cell(20, 6, 'Comanda.', 1, 0, 'C');
$pdf->Cell(20, 6, 'Mesa ', 1, 0, 'C');
$pdf->Cell(20, 6, 'PAX. ', 1, 0, 'C');
$pdf->Cell(30, 6, 'Usuario', 1, 0, 'C');
$pdf->Cell(20, 6, 'Hora', 1, 0, 'C');
$pdf->Cell(120, 6, 'Motivo', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);

$pdf->Ln(5);

$monto = 0;
$impto = 0;
$total = 0;
$comaAnu = 0;
if (count($comandaAnuladas) == 0) {
    // $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(230, 5, 'SIN COMANDAS ANULADAS', 1, 1, 'C');
    $pdf->Ln(2);
} else {
    foreach ($comandaAnuladas as $comanda) {
        $comaAnu = $comaAnu + $comanda['pax'];
        $pdf->Cell(20, 5, $comanda['comanda'], 1, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 1, 0, 'C');
        $pdf->Cell(20, 5, $comanda['pax'], 1, 0, 'C');
        $pdf->Cell(30, 5, $pos->nombreUsuario($comanda['id_usuario_anula']), 1, 0, 'R');
        $pdf->Cell(20, 5, substr($comanda['fecha_comanda_anulada'], 11, 5), 1, 0, 'R');
        $pdf->Cell(120, 5, $comanda['motivo_anulada'], 1, 1, 'L');
    }
}
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 7, 'POPULARIDAS DE PRODUCTOS ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 6, 'Producto', 1, 0, 'C');
$pdf->Cell(25, 6, 'Cant. ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Total Venta ', 1, 1, 'C');

foreach ($populares as $popular) {
    $pdf->Cell(90, 5, utf8_decode($popular['nom']), 1, 0, 'L');
    $pdf->Cell(25, 5, $popular['cant'], 1, 0, 'R');
    $pdf->Cell(35, 5, number_format($popular['venta'], 2), 1, 1, 'R');
}

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 7, 'POPULARIDAS DE PRODUCTOS [FACTURAS ANULADAS]', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 6, 'Producto', 1, 0, 'C');
$pdf->Cell(25, 6, 'Cant. ', 1, 0, 'C');
$pdf->Cell(35, 6, 'Total Venta ', 1, 1, 'C');

foreach ($popularAnulados as $popular) {
    $pdf->Cell(90, 5, utf8_decode($popular['nom']), 1, 0, 'L');
    $pdf->Cell(25, 5, $popular['cant'], 1, 0, 'R');
    $pdf->Cell(35, 5, number_format($popular['venta'], 2), 1, 1, 'R');
}

$pdf->Ln(5);

$monto = 0;
$impto = 0;
$total = 0;

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(220, 7, 'DEVOLUCION DE PRODUCTOS ', 1, 1, 'C');
if (count($devoluciones) == 0) {
    $pdf->Cell(220, 5, 'SIN DEVOLUCION DE PRODUCTOS  ', 1, 1, 'C');
    $pdf->Ln(2);
} else {
    $pdf->Cell(20, 6, 'Comanda.', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Mesa ', 1, 0, 'C');
    $pdf->Cell(70, 6, 'Producto. ', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Cantidad', 1, 0, 'C');
    $pdf->Cell(65, 6, 'Motivo Devolucion', 1, 0, 'C');
    $pdf->Cell(25, 6, 'Usuario', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    foreach ($devoluciones as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 1, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 1, 0, 'C');
        $pdf->Cell(70, 5, utf8_decode($comanda['nom']), 1, 0, 'L');
        $pdf->Cell(20, 5, $comanda['cant'], 1, 0, 'C');
        $pdf->Cell(65, 5, utf8_decode($comanda['motivo_devo']), 1, 0, 'L');
        $pdf->Cell(25, 5, $comanda['usuario_devo'], 1, 1, 'L');
    }
}
$pdf->Ln(3);

$file = '../imprimir/auditorias/Balance_diario_'.$pref.'_'.$fecha.'.pdf';

$pdf->Output($file, 'F');
