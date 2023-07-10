<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdf.php'; 

  $reservas = $hotel->getHuespedesenSalida(1,'CX'); 
  
  array_sort_by($reservas, 'apellido1', $order = SORT_ASC);  

  $regis    = count($reservas);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(190,5,'RESERVAS CANCELADAS ',0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(190,5,'Fecha:'.FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,6,'Res. ',0,0,'C');
  $pdf->Cell(10,6,'Hab.',0,0,'C'); 
  $pdf->Cell(60,6,'Huesped',0,0,'C');
  $pdf->Cell(20,6,'Llegada',0,0,'L');
  $pdf->Cell(20,6,'Salida',0,0,'L');
  $pdf->Cell(50,6,'Motivo Cancelacion ',0,0,'C');
  $pdf->Cell(20,6,'Usuario',0,1,'C');
  $pdf->SetFont('Arial','',9);
  if($regis==0){
      $pdf->Cell(190,6,'SIN RESERVAS CANCELADAS ',0,0,'C');    
  }else{
    foreach ($reservas as $reserva) {
      $pdf->Cell(10,5,$reserva['num_reserva'],0,0,'C');
      $pdf->Cell(10,6,$reserva['num_habitacion'],0,0,'L');
      $pdf->Cell(60,5,utf8_decode($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(20,5,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(20,5,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(50,5,$hotel->motivoCancelaReserva($reserva['motivo_cancela']),0,0,'L');
      $pdf->Cell(20,5,$reserva['usuario_cancela'],0,1,'C');
    }    
  }
  $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';


?>
