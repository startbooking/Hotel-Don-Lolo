<?php
require_once '../../../res/php/app_topHotel.php';
require_once '../../../res/fpdf/fpdf.php';

$nrofolio = 1;
$tipofac = 2;

$datosReserva = $hotel->getReservasDatos($reserva);
$datosHuesped = $hotel->getbuscaDatosHuesped($datosReserva['id_huesped']);
$datosCompania = $hotel->getSeleccionaCompania($idcia);
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva['tipo_habitacion']);

$folios = $hotel->getConsumosCongeladaReservaAgrupadoCodigoFolio($reserva, $nrofolio, 1);
$fecha = $hotel->getDatePms();

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 45, 195, 214);

$pdf->Image('../../../img/'.LOGO, 10, 5, 40);

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(195, 7, (NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(195, 5, 'Iva Regimen Comun', 0, 1, 'C');
$pdf->Cell(195, 5, (ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(40, 5, '', 0, 0, 'C');
$pdf->Cell(115, 5, (CIUDAD_EMPRESA.' '.PAIS_EMPRESA), 0, 0, 'C');
$pdf->Cell(40, 5, 'ESTADO DE CUENTA', 1, 1, 'C');
$pdf->Cell(40, 5, '', 0, 0, 'C');
$pdf->Cell(115, 5, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(110, 5, NAME_HOTEL, 0, 0, 'C');
$pdf->Cell(40, 5, str_pad($numcongela, 5, '0', STR_PAD_LEFT), 1, 1, 'C');
$pdf->Ln(3);
$pdf->Cell(195, 8, 'ESTE ES UN DOCUMENTO INFORMATIVO DEL ESTADO ACTUAL DEL HUESPED ', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'RAZON SOCIAL', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(120, 5, ($datosCompania[0]['empresa']), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, 'NIT.', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, number_format($datosCompania[0]['nit'], 0).'-'.$datosCompania[0]['dv'], 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'DIRECCION', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 5, substr(($datosCompania[0]['direccion']), 0, 30), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, 'CIUDAD', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, (substr($hotel->getCityName($datosCompania[0]['ciudad']), 0, 12)), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(21, 5, 'TELEFONO', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, $datosCompania[0]['telefono'], 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'CLIENTE', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 5, substr(($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']), 0, 30), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5, 'IDENTIFICACION', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, $datosHuesped[0]['identificacion'], 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(48, 5, ('ADULTOS / NIÑOS'), 1, 0, 'C');
$pdf->Cell(48, 5, 'HABITACION', 1, 0, 'C');
$pdf->Cell(49, 5, 'TARIFA', 1, 0, 'C');
$pdf->Cell(50, 5, 'HORAL SALIDA', 1, 1, 'C');
$pdf->Cell(48, 5, $datosReserva['can_hombres'] + $datosReserva['can_mujeres'].'/'.$datosReserva['can_ninos'], 1, 0, 'C');
$pdf->Cell(48, 5, $datosReserva['num_habitacion'], 1, 0, 'C');
$pdf->Cell(49, 5, $datosReserva['tarifa'], 1, 0, 'C');
$pdf->Cell(50, 5, date('H:m:s'), 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(48, 5, 'FECHA LLEGADA', 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(48, 5, $datosReserva['fecha_llegada'], 1, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(49, 5, 'FECHA SALIDA', 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 5, $datosReserva['fecha_salida'], 1, 1, 'C');

$pdf->Ln(2);
$pdf->Cell(100, 5, 'CONCEPTO', 1, 0, 'C');
$pdf->Cell(15, 5, 'CANT', 1, 0, 'C');
$pdf->Cell(20, 5, 'VALOR', 1, 0, 'C');
$pdf->Cell(20, 5, 'IMPTO', 1, 0, 'C');
$pdf->Cell(20, 5, 'ABONOS', 1, 0, 'C');
$pdf->Cell(20, 5, 'TOTAL', 1, 1, 'C');
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
    $pdf->Cell(100, 5, ($folio1['descripcion_cargo']), 0, 0, 'L');
    $pdf->Cell(15, 5, $folio1['cant'], 0, 0, 'C');
    $pdf->Cell(20, 5, number_format($folio1['cargos'], 2), 0, 0, 'R');
    $pdf->Cell(20, 5, number_format($folio1['imptos'], 2), 0, 0, 'R');
    $pdf->Cell(20, 5, number_format($folio1['pagos'], 2), 0, 0, 'R');
    $pdf->Cell(20, 5, number_format($folio1['cargos'] + $folio1['imptos'], 2), 0, 1, 'R');
}

$pdf->Ln(2);

$pdf->Cell(31, 6, 'Consumos ', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(32, 6, number_format($consumos, 2), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(33, 6, 'Impuesto', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(33, 6, number_format($impto, 2), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(33, 6, 'Abonos / Pagos', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(33, 6, number_format($pagos, 2), 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(157, 6, 'Total Presente Cuenta', 0, 0, 'R');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(32, 6, number_format(($consumos + $impto) - $pagos, 2), 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(1);
$pdf->Cell(190, 5, 'SON :'.numtoletras(($consumos + $impto) - $pagos), 0, 1, 'L');

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

$pdf->MultiCell(190, 4, ('Acepto los consumos del Estado de Cuenta, autorizo con mi firma en la presente estado de cuenta y la generacion de la factura de cobro sin la misma, segun el contrato establecido con la empresa.'), 0, 'C');

$file = '../../imprimir/congela/Cuenta_Congelada_'.$numcongela.'.pdf';
$fileOut = 'Cuenta_Congelada_'.$numcongela.'.pdf';

$pdf->Output($file, 'F');

echo $fileOut;
