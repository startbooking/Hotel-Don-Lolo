<?php

session_start();
require_once '../../../res/php/app_topHotel.php';
// require_once '../../res/fpdf/fpdf.php';
require_once '../../../res/fpdf/fpdf.php';

$nrofolio = 1;
$tipofac = 2;

$datosReserva = $hotel->getReservasDatos($reserva);
$datosHuesped = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
$datosCompania = $hotel->getSeleccionaCompania($idcia);
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);

$folios = $hotel->getConsumosCongeladaReservaAgrupadoCodigoFolio($reserva, $nrofolio, 1);
$fecha = $hotel->getDatePms();

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 45, 190, 214);

$pdf->Image('../../../img/'.LOGO, 10, 5, 40);

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 7, utf8_decode(NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(190, 5, 'Iva Regimen Comun', 0, 1, 'C');
$pdf->Cell(190, 5, utf8_decode(ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(40, 5, '', 0, 0, 'C');
$pdf->Cell(110, 5, utf8_decode(CIUDAD_EMPRESA.' '.PAIS_EMPRESA), 0, 0, 'C');
$pdf->Cell(40, 5, 'ESTADO DE CUENTA', 1, 1, 'C');
$pdf->Cell(40, 5, '', 0, 0, 'C');
$pdf->Cell(110, 5, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(110, 5, NAME_HOTEL, 0, 0, 'C');
$pdf->Cell(40, 5, str_pad($numcongela, 5, '0', STR_PAD_LEFT), 1, 1, 'C');
$pdf->Ln(3);
$pdf->Cell(190, 8, 'ESTE ES UN DOCUMENTO INFORMATIVO DEL ESTADO ACTUAL DEL HUESPED ', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'RAZON SOCIAL', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(120, 5, utf8_decode($datosCompania[0]['empresa']), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, 'NIT.', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, number_format($datosCompania[0]['nit'], 0).'-'.$datosCompania[0]['dv'], 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'DIRECCION', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 5, substr(utf8_decode($datosCompania[0]['direccion']), 0, 30), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, 'CIUDAD', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, utf8_decode(substr($hotel->getCityName($datosCompania[0]['ciudad']), 0, 12)), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(21, 5, 'TELEFONO', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, $datosCompania[0]['telefono'], 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'CLIENTE', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 5, substr(utf8_decode($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']), 0, 30), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5, 'IDENTIFICACION', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, $datosHuesped[0]['identificacion'], 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(47, 5, utf8_decode('ADULTOS / NIÑOS'), 1, 0, 'C');
$pdf->Cell(47, 5, 'HABITACION', 1, 0, 'C');
$pdf->Cell(48, 5, 'TARIFA', 1, 0, 'C');
$pdf->Cell(48, 5, 'HORAL SALIDA', 1, 1, 'C');
$pdf->Cell(47, 5, $datosReserva[0]['can_hombres'] + $datosReserva[0]['can_mujeres'].'/'.$datosReserva[0]['can_ninos'], 1, 0, 'C');
$pdf->Cell(47, 5, $datosReserva[0]['num_habitacion'], 1, 0, 'C');
$pdf->Cell(48, 5, $datosReserva[0]['tarifa'], 1, 0, 'C');
$pdf->Cell(48, 5, date('H:m:s'), 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(47, 5, 'FECHA LLEGADA', 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(47, 5, $datosReserva[0]['fecha_llegada'], 1, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(48, 5, 'FECHA SALIDA', 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(48, 5, $datosReserva[0]['fecha_salida'], 1, 1, 'C');

$pdf->Ln(4);
$pdf->Cell(85, 5, 'CONCEPTO', 1, 0, 'C');
$pdf->Cell(15, 5, 'CANT', 1, 0, 'C');
$pdf->Cell(30, 5, 'VALOR', 1, 0, 'C');
$pdf->Cell(30, 5, 'IMPTO', 1, 0, 'C');
$pdf->Cell(30, 5, 'TOTAL', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);

$consumos = 0;
$impto = 0;
$pagos = 0;
$total = $consumos + $impto;
foreach ($folios as $folio1) {
    $consumos = $consumos + $folio1['cargos'];
    $impto = $impto + $folio1['imptos'];
    $total = $consumos + $impto;
    $pagos = $pagos + $folio1['pagos'];
    $pdf->Cell(85, 5, utf8_decode($folio1['descripcion_cargo']), 0, 0, 'L');
    $pdf->Cell(15, 5, $folio1['cant'], 0, 0, 'C');
    $pdf->Cell(30, 5, number_format($folio1['cargos'], 2), 0, 0, 'R');
    $pdf->Cell(30, 5, number_format($folio1['imptos'], 2), 0, 0, 'R');
    $pdf->Cell(30, 5, number_format($folio1['cargos'] + $folio1['imptos'], 2), 0, 1, 'R');
}
$pdf->Cell(100, 5, '', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(60, 5, 'TOTAL ', 0, 0, 'C');
$pdf->Cell(30, 5, number_format($total, 2), 0, 1, 'R');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 5, 'SON :'.numtoletras($total), 0, 1, 'L');
$pdf->setY(155);

$y = $pdf->GetY();

$pdf->SetY(226);
$pdf->MultiCell(95, 4, '




          Cajero : '.$usuario, 1, 'C');
$pdf->SetY(226);
$pdf->SetX(105);
$pdf->MultiCell(95, 6, '
Nombre                                             Identificacion

Firma                                              Fecha', 1, 'L');
$pdf->Ln(1);

$pdf->MultiCell(190, 4, utf8_decode('Acepto los consumos del Estado de Cuenta, autorizo con mi firma en la presente estado de cuenta y la generacion de la factura de cobro sin la misma, segun el contrato establecido con la empresa.'), 0, 'C');

$file = '../../imprimir/congela/Cuenta_Congelada_'.$nrocongela.'.pdf';

// echo $file;
// $file = '../../imprimir/facturas/Factura_'.$nroFactura.'.pdf';

$pdf->Output($file, 'F');

// $pdf->Output();

echo $file;
