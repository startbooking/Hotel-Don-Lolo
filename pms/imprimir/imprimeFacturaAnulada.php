<?php

require '../../../res/fpdf/fpdf.php';

$nroFactura = $numero;

$file = '../../imprimir/facturas/Factura_'.$nroFactura.'.pdf';

if ($file) {
    unlink($file);
    clearstatcache();
}

$datosFactura = $hotel->getDatosFactura($nroFactura);

$tipofac = $datosFactura[0]['tipo_factura'];
$reserva = $datosFactura[0]['numero_reserva'];
$nroFolio = $datosFactura[0]['folio_cargo'];

$datosReserva = $hotel->getReservasDatos($reserva);
// $datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);
$datosHuesped = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);

if ($tipofac == 2) {
    $idperfil = $datosFactura[0]['id_perfil_factura'];
    $datosCompania = $hotel->getSeleccionaCompania($idperfil);
    $diasCre = $datosCompania[0]['dias_credito'];
} else {
    $idperfil = $datosFactura[0]['id_huesped'];
}

$firma = 'W/eofOdb7ab24WMN3jRdAlKoXbyFGIwf7flA9oE6kRovu+KqWV9MBHTl1cfgN2axTAt3cfoaZoygVZhedk29lVQ3H4Z8BiLBIGrZcqlkr5odfd1ixEgT28NGMa9Ji3sAGdaVNT8Upe7MkW+tkG4dOvnhhi+N20ohx7RHVT0me1t40SI51
dYA/LdUWiNZXOSE3FYBLMjNTueZs0+uGrOGPltl3G2LsSoTIuEK/x/DHCucDzmJFXpgGqlXrv1a1cZuad9mI+nN3XU3CAGyXl4acUjrH5ZWhYukW9z+uftnIzYRnwh01nVzOhHhzeVVWcGqaX4k8Vw9GVlhZbJaCsFvbw==';
$fechaFac = FECHA_PMS;
$fechaFac = $datosFactura[0]['fecha_salida'];
$fechaVen = $datosFactura[0]['fecha_vencimiento'];
/* $fechaVen = strtotime('+ '.$diasCre.' day', strtotime($fechaFac));
$fechaVen = date('Y-m-j', $fechaVen);
 */
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);

$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $nroFolio, 1);

$pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $nroFolio, 3);
$tipoimptos = $hotel->getValorImptoFolio($nroFactura, $reserva, $nroFolio, 2);
// $fecha = $hotel->getDatePms();

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 50, 190, 210);
$pdf->Image('../../../img/'.LOGO, 10, 5, 40);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 4, (NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(190, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(190, 4, (ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (CIUDAD_EMPRESA).' '.PAIS_EMPRESA, 0, 1, 'C');
// $pdf->Cell(40, 4, '', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (REGIMEN), 0, 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (MAIL_HOTEL), 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (ACTIVIDAD), 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(40, 4, 'FACTURA ELECTRONICA DE VENTA', 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->setY(42);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->MultiCell(110, 4, (TEXTORESOLUCION), 0, 'C');
$pdf->Cell(150, 4, '', 0, 0, 'C');
$pdf->setY(46);
$pdf->setX(160);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(40, 4, 'Nro HDL-'.str_pad($nroFactura, 4, '0', STR_PAD_LEFT), 1, 'C');
$pdf->SetFont('Arial', '', 8);

echo 'Tres';

$pdf->Ln(1);

$pdf->Image('../../../img/facturaanulada.png', 50, 50, 100);

$pdf->SetFont('Arial', 'B', 8);
if ($tipofac == 2) {
    if (!empty($datosCompania)) {
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(30, 4, 'RAZON SOCIAL', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(120, 4, ($datosCompania[0]['empresa']), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(10, 4, 'NIT.', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(30, 4, number_format($datosCompania[0]['nit'], 0).'-'.$datosCompania[0]['dv'], 0, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(30, 4, 'DIRECCION', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(70, 4, substr(($datosCompania[0]['direccion']), 0, 35), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 4, 'CIUDAD', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(30, 4, (substr($hotel->getCityName($datosCompania[0]['ciudad']), 0, 12)), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(21, 4, 'TELEFONO', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B');
        $pdf->Cell(20, 4, $datosCompania[0]['telefono'], 0, 1, 'L');
    }
} else {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'CLIENTE', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(70, 4, substr(($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']), 0, 30), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 4, 'IDENTIFICACION', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(25, 4, $datosHuesped[0]['identificacion'], 0, 1, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'DIRECCION', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(70, 4, ($datosHuesped[0]['direccion']), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 4, 'CIUDAD', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(30, 4, substr(($hotel->getCityName($datosHuesped[0]['ciudad'])), 0, 12), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 4, 'TELEFONO', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(15, 4, $datosHuesped[0]['telefono'], 0, 1, 'L');
}

echo 'CUatro ';

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 4, 'Huesped ', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 4, substr(($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']), 0, 30), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(25, 4, 'Identificacion', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 4, $datosHuesped[0]['identificacion'], 0, 0, 'L');
// $pdf->ln(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 4, (strtoupper(substr($datosReserva[0]['orden_reserva'], 0, 18))), 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(38, 4, ('ADULTOS / NIÑOS'), 1, 0, 'C');
$pdf->Cell(38, 4, 'HABITACION', 1, 0, 'C');
$pdf->Cell(38, 4, 'TARIFA', 1, 0, 'C');
$pdf->Cell(38, 4, 'HORAL SALIDA', 1, 0, 'C');
$pdf->Cell(38, 4, 'REGISTRO NRO', 1, 1, 'C');
$pdf->Cell(38, 4, $datosReserva[0]['can_hombres'] + $datosReserva[0]['can_mujeres'].'/'.$datosReserva[0]['can_ninos'], 1, 0, 'C');
$pdf->Cell(38, 4, $datosReserva[0]['num_habitacion'], 1, 0, 'C');
$pdf->Cell(38, 4, number_format($datosReserva[0]['valor_diario'], 2), 1, 0, 'C');
$pdf->Cell(38, 4, date('H:m:s'), 1, 0, 'C');

$pdf->Cell(38, 4, str_pad($datosReserva[0]['num_registro'], 4, '0', STR_PAD_LEFT), 1, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(47, 4, 'FECHA LLEGADA', 1, 0, 'C');
$pdf->Cell(47, 4, 'FECHA SALIDA', 1, 0, 'C');
$pdf->Cell(48, 4, 'FECHA EXPEDICION', 1, 0, 'C');
$pdf->Cell(48, 4, 'FECHA VENCIMIENTO', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(47, 4, $datosReserva[0]['fecha_llegada'], 1, 0, 'C');
$pdf->Cell(47, 4, $datosReserva[0]['fecha_salida'], 1, 0, 'C');
$pdf->Cell(48, 4, FECHA_PMS, 1, 0, 'C');
$pdf->Cell(48, 4, $fechaVen, 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln(4);
$pdf->Cell(15, 8, 'CANT', 1, 0, 'C');
$pdf->Cell(65, 8, 'CONCEPTO', 1, 0, 'C');
$pdf->Cell(30, 8, 'VALOR', 1, 0, 'C');
$pdf->Cell(20, 8, '% IMPTO', 1, 0, 'C');
$pdf->Cell(30, 8, 'IMPTO', 1, 0, 'C');
$pdf->Cell(30, 8, 'TOTAL', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);

$consumos = 0;
$impto = 0;
$pagos = 0;
$total = $consumos + $impto;
foreach ($folios as $folio1) {
    $pdf->Cell(15, 4, $folio1['cant'], 0, 0, 'C');
    $pdf->Cell(65, 4, ($folio1['descripcion_cargo']), 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($folio1['cargos'], 2), 0, 0, 'R');
    $pdf->Cell(20, 4, number_format($folio1['porcentaje_impto'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($folio1['imptos'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($folio1['cargos'] + $folio1['imptos'], 2), 0, 1, 'R');
    $consumos = $consumos + $folio1['cargos'];
    $impto = $impto + $folio1['imptos'];
    $total = $consumos + $impto;
    $pagos = $pagos + $folio1['pagos'];
}

$pdf->Cell(110, 4, '', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(50, 4, 'TOTAL ', 1, 0, 'C');
$pdf->Cell(30, 4, number_format($total, 2), 1, 1, 'R');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 8);
$pdf->setY(155);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(190, 4, 'FORMAS DE PAGO ', 1, 1, 'C');
$pdf->Cell(100, 4, 'DETALLE', 1, 0, 'C');
$pdf->Cell(90, 4, 'VALOR', 1, 1, 'R');
$pagos = 0;
$pdf->SetFont('Arial', '', 8);
foreach ($pagosfolio as $pagofolio) {
    $pagos = $pagos + $pagofolio['pagos'];
    $pdf->Cell(100, 5, $pagofolio['descripcion_cargo'], 0, 0, 'L');
    $pdf->Cell(90, 5, number_format($pagofolio['pagos'], 2), 0, 1, 'R');
}
$pdf->Cell(100, 5, '', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(60, 5, 'TOTAL ', 1, 0, 'C');
$pdf->Cell(30, 5, number_format($pagos, 2), 1, 1, 'R');
$pdf->setY(190);
// $pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(95, 5, 'IMPUESTOS', 1, 0, 'C');
$pdf->Cell(95, 5, 'INFORMACION TRIBUTARIA', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(45, 5, 'TIPO IMPUESTO', 1, 0, 'C');
$pdf->Cell(20, 5, 'BASE', 1, 0, 'C');
$pdf->Cell(30, 5, 'VALOR', 1, 0, 'C');
$pdf->Cell(45, 5, 'TIPO RETENCION', 1, 0, 'C');
$pdf->Cell(20, 5, 'BASE', 1, 0, 'C');
$pdf->Cell(30, 5, 'VALOR', 1, 1, 'C');
foreach ($tipoimptos as $tipoimpto) {
    $pdf->Cell(45, 4, $tipoimpto['descripcion_cargo'], 0, 0, 'L');
    $pdf->Cell(20, 4, number_format($tipoimpto['cargos'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($tipoimpto['imptos'], 2), 0, 1, 'R');
}
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(190, 4, 'SON :'.numtoletras($total), 1, 'L');
$pdf->SetFont('Arial', '', 5);
$pdf->MultiCell(190, 3, ('Representación impresa de la factura electrónica,Firma Electrónica y Cufe : ').'CUFE'.('Fecha Validación Dian = ').' FIRMA = '.$firma, 1, 'L');
$pdf->setY(226);
$pdf->SetFont('Arial', '', 7);
$pdf->MultiCell(95, 4, (TEXTOBANCO).', '.(TEXTOFACTURA), 1, 'C');
$y = $pdf->GetY();
$pdf->SetY(226);
$pdf->SetX(105);
$pdf->SetFont('Arial', '', 8);

$pdf->MultiCell(95, 6, '  
                        Nombre                                             Identificacion

                        Firma                                              Fecha', 1, 'L');
$pdf->SetY(245);
$pdf->Cell(40, 5, 'FACTURADO POR :', 1, 0, 'C');
$pdf->Cell(55, 5, $usuario, 1, 1, 'L');

$pdf->SetY(250);

$pdf->Ln(1);
$pdf->SetFont('Arial', '', 6);

$pdf->MultiCell(190, 4, (PIEFACTURA), 0, 'C');

/* $file = '../../imprimir/facturas/Factura_'.$nroFactura.'.pdf';

$pdf->Output($file, 'F');

array_push($estadofactura, 'Factura_'.$nroFactura.'.pdf');
 */
$file = '../../imprimir/facturas/Factura_'.$nroFactura.'.pdf';

$pdf->Output($file, 'F');

?>

