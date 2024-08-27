<?php

require '../../../res/fpdf/fpdf.php';

class PDF extends FPDF 
{
    public function Header()
    {
        $this->Image('../../../img/'.LOGO, 10, 10, 25);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(190, 7, NAME_EMPRESA, 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(190, 5, 'Nit: '.NIT_EMPRESA, 0, 1, 'C');
        $this->Cell(190, 5, ADRESS_EMPRESA, 0, 1, 'C');
        $this->Cell(190, 5, (CIUDAD_EMPRESA.', '.PAIS_EMPRESA), 0, 1, 'C');
        $this->Cell(190, 5, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(1);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(95, 5, WEB_EMPRESA, 0, 0, 'L');
        $this->Cell(95, 5, CORREO_EMPRESA, 0, 1, 'R');
    }
}

$reserva = $_SESSION['reserva'];

$pdf = new PDF();
$pdf->AddPage();

$datosReserva = $hotel->getReservasDatos($reserva);
$datosHuesped = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
$datosCompania = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);
$folios = $hotel->getCargosReservaModal($reserva);
$fecha = $hotel->getDatePms();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 5, strtoupper('Estado de Cuenta Huesped '), 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, 'Fecha ', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, $fecha[0]['fecha_auditoria'], 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, 'Habitacion', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, $datosReserva[0]['num_habitacion'], 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, 'Huesped', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(80, 5, ($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 5, 'Identificacion', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, $datosHuesped[0]['identificacion'], 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 5, 'Fecha Llegada', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, $datosReserva[0]['fecha_llegada'], 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(15, 5, 'Noches', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, $datosReserva[0]['dias_reservados'], 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 5, 'Fecha Salida', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, $datosReserva[0]['fecha_salida'], 0, 0, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, 'Hom', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, $datosReserva[0]['can_hombres'], 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, 'Muj', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, $datosReserva[0]['can_mujeres'], 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, 'Nin', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, $datosReserva[0]['can_ninos'], 0, 1, 'L');

if (!empty($datosReserva[0]['id_compania'])) {
    // $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 5, 'Empresa', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(120, 5, ($datosCompania[0]['empresa']), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(10, 5, 'Nit', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 5, $datosCompania[0]['nit'].'-'.$datosCompania[0]['dv'], 0, 1, 'L');
    /* if($datosReserva[0]['idCentroCia']!=0){
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(30,5,'Centro de Costo',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(130,5,($datosCentroCia[0]['descripcion_centro']),0,0,'L');
      $pdf->SetFont('Arial','',10);
    } */
}
$pdf->Ln(2);
$pdf->Cell(70, 6, 'Detalle', 1, 0, 'C');
$pdf->Cell(30, 6, 'Consumos', 1, 0, 'C');
$pdf->Cell(30, 6, 'Impuesto', 1, 0, 'C');
$pdf->Cell(30, 6, 'Abonos', 1, 0, 'C');
$pdf->Cell(30, 6, 'Fecha Cargo', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);

$consumos = 0;
$impto = 0;
$pagos = 0;
foreach ($folios as $folio1) {
    $consumos = $consumos + $folio1['monto_cargo'];
    $impto = $impto + $folio1['impuesto'];
    $pagos = $pagos + $folio1['pagos_cargos'];
    $pdf->Cell(70, 5, ($folio1['descripcion_cargo']), 0, 0, 'L');
    $pdf->Cell(30, 5, number_format($folio1['monto_cargo'], 2), 0, 0, 'R');
    $pdf->Cell(30, 5, number_format($folio1['impuesto'], 2), 0, 0, 'R');
    $pdf->Cell(30, 5, number_format($folio1['pagos_cargos'], 2), 0, 0, 'R');
    $pdf->Cell(30, 5, $folio1['fecha_cargo'], 0, 1, 'R');
}
$pdf->Ln(5);

$pdf->Cell(30, 6, 'Consumos ', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(31, 6, number_format($consumos, 2), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(32, 6, 'Impuesto', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(32, 6, number_format($impto, 2), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(32, 6, 'Abonos / Pagos', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(32, 6, number_format($pagos, 2), 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(157, 6, 'Total Presente Cuenta', 0, 0, 'R');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(32, 6, number_format(($consumos + $impto) - $pagos, 2), 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(1);
$pdf->Cell(190, 5, 'SON :'.numtoletras(($consumos + $impto) - $pagos), 0, 1, 'L');

$file = '../../imprimir/informes/Estado_Cuenta_Huesped_'.$reserva.'.pdf';
$pdf->Output($file, 'F');
