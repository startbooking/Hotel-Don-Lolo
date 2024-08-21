<?php

require_once '../../../res/fpdf/fpdf.php';

$datosReserva = $hotel->getReservasDatos($reserva);
$datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);

$horaIng = $datosReserva[0]['hora_llegada'];

if ($tipofac == 2) {
    $datosCompania = $hotel->getSeleccionaCompania($idperfil);
    $diasCre = $datosCompania[0]['dias_credito'];
}

$fechaFac = FECHA_PMS;
$fechaVen = $fechaFac;
$fechaVen = strtotime('+ '.$diasCre.' day', strtotime($fechaFac));
$fechaVen = date('Y-m-j', $fechaVen);

$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);
$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $nroFolio, 1);
$pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $nroFolio, 3);
$tipoimptos = $hotel->getValorImptoFolio($nroFactura, $reserva, $nroFolio, 2);
$fecha = $hotel->getDatePms();
$retenciones = $hotel->traeValorRetenciones($reserva, $nroFolio);

if($datosReserva[0]['fecha_salida']> FECHA_PMS){
    $fechaSalida = FECHA_PMS;
}else{
    $fechaSalida = $datosReserva[0]['fecha_salida'];
}

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 42, 190, 105);
$pdf->Image('../../../img/'.LOGO, 10, 5, 35);
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
$pdf->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 0, 'C');
$pdf->MultiCell(40, 4, 'RECIBO DE CAJA', 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (ACTIVIDAD), 0, 0, 'C');
$pdf->MultiCell(40, 4, 'Nro '.str_pad($nroFactura, 4, '0', STR_PAD_LEFT), 1, 'C');

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
$pdf->Cell(32, 4, ('ADULTOS / NIÑOS'), 1, 0, 'C');
$pdf->Cell(32, 4, 'HABITACION', 1, 0, 'C');
$pdf->Cell(32, 4, 'TARIFA', 1, 0, 'C');
$pdf->Cell(31, 4, 'HORAL LLEGADA', 1, 0, 'C');
$pdf->Cell(31, 4, 'HORAL SALIDA', 1, 0, 'C');
$pdf->Cell(32, 4, 'REGISTRO NRO', 1, 1, 'C');
$pdf->Cell(32, 4, $datosReserva[0]['can_hombres'] + $datosReserva[0]['can_mujeres'].'/'.$datosReserva[0]['can_ninos'], 1, 0, 'C');
$pdf->Cell(32, 4, $datosReserva[0]['num_habitacion'], 1, 0, 'C');
$pdf->Cell(32, 4, number_format($datosReserva[0]['valor_diario'], 2), 1, 0, 'C');
$pdf->Cell(31, 4, $horaIng, 1, 0, 'C');
$pdf->Cell(31, 4, date('H:m:s'), 1, 0, 'C');
$pdf->Cell(32, 4, str_pad($datosReserva[0]['num_registro'], 4, '0', STR_PAD_LEFT), 1, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(47, 4, 'FECHA LLEGADA', 1, 0, 'C');
$pdf->Cell(47, 4, 'FECHA SALIDA', 1, 0, 'C');
$pdf->Cell(48, 4, 'FECHA EXPEDICION', 1, 0, 'C');
$pdf->Cell(48, 4, 'FECHA VENCIMIENTO', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(47, 4, $datosReserva[0]['fecha_llegada'], 1, 0, 'C');
$pdf->Cell(47, 4, $fechaSalida, 1, 0, 'C');
$pdf->Cell(48, 4, FECHA_PMS, 1, 0, 'C');
$pdf->Cell(48, 4, $fechaVen, 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);

// $pdf->Ln(4);
$pdf->Cell(15, 5, 'CANT', 1, 0, 'C');
$pdf->Cell(65, 5, 'CONCEPTO', 1, 0, 'C');
$pdf->Cell(30, 5, 'VALOR', 1, 0, 'C');
$pdf->Cell(20, 5, '% IMPTO', 1, 0, 'C');
$pdf->Cell(30, 5, 'IMPTO', 1, 0, 'C');
$pdf->Cell(30, 5, 'TOTAL', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

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
$pdf->Ln(2);

$totrete = $reteiva+$reteica;

// echo print_r($retenciones);

foreach ($retenciones as $rete) {
    // echo 'Subtotal Retencion '.$totrete.'<br>';
    $pdf->Cell(35, 4, $rete['descripcionRetencion'], 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($rete['base'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($rete['retencion'], 2), 0, 1, 'R');    
    $totrete = $totrete + $rete['retencion'];
    /*     
    echo '<br> Retencion '.$rete['retencion'].'<br>';    
    echo 'Subtotal Retencion 2'.$totrete.'<br>';

 */    
}
/* echo 'Total Folio '.$total.'<br>' ;
echo 'Total Retenciones 1 '.$totrete.'<br>';
 */

foreach ($pagosfolio as $pagofolio) {
    $pdf->Cell(15, 4, '', 0, 0, 'C');
    $pagos = $pagos + $pagofolio['pagos'];
    $pdf->Cell(145, 4, 'Forma de Pago : '.$pagofolio['descripcion_cargo'], 0, 0, 'L');
    $pdf->Cell(30, 4, '('.number_format($pagofolio['pagos'], 2).')', 0, 1, 'R');
}



/* echo 'Total Consumos '.$total.'<br>' ;
echo 'Total Retenciones '.$totrete.'<br>';
echo 'Total Factura '.($total)-($totrete).'<br>';
echo 'Total Consumos '.$total.' '.$totrete.'<br>' ;
 */
$pdf->Cell(110, 4, '', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(50, 4, 'TOTALES ', 1, 0, 'C');
$pdf->Cell(30, 4, number_format($total-$totrete, 2), 1, 1, 'R');
$pdf->SetFont('Arial', '', 8);

$pdf->Ln(1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(190, 4, 'SON :'.numtoletras($total-$totrete), 1, 'L');
$pdf->Ln(1);

$y = $pdf->GetY();
$pdf->SetY(123);

$pdf->SetX(105);
$pdf->SetFont('Arial', '', 8);

$pdf->MultiCell(95, 6, '  
                        Nombre                                             Identificacion

                        Firma                                              Fecha', 1, 'L');
$pdf->SetY(135);
$pdf->Cell(40, 5, 'IMPRESO POR :', 0, 0, 'C');
$pdf->Cell(55, 5, $usuario, 0, 1, 'L');

// echo $file.'<br>';2848007

$file = '../../imprimir/notas/Abono_'.$nroFactura.'.pdf';
$oFile = 'Abono_'.$nroFactura.'.pdf';

// echo $file.'<br>';

$pdf->Output($file, 'F');

// echo $file.'<br>';


// array_push($estadofactura, 'Abono_'.$nroFactura.'.pdf');

// echo print_r($estadofactura);

?>

