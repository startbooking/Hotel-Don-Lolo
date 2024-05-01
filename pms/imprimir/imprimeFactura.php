<?php

require '../../../res/fpdf/fpdf.php';
require '../../../res/phpqrcode/qrlib.php'; 

$filename = '../../../img/pms/QR_'.$prefijo.'-'.$nroFactura.'.png';
$size = 100; // Tamaño en píxeles
$level = 'L'; // Nivel de corrección (L, M, Q, H)

// Generar el código QR
QRcode::png($QRStr, $filename, $level, $size);

$aplicarete = 0;
$aplicaiva = 0;
$aplicaica = 0;
$sinBaseRete = 0;
  
$datosReserva = $hotel->getReservasDatos($reserva);
$datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);
$horaIng = $datosReserva[0]['hora_llegada'];

if ($tipofac == 2) { 
  $datosCompania = $hotel->getSeleccionaCompania($idperfil);
  $diasCre = $datosCompania[0]['dias_credito'];  
  $aplicarete = $datosCompania[0]['retefuente'];
  $aplicaiva  = $datosCompania[0]['reteiva'];
  $aplicaica  = $datosCompania[0]['reteica'];
  $sinBaseRete  = $datosCompania[0]['sinBaseRete'];
}
$textoResol = 'RESOLUCION DIAN No.'.$resolucion.' de '.$fechaRes.' Autorizacion Pref '.$prefijo.' desde el No. '.$desde.' AL '.$hasta;

$fechaFac = FECHA_PMS;
$fechaVen = $fechaFac;
$fechaVen = strtotime('+ '.$diasCre.' day', strtotime($fechaFac));
$fechaVen = date('Y-m-d', $fechaVen);

$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);
$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $folioAct, 1);
$pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $folioAct, 3);
$tipoimptos = $hotel->getValorImptoFolio($nroFactura, $reserva, $folioAct, 2);
$fecha = $hotel->getDatePms();
$retenciones = [];

if($aplicarete==1){
  if($sinBaseRete==1){
    $retenciones = $hotel->traeValorRetencionesSinBase($reserva, $folioAct);
  }else{
    $retenciones = $hotel->traeValorRetenciones($reserva, $folioAct);
  }
}

