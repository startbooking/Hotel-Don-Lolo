<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 
  require 'plantillaFpdf.php';

  $reserva        = $_SESSION['reserva'];
  $pdf = new PDF();
  $pdf->AddPage();

  $datosReserva   = $hotel->getReservasDatos($reserva);
  $datosHuesped   = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
  $datosCompania  = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
  $datosAgencia   = $hotel->getSeleccionaAgencia($datosReserva[0]['id_agencia']);
  $tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);

  $folios = $hotel->getConsumosReservaAgrupadoCodigo($reserva);
  $fecha  = $hotel->getDatePms();
  

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,6,'Estado de Cuenta Huesped ',0,1,'C');
  $pdf->Ln(2);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(20,6,'Fecha ',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,6,$fecha,0,1,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(20,6,'Habitacion',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,6,$datosReserva[0]["num_habitacion"],0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(20,6,'Huesped',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(80,6,utf8_decode($datosHuesped[0]["apellidos"].' '.$datosHuesped[0]["nombres"]),0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,6,'Identificacion',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,6,$datosHuesped[0]["identificacion"],0,1,'L');

  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,6,'Fecha Llegada',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,6,$datosReserva[0]["fecha_llegada"],0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(15,6,'Noches',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,6,$datosReserva[0]['dias_reservados'],0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,6,'Fecha Salida',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,6,$datosReserva[0]["fecha_salida"],0,0,'L');

  $pdf->SetFont('Arial','',10);
  $pdf->Cell(10,6,'Hom',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,6,$datosReserva[0]["can_hombres"],0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(10,6,'Muj',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,6,$datosReserva[0]['can_mujeres'],0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(10,6,'Nin',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,6,$datosReserva[0]["can_ninos"],0,1,'L');

  if(!empty($datosReserva[0]['id_compania'])){
    $pdf->Ln(2);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,6,'Empresa',0,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(70,6,utf8_decode($datosCompania[0]['empresa']),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10,6,'Nit',0,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,6,$datosCompania[0]['nit'].'-'.$datosCompania[0]['dv'],0,1,'L');
  } 
  $pdf->Ln(4);
  $pdf->Cell(100,6,'Detalle',1,0,'C');
  $pdf->Cell(30,6,'Consumos',1,0,'C');
  $pdf->Cell(30,6,'Impuesto',1,0,'C');
  $pdf->Cell(30,6,'Abonos',1,1,'C');
  $pdf->SetFont('Arial','',10);

  $consumos = 0;
  $impto    = 0;
  $pagos    = 0;
  foreach ($folios as $folio1) {
    
    $consumos = $consumos + $folio1['cargos'];
    $impto    = $impto + $folio1['imptos'];
    $pagos    = $pagos + $folio1['pagos']; 
    $pdf->Cell(100,6,utf8_decode($folio1['descripcion_cargo']),1,0,'L');
    $pdf->Cell(30,6,number_format($folio1['cargos'],2),1,0,'R');
    $pdf->Cell(30,6,number_format($folio1['imptos'],2),1,0,'R');
    $pdf->Cell(30,6,number_format($folio1['pagos'],2),1,1,'R');
  }
  $pdf->Ln(5);

  $pdf->Cell(30,6,'Consumos ',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(31,6,number_format($consumos,2),0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(32,6,'Impuesto',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(32,6,number_format($impto,2),0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(32,6,'Abonos / Pagos',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(32,6,number_format($pagos,2),0,1,'R');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(157,6,'Total Presente Cuenta',0,0,'R');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(32,6,number_format(($consumos+ $impto)-$pagos,2),0,1,'R');
  $pdf->SetFont('Arial','',10);
  $pdf->Ln(1);
  $pdf->Cell(190,5,'SON :'. numtoletras(($consumos+ $impto)-$pagos),0,1,'L');

  $file = 'auditorias/Estado_Cuenta_'.FECHA_PMS.'.pdf';

  $pdf->Output($file,'|');
?>
