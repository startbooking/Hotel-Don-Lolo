<?php 
  require '../../res/php/app_topHotel.php'; 
  require 'plantillaHK.php';


  $file = $_POST['file'];

  $pdf = new PDF();
  $pdf->AddPage();

  $habitaciones = $hotel->estadoHabitacionesHK();

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(195,4,strtoupper('Estado Habitaciones Hotel'),0,1,'C');
  $pdf->Cell(195,4,'Fecha :'.FECHA_PMS,0,0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(15,5,'Nro Hab.',1,0,'C');
  $pdf->Cell(25,5,'Tipo Habitacion',1,0,'C');
  $pdf->Cell(10,5,'Ocup',1,0,'C');
  $pdf->Cell(10,5,'Suc.',1,0,'C');
  $pdf->Cell(10,5,'Mmto',1,0,'C');
  $pdf->Cell(20,5,'Fecha IN',1,0,'C');
  $pdf->Cell(20,5,'Fecha OUT',1,0,'C');
  $pdf->Cell(10,5,'Suc',1,0,'C');
  $pdf->Cell(10,5,'Limp',1,0,'C');
  $pdf->Cell(65,5,'Observaciones',1,1,'C');
  $pdf->SetFont('Arial','',9);
  
  foreach ($habitaciones as $habitacion) {
    $fechain = '';
    $fechaout = '';
    $ocupada = '' ;
    $mmto = '' ;
    $sucia = '' ;
    if($habitacion['ocupada']==1){
      $ocupada = 'X' ;
      $fechain = $habitacion['fecha_llegada'];
      $fechaout = $habitacion['fecha_salida'];
    }
    if($habitacion['mantenimiento']==1){
      $mmto = '0' ;
      $fechain = $habitacion['desde_fecha'];
      $fechaout = $habitacion['hasta_fecha'];
    }

    if($habitacion['sucia']==1){
      $sucia = '1' ;
    }
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(15,4,$habitacion['numero_hab'],1,0,'C');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(25,4,trim(substr($habitacion['descripcion_habitacion'].$habitacion['caracteristicas'],strpos(($habitacion['descripcion_habitacion'].$habitacion['caracteristicas']),' '))),1,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(10,4,$ocupada,1,0,'C');
    $pdf->Cell(10,4,$sucia,1,0,'C');
    $pdf->Cell(10,4,$mmto,1,0,'C');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,4,$fechain,1,0,'L');
    $pdf->Cell(20,4,$fechaout,1,0,'L');
    $pdf->Cell(10,4,'',1,0,'L');
    $pdf->Cell(10,4,'',1,0,'L');
    if($habitacion['observaciones'] != ''){
      $pdf->Cell(65,4,substr($habitacion['observaciones'],0,35),1,1,'L');
    }else{
      $pdf->Cell(65,4,'',1,1,'L');
    }
  }
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;
  
?>