if($datosReserva[0]['fecha_salida'] > FECHA_PMS){
  $fechaSalida = FECHA_PMS;
}else{
  $fechaSalida = $datosReserva[0]['fecha_salida'];
}

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 50, 190, 210);
$pdf->Image('../../../img/'.LOGO, 10, 5, 40);
$pdf->Image($filename, 163, 5, 35);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 4, utf8_decode(NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(190, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(190, 4, utf8_decode(ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA, 0, 1, 'C');
// $pdf->Cell(40, 4, '', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, utf8_decode(REGIMEN), 0, 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, utf8_decode(MAIL_HOTEL), 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, utf8_decode(ACTIVIDAD), 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(40, 4, 'FACTURA ELECTRONICA DE VENTA', 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->setY(42);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->MultiCell(110, 4, utf8_decode($textoResol), 0, 'C');
$pdf->Cell(150, 4, '', 0, 0, 'C');
$pdf->setY(46);
$pdf->setX(160);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(40, 4, 'Nro '.$prefijo.' '.str_pad($nroFactura, 4, '0', STR_PAD_LEFT), 1, 'C');
$pdf->SetFont('Arial', '', 8);

$pdf->Ln(1);

$pdf->SetFont('Arial', 'B', 8);
if ($tipofac == 2) {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'RAZON SOCIAL', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(120, 4, utf8_decode($datosCompania[0]['empresa']), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(10, 4, 'NIT.', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(30, 4, number_format($datosCompania[0]['nit'], 0) . '-' . $datosCompania[0]['dv'], 0, 1, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'DIRECCION', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(70, 4, substr(utf8_decode($datosCompania[0]['direccion']), 0, 35), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 4, 'CIUDAD', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(30, 4, utf8_decode(substr($hotel->getCityName($datosCompania[0]['ciudad']), 0, 12)), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(21, 4, 'TELEFONO', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B');
    $pdf->Cell(20, 4, $datosCompania[0]['telefono'], 0, 1, 'L');
} else {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'CLIENTE', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(70, 4, substr(utf8_decode($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']), 0, 30), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(35, 4, 'IDENTIFICACION', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(25, 4, $datosHuesped[0]['identificacion'], 0, 1, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 4, 'DIRECCION', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(70, 4, utf8_decode($datosHuesped[0]['direccion']), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(15, 4, 'CIUDAD', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(30, 4, substr(utf8_decode($hotel->getCityName($datosHuesped[0]['ciudad'])), 0, 12), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 4, 'TELEFONO', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(15, 4, $datosHuesped[0]['telefono'], 0, 1, 'L');
}

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 4, 'Huesped ', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 4, substr(utf8_decode($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']), 0, 30), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(25, 4, 'Identificacion', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 4, $datosHuesped[0]['identificacion'], 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(190, 4, utf8_decode(strtoupper($datosReserva[0]['orden_reserva'])), 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(32, 4, utf8_decode('ADULTOS / NIÑOS'), 1, 0, 'C');
$pdf->Cell(32, 4, 'HABITACION', 1, 0, 'C');
$pdf->Cell(32, 4, 'TARIFA', 1, 0, 'C');
$pdf->Cell(31, 4, 'HORA LLEGADA', 1, 0, 'C');
$pdf->Cell(31, 4, 'HORA SALIDA', 1, 0, 'C');
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
$pdf->Cell(48, 4, $fechaSalida, 1, 0, 'C');
$pdf->Cell(47, 4, FECHA_PMS, 1, 0, 'C');
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
  $pdf->Cell(65, 4, utf8_decode($folio1['descripcion_cargo']), 0, 0, 'L');
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
$pdf->setY(155);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(95, 4, 'RETENCIONES ', 1, 0, 'C');
$pdf->Cell(95, 4, 'FORMAS DE PAGO ', 1, 1, 'C');
$pdf->Cell(35, 4, 'RETENCION', 1, 0, 'C');
$pdf->Cell(30, 4, 'BASE', 1, 0, 'R');
$pdf->Cell(30, 4, 'VALOR', 1, 0, 'R');
$pdf->Cell(60, 4, 'DETALLE', 1, 0, 'C');
$pdf->Cell(35, 4, 'VALOR', 1, 1, 'R');

$totRetencion = 0 ;
$pdf->SetFont('Arial', '', 8);
  if($tipofac == 2){
    if(count($retenciones) == 0){
      $pdf->Cell(35,   4, 'RETEFUENTE', 1, 0, 'L');
      $pdf->Cell(30, 4, number_format(0, 2), 1, 0, 'R');
      $pdf->Cell(30, 4, number_format(0, 2), 1, 1, 'R');
      $totRetencion = $totRetencion + 0;
    }else {
      foreach ($retenciones as $retencion) {  
        if($tipofac == 2 ){
          $pdf->Cell(35, 4, $retencion['descripcionRetencion'], 1, 0, 'L');
          $pdf->Cell(30, 4, number_format($retencion['base'], 2), 1, 0, 'R');
          $pdf->Cell(30, 4, number_format($retencion['valorRetencion'], 2), 1, 1, 'R');
          $totRetencion = $totRetencion + round($retencion['valorRetencion']);      
        }else{
          $pdf->Cell(35,   4, 'RETEFUENTE', 1, 0, 'L');
          $pdf->Cell(30, 4, number_format(0, 2), 1, 0, 'R');
          $pdf->Cell(30, 4, number_format(0, 2), 1, 1, 'R');
          $totRetencion = $totRetencion + 0;
        }
      }
    }
  }else{
    $pdf->Cell(35, 4, 'RETEFUENTE', 1, 0, 'L');
    $pdf->Cell(30, 4, number_format(0, 2), 1, 0, 'R');
    $pdf->Cell(30, 4, number_format(0, 2), 1, 1, 'R');
    $totRetencion = $totRetencion + 0;
  }
  
  $pdf->Cell(35, 4, 'RETEIVA', 1, 0, 'L');
  if($tipofac == 2){
    $pdf->Cell(30, 4, number_format($baseIva, 2), 1, 0, 'R');
    $pdf->Cell(30, 4, number_format($reteiva, 2), 1, 1, 'R');
  } else {
    $baseIva = 0;
    $reteiva = 0;
    $pdf->Cell(30, 4, number_format($baseIva, 2), 1, 0, 'R');
    $pdf->Cell(30, 4, number_format($reteiva, 2), 1, 1, 'R');
  }

  $pdf->Cell(35, 4, 'RETEICA', 1, 0, 'L');
  if($tipofac == 2){
    $pdf->Cell(30, 4, number_format($baseIca, 2), 1, 0, 'R');
    $pdf->Cell(30, 4, number_format($reteica, 2), 1, 1, 'R');
  } else {
    $baseIca = 0;
    $reteica = 0;
    $pdf->Cell(30, 4, number_format($baseIca, 2), 1, 0, 'R');
    $pdf->Cell(30, 4, number_format($reteica, 2), 1, 1, 'R');
  } 

if($tipofac == 2 && ($aplicarete == 1 || $aplicaiva == 1 || $aplicaica == 1)){
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(50, 4, 'TOTAL RETENCIONES', 1, 0, 'L');
  $pdf->Cell(45, 4, number_format($reteiva + $reteica + $totRetencion, 2), 1, 1, 'R');
} 
$pdf->SetFont('Arial', '', 8);
$pagos = 0;
$pdf->setY(163);
$pdf->setX(105);

$pdf->SetFont('Arial', '', 8);

foreach ($pagosfolio as $pagofolio) {
    $pdf->setX(105);
    $pagos = $pagos + $pagofolio['pagos'];
    $pdf->Cell(60, 4, $pagofolio['descripcion_cargo'], 0, 0, 'L');
    $pdf->Cell(35, 4, number_format($pagofolio['pagos'], 2), 0, 1, 'R');
}
$pdf->Cell(95, 4, '', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(60, 4, 'TOTAL ', 1, 0, 'C');
$pdf->Cell(35, 4, number_format($pagos, 2), 1, 1, 'R');
$pdf->setY(190);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(95, 5, 'IMPUESTOS', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(45, 5, 'TIPO IMPUESTO', 1, 0, 'C');
$pdf->Cell(20, 5, 'BASE', 1, 0, 'C');
$pdf->Cell(30, 5, 'VALOR', 1, 1, 'C');

foreach ($tipoimptos as $tipoimpto) {
    $pdf->Cell(45, 4, $tipoimpto['descripcion_cargo'], 0, 0, 'L');
    $pdf->Cell(20, 4, number_format($tipoimpto['cargos'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($tipoimpto['imptos'], 2), 0, 1, 'R');
}
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(190, 4, 'SON :'.numtoletras($pagos), 1, 'L');
$pdf->SetFont('Arial', '', 6);
$pdf->MultiCell(190, 4, utf8_decode('Factura Nro : ').$prefijo.' '.$nroFactura.' '.utf8_decode(' Fecha Validación Dian ').$timeCrea.' CUFE '.$cufe, 1, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->MultiCell(190, 5, utf8_decode('Observaciones ').utf8_decode(strtoupper($detallePag)).' '.utf8_decode(strtoupper($refer)), 1, 'L');
$pdf->setY(226);
$pdf->SetFont('Arial', '', 7);
$pdf->MultiCell(95, 4, utf8_decode(TEXTOBANCO).', '.utf8_decode(TEXTOFACTURA), 1, 'C');
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

$pdf->MultiCell(190, 4, utf8_decode(PIEFACTURA), 0, 'C');

$file = '../../imprimir/facturas/FES-'.$prefijo.$nroFactura.'.pdf';

$pdf->Output($file, 'F');
$oFile = 'FES-'.$prefijo.$nroFactura.'.pdf';

$pdfFile = $pdf->Output('', 'S');
$base64Factura = chunk_split(base64_encode($pdfFile));
?>

